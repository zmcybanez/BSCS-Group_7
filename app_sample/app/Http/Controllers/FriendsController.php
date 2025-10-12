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
            $query->select('addressee_id')
                  ->from('friendships')
                  ->where('requester_id', $user->UserID)
                  ->where('status', 'accepted')
                  ->union(
                      $query->newQuery()
                            ->select('requester_id')
                            ->from('friendships')
                            ->where('addressee_id', $user->UserID)
                            ->where('status', 'accepted')
                  );
        })->get();

        // Get friend requests (pending)
        $friendRequests = User::whereIn('UserID', function($query) use ($user) {
            $query->select('requester_id')
                  ->from('friendships')
                  ->where('addressee_id', $user->UserID)
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
            $query->where('requester_id', $user->UserID)->where('addressee_id', $friendId);
        })->orWhere(function($query) use ($user, $friendId) {
            $query->where('requester_id', $friendId)->where('addressee_id', $user->UserID);
        })->first();

        if (!$existingFriendship) {
            Friendship::create([
                'requester_id' => $user->UserID,
                'addressee_id' => $friendId,
                'status' => 'pending'
            ]);
        }

        return redirect()->back()->with('success', 'Friend request sent!');
    }

    public function acceptRequest(Request $request)
    {
        $user = Auth::user();
        $friendship = Friendship::where('requester_id', $request->user_id)
                                ->where('addressee_id', $user->UserID)
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
        $friendship = Friendship::where('requester_id', $request->user_id)
                                ->where('addressee_id', $user->UserID)
                                ->where('status', 'pending')
                                ->first();

        if ($friendship) {
            $friendship->delete();
        }

        return redirect()->back()->with('success', 'Friend request rejected.');
    }
}
