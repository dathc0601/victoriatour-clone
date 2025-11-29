<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Homepage --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toW3cString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Static Pages --}}
    <url>
        <loc>{{ route('tours.index') }}</loc>
        <lastmod>{{ $tours->max('updated_at')?->toW3cString() ?? now()->toW3cString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ route('destinations.index') }}</loc>
        <lastmod>{{ $destinations->max('updated_at')?->toW3cString() ?? now()->toW3cString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ route('blog.index') }}</loc>
        <lastmod>{{ $posts->max('updated_at')?->toW3cString() ?? now()->toW3cString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>{{ now()->toW3cString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ route('search') }}</loc>
        <lastmod>{{ now()->toW3cString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>

    {{-- Tours --}}
    @foreach($tours as $tour)
    <url>
        <loc>{{ route('tours.show', $tour->slug) }}</loc>
        <lastmod>{{ $tour->updated_at->toW3cString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Destinations --}}
    @foreach($destinations as $destination)
    <url>
        <loc>{{ route('destinations.show', $destination->slug) }}</loc>
        <lastmod>{{ $destination->updated_at->toW3cString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Blog Posts --}}
    @foreach($posts as $post)
    <url>
        <loc>{{ route('blog.show', $post->slug) }}</loc>
        <lastmod>{{ $post->updated_at->toW3cString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- Dynamic Pages --}}
    @foreach($pages as $page)
    <url>
        <loc>{{ url($page->slug) }}</loc>
        <lastmod>{{ $page->updated_at->toW3cString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>
