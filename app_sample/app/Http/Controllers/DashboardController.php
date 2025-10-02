<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Friendship;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category', 'comments.user'])
            ->where('status', 'active')
            ->orderBy('date', 'desc')
            ->paginate(10);

        $categories = Category::all();

        // Get friends and recent chats for sidebar
        $user = Auth::user();

        // Get recent friends using direct approach
        $friendshipIds = Friendship::where(function($query) use ($user) {
            $query->where('requester_id', $user->UserID)
                  ->orWhere('addressee_id', $user->UserID);
        })->where('status', 'accepted')->limit(5)->pluck('FriendshipID');

        $recentFriends = collect();
        foreach ($friendshipIds as $friendshipId) {
            $friendship = Friendship::find($friendshipId);
            if ($friendship && $friendship->requester_id == $user->UserID) {
                $recentFriends->push($friendship->addressee);
            } elseif ($friendship) {
                $recentFriends->push($friendship->requester);
            }
        }

        // Get recent chats with last message - temporarily disabled due to table issues
        $recentChats = collect(); // Empty collection for now
        /*
        $recentChats = Message::with(['sender', 'receiver'])
            ->where(function($query) use ($user) {
                $query->where('sender_id', $user->UserID)
                      ->orWhere('receiver_id', $user->UserID);
            })
            ->whereIn('MessageID', function($query) use ($user) {
                $query->select(DB::raw('MAX(MessageID)'))
                      ->from('messages')
                      ->where(function($q) use ($user) {
                          $q->where('sender_id', $user->UserID)
                            ->orWhere('receiver_id', $user->UserID);
                      })
                      ->groupBy(DB::raw('LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)'));
            })
            ->orderBy('sent_at', 'desc')
            ->limit(3)
            ->get();
        */

        return view('dashboard', compact('posts', 'categories', 'recentFriends', 'recentChats'));
    }

    public function myQuestions()
    {
        // Debug logging
        \Log::info('MyQuestions method called for user: ' . Auth::id());

        $posts = Post::with(['user', 'category', 'comments.user'])
            ->where('userID', Auth::id())
            ->where('status', 'active')
            ->orderBy('date', 'desc')
            ->paginate(10);

        \Log::info('Found ' . $posts->count() . ' posts for user');

        $categories = Category::all();

        // Get friends and recent chats for sidebar
        $user = Auth::user();

        // Get recent friends using direct approach
        $friendshipIds = Friendship::where(function($query) use ($user) {
            $query->where('requester_id', $user->UserID)
                  ->orWhere('addressee_id', $user->UserID);
        })->where('status', 'accepted')->limit(5)->pluck('FriendshipID');

        $recentFriends = collect();
        foreach ($friendshipIds as $friendshipId) {
            $friendship = Friendship::find($friendshipId);
            if ($friendship && $friendship->requester_id == $user->UserID) {
                $recentFriends->push($friendship->addressee);
            } elseif ($friendship) {
                $recentFriends->push($friendship->requester);
            }
        }

        // Get recent chats with last message
        $recentChats = Message::with(['sender', 'receiver'])
            ->where(function($query) use ($user) {
                $query->where('sender_id', $user->UserID)
                      ->orWhere('receiver_id', $user->UserID);
            })
            ->whereIn('MessageID', function($query) use ($user) {
                $query->select(DB::raw('MAX(MessageID)'))
                      ->from('messages')
                      ->where(function($q) use ($user) {
                          $q->where('sender_id', $user->UserID)
                            ->orWhere('receiver_id', $user->UserID);
                      })
                      ->groupBy(DB::raw('LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)'));
            })
            ->orderBy('sent_at', 'desc')
            ->limit(3)
            ->get();

        return view('dashboard', compact('posts', 'categories', 'recentFriends', 'recentChats'))->with('pageType', 'myQuestions');
    }

    public function comment(Request $request, Post $post)
    {
        // This method might be handled by a Comment model/controller
        // For now, let's redirect back to avoid errors
        return redirect()->back()->with('error', 'Comment functionality not yet implemented');
    }

    public function toggleSolved(Request $request, Post $post)
    {
        // Check if user owns the post or is an admin
        if ($post->userID !== Auth::id()) {
            return redirect()->back()->with('error', 'You can only mark your own posts as solved');
        }

        $post->status = $post->status === 'solved' ? 'active' : 'solved';
        $post->save();

        return redirect()->back()->with('success', 'Post status updated successfully');
    }
}
