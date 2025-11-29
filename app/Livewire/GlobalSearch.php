<?php

namespace App\Livewire;

use App\Models\Tour;
use App\Models\Destination;
use App\Models\BlogPost;
use Livewire\Component;
use Livewire\Attributes\Url;

class GlobalSearch extends Component
{
    #[Url(as: 'q')]
    public string $query = '';

    public bool $showDropdown = false;
    public array $results = [];

    public function updatedQuery(): void
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            $this->showDropdown = false;
            return;
        }

        $this->search();
        $this->showDropdown = true;
    }

    public function search(): void
    {
        $searchTerm = '%' . $this->query . '%';
        $locale = app()->getLocale();

        // Search Tours (search in both current locale and fallback)
        $tours = Tour::active()
            ->where(function ($q) use ($searchTerm, $locale) {
                $q->whereRaw("json_extract(title, '$." . $locale . "') LIKE ?", [$searchTerm])
                  ->orWhereRaw("json_extract(excerpt, '$." . $locale . "') LIKE ?", [$searchTerm])
                  ->orWhereRaw("json_extract(title, '$.en') LIKE ?", [$searchTerm])
                  ->orWhereRaw("json_extract(excerpt, '$.en') LIKE ?", [$searchTerm]);
            })
            ->with('destination')
            ->limit(5)
            ->get()
            ->map(fn ($tour) => [
                'type' => 'tour',
                'id' => $tour->id,
                'title' => $tour->title,
                'subtitle' => ($tour->destination?->name ?? 'Vietnam') . ' - ' . $tour->duration_days . ' ' . __('buttons.days'),
                'url' => route('tours.show', $tour->slug),
                'image' => $tour->getFirstMediaUrl('featured_image') ?: 'https://picsum.photos/seed/tour' . $tour->id . '/100/100',
            ]);

        // Search Destinations
        $destinations = Destination::active()
            ->where(function ($q) use ($searchTerm, $locale) {
                $q->whereRaw("json_extract(name, '$." . $locale . "') LIKE ?", [$searchTerm])
                  ->orWhereRaw("json_extract(description, '$." . $locale . "') LIKE ?", [$searchTerm])
                  ->orWhereRaw("json_extract(name, '$.en') LIKE ?", [$searchTerm])
                  ->orWhereRaw("json_extract(description, '$.en') LIKE ?", [$searchTerm]);
            })
            ->limit(3)
            ->get()
            ->map(fn ($dest) => [
                'type' => 'destination',
                'id' => $dest->id,
                'title' => $dest->name,
                'subtitle' => __('navigation.destination'),
                'url' => route('destinations.show', $dest->slug),
                'image' => $dest->getFirstMediaUrl('image') ?: 'https://picsum.photos/seed/dest' . $dest->id . '/100/100',
            ]);

        // Search Blog Posts
        $posts = BlogPost::active()
            ->where(function ($q) use ($searchTerm, $locale) {
                $q->whereRaw("json_extract(title, '$." . $locale . "') LIKE ?", [$searchTerm])
                  ->orWhereRaw("json_extract(excerpt, '$." . $locale . "') LIKE ?", [$searchTerm])
                  ->orWhereRaw("json_extract(title, '$.en') LIKE ?", [$searchTerm])
                  ->orWhereRaw("json_extract(excerpt, '$.en') LIKE ?", [$searchTerm]);
            })
            ->with('category')
            ->limit(3)
            ->get()
            ->map(fn ($post) => [
                'type' => 'blog',
                'id' => $post->id,
                'title' => $post->title,
                'subtitle' => $post->category?->name ?? __('navigation.blog'),
                'url' => route('blog.show', $post->slug),
                'image' => $post->image ?: 'https://picsum.photos/seed/blog' . $post->id . '/100/100',
            ]);

        $this->results = [
            'tours' => $tours->toArray(),
            'destinations' => $destinations->toArray(),
            'posts' => $posts->toArray(),
        ];
    }

    public function closeDropdown(): void
    {
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.global-search');
    }
}
