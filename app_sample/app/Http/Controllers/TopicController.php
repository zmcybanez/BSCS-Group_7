<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    public function show($slug)
    {
        // Find category by slug or name
        $category = Category::where('name', 'like', '%' . str_replace('-', ' ', $slug) . '%')->first();

        if (!$category) {
            // If no exact match, try to find by slug-like conversion with different cases
            $searchTerms = [
                ucwords(str_replace('-', ' ', $slug)), // "dragon-fruit" -> "Dragon Fruit"
                strtoupper(str_replace('-', ' ', $slug)), // "mais" -> "MAIS"
                ucfirst(str_replace('-', ' ', $slug)),   // "herbs-spices" -> "Herbs spices"
                str_replace('-', ' & ', $slug)            // "aeroponics-aquaponics" -> "aeroponics & aquaponics"
            ];

            foreach ($searchTerms as $term) {
                $category = Category::where('name', 'like', '%' . $term . '%')->first();
                if ($category) break;
            }
        }

        if (!$category) {
            abort(404, 'Topic not found');
        }

        $posts = Post::with(['user', 'category', 'comments.user'])
            ->where('categoryID', $category->CategoryID)
            ->where('status', 'active')
            ->orderBy('date', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view('topics.show', compact('category', 'posts', 'categories'));
    }
}
