<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category', 'comments.user'])
            ->where('status', 'active')
            ->orderBy('date', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view('dashboard', compact('posts', 'categories'));
    }
}
