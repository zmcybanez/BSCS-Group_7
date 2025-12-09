<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get friends (accepted friendships)
        $friends = User::whereIn('UserID', function($query) use ($user) {
            $query->select('friend_id')
                  ->from('friendships')
                  ->where('user_id', $user->UserID)
                  ->where('status', 'accepted')
                  ->union(
                      $query->newQuery()
                            ->select('user_id')
                            ->from('friendships')
                            ->where('friend_id', $user->UserID)
                            ->where('status', 'accepted')
                  );
        })->get();

        // Get friend requests (pending)
        $friendRequests = User::whereIn('UserID', function($query) use ($user) {
            $query->select('user_id')
                  ->from('friendships')
                  ->where('friend_id', $user->UserID)
                  ->where('status', 'pending');
        })->get();

        return view('friends', compact('friends', 'friendRequests'));
    }

    public function sendRequest(Request $request)
    {
        $user = Auth::user();
        $friendId = $request->friend_id;

        // Check if friendship already exists
        $existingFriendship = Friendship::where(function($query) use ($user, $friendId) {
            $query->where('user_id', $user->UserID)->where('friend_id', $friendId);
        })->orWhere(function($query) use ($user, $friendId) {
            $query->where('user_id', $friendId)->where('friend_id', $user->UserID);
        })->first();

        if (!$existingFriendship) {
            Friendship::create([
                'user_id' => $user->UserID,
                'friend_id' => $friendId,
                'status' => 'pending'
            ]);
        }

        return redirect()->back()->with('success', 'Friend request sent!');
    }

    public function acceptRequest(Request $request)
    {
        $user = Auth::user();
    $friendship = Friendship::where('user_id', $request->user_id)
                ->where('friend_id', $user->UserID)
                ->where('status', 'pending')
                ->first();

        if ($friendship) {
            $friendship->update(['status' => 'accepted']);
        }

        return redirect()->back()->with('success', 'Friend request accepted!');
    }

    public function rejectRequest(Request $request)
    {
        $user = Auth::user();
    $friendship = Friendship::where('user_id', $request->user_id)
                ->where('friend_id', $user->UserID)
                ->where('status', 'pending')
                ->first();

        if ($friendship) {
            $friendship->delete();
        }

        return redirect()->back()->with('success', 'Friend request rejected.');
    }
}
