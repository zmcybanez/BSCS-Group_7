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
            'category_id' => 'required|exists:categories,CategoryID',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB = 5120KB
        ]);

        // Validate maximum 5 images
        if ($request->hasFile('images') && count($request->file('images')) > 5) {
            return redirect()->back()
                ->withErrors(['images' => 'You can upload maximum 5 images.'])
                ->withInput();
        }

        $post = new Post([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'userID' => auth()->id(),
            'categoryID' => $validated['category_id'],
            'date' => now(),
            'status' => 'active',
        ]);

        // Handle multiple image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('posts', 'public');
                $imagePaths[] = $imagePath;
            }
            // Store image paths as JSON
            $post->imgSrc = json_encode($imagePaths);
        }

        $post->save();

        return redirect()->route('dashboard')
            ->with('success', 'Your question has been posted successfully!');
    }
}
