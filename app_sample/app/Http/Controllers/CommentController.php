<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // ✅ Correct import — not PostController!

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // ✅ Validate request
        $request->validate([
            'body' => 'required',
        ]);

        // ✅ Find the post by ID (fixed syntax)
        $post = Post::findOrFail($postId);

        // ✅ Create a comment related to the post
        $post->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        // ✅ Return success
        return back()->with('success', 'Comment added!');
    }
}
