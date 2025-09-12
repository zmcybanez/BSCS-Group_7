<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|exists:categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $category = Category::where('name', $validated['category'])->firstOrFail();

        $post = new Post([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'userID' => auth()->id(),
            'categoryID' => $category->id,
            'date' => now(),
            'published_at' => now(),
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->imgSrc = $imagePath;
        }

        $post->save();

        return redirect()->route('dashboard')
            ->with('success', 'Your question has been posted successfully!');
    }
}
