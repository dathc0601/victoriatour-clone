<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = BlogPost::active()
            ->with('category')
            ->latest('published_at');

        // Filter by category
        if ($request->filled('category')) {
            $posts->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $posts->paginate(9);
        $categories = BlogCategory::active()->withCount('posts')->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->active()
            ->with('category')
            ->firstOrFail();

        $relatedPosts = BlogPost::active()
            ->where('id', '!=', $post->id)
            ->when($post->blog_category_id, function ($q) use ($post) {
                $q->where('blog_category_id', $post->blog_category_id);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
