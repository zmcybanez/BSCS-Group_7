<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        // Check if user is admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'total_posts' => Post::count(),
            'total_comments' => Comment::count(),
            'total_categories' => Category::count(),
            'active_users' => User::where('last_seen_at', '>', now()->subMinutes(5))->count(),
            'posts_today' => Post::whereDate('created_at', today())->count(),
            'new_users_this_month' => User::whereMonth('created_at', now()->month)->count(),
        ];

        // Get recent activity
        $recentUsers = User::latest('created_at')->take(10)->get();
        $recentPosts = Post::with('user', 'category')->latest('created_at')->take(10)->get();
        $recentComments = Comment::with('user', 'post')->latest('created_at')->take(10)->get();

        // Get all categories for management
        $categories = Category::withCount('posts')->orderBy('name')->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentPosts', 'recentComments', 'categories'));
    }

    /**
     * Get all users for management
     */
    public function users(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $query = User::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->withCount(['posts', 'comments'])
                       ->orderBy('created_at', 'desc')
                       ->paginate(20);

        return view('admin.users', compact('users'));
    }

    /**
     * Update user role
     */
    public function updateUserRole(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'role' => 'required|in:user,admin,moderator'
        ]);

        $user->role = $request->role;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => "User role updated to {$request->role} successfully."
        ]);
    }

    /**
     * Ban/Unban user
     */
    public function toggleUserStatus(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Prevent banning yourself
        if ($user->UserID === auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Cannot ban yourself'], 400);
        }

        $user->status = $user->status === 'active' ? 'banned' : 'active';
        $user->save();

        return response()->json([
            'success' => true,
            'message' => "User {$user->status} successfully.",
            'status' => $user->status
        ]);
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Prevent deleting yourself
        if ($user->UserID === auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Cannot delete yourself'], 400);
        }

        try {
            // Delete user's profile picture
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Delete user's posts images
            foreach ($user->posts as $post) {
                if ($post->imgSrc) {
                    $images = json_decode($post->imgSrc, true);
                    if (is_array($images)) {
                        foreach ($images as $imagePath) {
                            Storage::disk('public')->delete($imagePath);
                        }
                    }
                }
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all posts for management
     */
    public function posts(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $query = Post::with('user', 'category');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('categoryID', $request->category);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $posts = $query->withCount(['comments', 'likes'])
                       ->orderBy('created_at', 'desc')
                       ->paginate(20);

        $categories = Category::all();

        return view('admin.posts', compact('posts', 'categories'));
    }

    /**
     * Delete any post
     */
    public function deletePost(Post $post)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            // Delete associated images
            if ($post->imgSrc) {
                $images = json_decode($post->imgSrc, true);
                if (is_array($images)) {
                    foreach ($images as $imagePath) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }

            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting post: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Manage categories
     */
    public function categories()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $categories = Category::withCount('posts')->orderBy('name')->get();

        return view('admin.categories', compact('categories'));
    }

    /**
     * Create category
     */
    public function storeCategory(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'category' => $category
        ]);
    }

    /**
     * Update category
     */
    public function updateCategory(Request $request, Category $category)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->CategoryID . ',CategoryID',
            'description' => 'nullable|string'
        ]);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'category' => $category
        ]);
    }

    /**
     * Delete category
     */
    public function deleteCategory(Category $category)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Check if category has posts
        if ($category->posts()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete category with existing posts. Please reassign or delete posts first.'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ]);
    }

    /**
     * Get system reports
     */
    public function reports()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // User growth data (last 12 months)
        $userGrowth = User::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subMonths(12))
        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
        ->orderBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
        ->get();

        // Post activity data (last 30 days)
        $postActivity = Post::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy(DB::raw('DATE(created_at)'))
        ->get();

        // Top contributors
        $topContributors = User::withCount(['posts', 'comments'])
            ->having('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        // Category distribution
        $categoryDistribution = Category::withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->get();

        return view('admin.reports', compact('userGrowth', 'postActivity', 'topContributors', 'categoryDistribution'));
    }
}
