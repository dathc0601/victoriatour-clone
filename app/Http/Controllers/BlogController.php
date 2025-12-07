<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->get('category');
        $perPage = 10;

        // Get featured posts (first 4) - only when showing all posts
        $featuredPosts = collect();
        if (!$categorySlug) {
            $featuredPosts = BlogPost::active()
                ->featured()
                ->with('category')
                ->latest('published_at')
                ->take(5)
                ->get();
        }

        // Get latest posts
        $postsQuery = BlogPost::active()
            ->with('category')
            ->latest('published_at');

        // Filter by category
        if ($categorySlug) {
            $postsQuery->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
        }

        // Exclude featured posts from latest news when showing all
        if (!$categorySlug && $featuredPosts->isNotEmpty()) {
            $postsQuery->whereNotIn('id', $featuredPosts->pluck('id'));
        }

        $posts = $postsQuery->paginate($perPage);

        // Handle AJAX request for infinite scroll
        if ($request->ajax()) {
            $html = '';
            foreach ($posts as $index => $post) {
                // Calculate size based on position in current page
                $globalIndex = ($posts->currentPage() - 1) * $perPage + $index;
                $size = match($globalIndex % 11) {
                    0 => 'large',
                    3 => 'wide',
                    6 => 'tall',
                    default => 'standard',
                };
                $html .= view('components.blog-bento-card', ['post' => $post, 'size' => $size])->render();
            }

            return response()->json([
                'html' => $html,
                'hasMore' => $posts->hasMorePages(),
                'nextPage' => $posts->currentPage() + 1,
            ]);
        }

        $categories = BlogCategory::active()->withCount('posts')->get();
        $activeCategory = $categorySlug;

        return view('blog.index', compact('featuredPosts', 'posts', 'categories', 'activeCategory'));
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

        // Calculate reading time (average 200 words per minute)
        $wordCount = str_word_count(strip_tags($post->content ?? ''));
        $readingTime = max(1, (int) ceil($wordCount / 200));

        return view('blog.show', compact('post', 'relatedPosts', 'readingTime'));
    }
}
