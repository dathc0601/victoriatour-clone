<?php

namespace App\Livewire;

use App\Models\Destination;
use App\Models\Tour;
use App\Models\TourCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class TourFilter extends Component
{
    use WithPagination;

    #[Url(as: 'destination')]
    public string $destination = '';

    #[Url(as: 'category')]
    public string $category = '';

    #[Url(as: 'duration')]
    public string $duration = '';

    #[Url(as: 'price')]
    public string $priceRange = '';

    #[Url(as: 'sort')]
    public string $sortBy = 'default';

    public function updatingDestination(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function updatingDuration(): void
    {
        $this->resetPage();
    }

    public function updatingPriceRange(): void
    {
        $this->resetPage();
    }

    public function updatingSortBy(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['destination', 'category', 'duration', 'priceRange', 'sortBy']);
        $this->resetPage();
    }

    public function render()
    {
        $tours = Tour::active()
            ->with(['destination', 'categories']);

        // Filter by destination
        if ($this->destination) {
            $tours->whereHas('destination', function ($q) {
                $q->where('slug', $this->destination);
            });
        }

        // Filter by category
        if ($this->category) {
            $tours->whereHas('categories', function ($q) {
                $q->where('slug', $this->category);
            });
        }

        // Filter by duration
        if ($this->duration) {
            match ($this->duration) {
                '1-3' => $tours->whereBetween('duration_days', [1, 3]),
                '4-7' => $tours->whereBetween('duration_days', [4, 7]),
                '8-14' => $tours->whereBetween('duration_days', [8, 14]),
                '15+' => $tours->where('duration_days', '>=', 15),
                default => null,
            };
        }

        // Filter by price range
        if ($this->priceRange) {
            match ($this->priceRange) {
                'under-500' => $tours->where('price', '<', 500),
                '500-1000' => $tours->whereBetween('price', [500, 1000]),
                '1000-2000' => $tours->whereBetween('price', [1000, 2000]),
                'over-2000' => $tours->where('price', '>=', 2000),
                default => null,
            };
        }

        // Apply sorting
        $tours = match ($this->sortBy) {
            'price-low' => $tours->orderBy('price', 'asc'),
            'price-high' => $tours->orderBy('price', 'desc'),
            'duration-short' => $tours->orderBy('duration_days', 'asc'),
            'duration-long' => $tours->orderBy('duration_days', 'desc'),
            'newest' => $tours->orderBy('created_at', 'desc'),
            default => $tours->ordered(),
        };

        $tours = $tours->paginate(12);

        $destinations = Destination::active()->ordered()->get();
        $categories = TourCategory::active()->get();

        $hasFilters = $this->destination || $this->category || $this->duration || $this->priceRange || $this->sortBy !== 'default';

        return view('livewire.tour-filter', [
            'tours' => $tours,
            'destinations' => $destinations,
            'categories' => $categories,
            'hasFilters' => $hasFilters,
        ]);
    }
}
