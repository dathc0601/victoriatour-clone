<?php

namespace App\Livewire;

use App\Models\Destination;
use App\Models\MiceContent;
use Livewire\Component;
use Livewire\Attributes\Url;

class MiceFilter extends Component
{
    #[Url(as: 'country')]
    public string $country = '';

    #[Url(as: 'region')]
    public string $region = '';

    #[Url(as: 'delegates')]
    public string $delegates = '';

    public function updatedCountry(): void
    {
        $this->region = '';
    }

    public function selectCountry(string $slug): void
    {
        $this->country = $slug;
        $this->region = '';
    }

    public function clearFilters(): void
    {
        $this->reset(['region', 'delegates']);
    }

    public function clearAll(): void
    {
        $this->reset(['country', 'region', 'delegates']);
    }

    public function render()
    {
        $query = MiceContent::active()
            ->with(['destination', 'media'])
            ->ordered();

        // Filter by country (destination)
        if ($this->country) {
            $query->whereHas('destination', fn($q) => $q->where('slug', $this->country));
        }

        // Filter by region
        if ($this->region) {
            $query->where('region', $this->region);
        }

        // Filter by delegates
        if ($this->delegates) {
            $delegateCount = $this->parseDelegates($this->delegates);
            if ($delegateCount) {
                $query->forDelegates($delegateCount);
            }
        }

        $contents = $query->get();

        // Get destinations for country tabs
        $destinations = Destination::active()
            ->ordered()
            ->whereHas('miceContents', fn($q) => $q->active())
            ->get();

        // Get regions for current country
        $regionsQuery = MiceContent::active()
            ->whereNotNull('region')
            ->where('region', '!=', '');

        if ($this->country) {
            $regionsQuery->whereHas('destination', fn($q) => $q->where('slug', $this->country));
        }

        $regions = $regionsQuery->distinct()->pluck('region')->sort()->values();

        $hasFilters = $this->region || $this->delegates;
        $hasAnyFilters = $this->country || $this->region || $this->delegates;

        return view('livewire.mice-filter', [
            'contents' => $contents,
            'destinations' => $destinations,
            'regions' => $regions,
            'hasFilters' => $hasFilters,
            'hasAnyFilters' => $hasAnyFilters,
        ]);
    }

    private function parseDelegates(string $range): ?int
    {
        return match($range) {
            '10-50' => 30,
            '50-100' => 75,
            '100-300' => 200,
            '300-500' => 400,
            '500+' => 500,
            default => null,
        };
    }
}
