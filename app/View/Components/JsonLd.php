<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class JsonLd extends Component
{
    public array $schema;

    public function __construct(
        public string $type = 'organization',
        public mixed $data = null
    ) {
        $this->schema = $this->generateSchema();
    }

    protected function generateSchema(): array
    {
        return match ($this->type) {
            'organization' => $this->organizationSchema(),
            'tour' => $this->tourSchema(),
            'destination' => $this->destinationSchema(),
            'blog' => $this->blogSchema(),
            'breadcrumb' => $this->breadcrumbSchema(),
            'faq' => $this->faqSchema(),
            default => $this->organizationSchema(),
        };
    }

    protected function organizationSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'TravelAgency',
            'name' => config('app.name', 'Victoria Tour'),
            'url' => config('app.url'),
            'logo' => asset('images/logo.png'),
            'description' => \App\Models\Setting::get('meta_description.en'),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => \App\Models\Setting::get('address', '123 Travel Street'),
                'addressLocality' => 'Ho Chi Minh City',
                'addressCountry' => 'VN',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => \App\Models\Setting::get('contact_phone', '+84 85 692 9229'),
                'email' => \App\Models\Setting::get('email', 'info@victoriatour.com'),
                'contactType' => 'customer service',
            ],
            'sameAs' => array_filter([
                \App\Models\Setting::get('facebook'),
                \App\Models\Setting::get('instagram'),
                \App\Models\Setting::get('youtube'),
            ]),
        ];
    }

    protected function tourSchema(): array
    {
        if (!$this->data) {
            return [];
        }

        $tour = $this->data;

        return [
            '@context' => 'https://schema.org',
            '@type' => 'TouristTrip',
            'name' => $tour->title,
            'description' => strip_tags($tour->excerpt ?? $tour->description),
            'url' => route('tours.show', $tour->slug),
            'image' => $tour->getFirstMediaUrl('featured_image') ?: null,
            'touristType' => 'Leisure',
            'itinerary' => [
                '@type' => 'ItemList',
                'numberOfItems' => $tour->duration_days,
                'itemListElement' => $this->buildItineraryItems($tour),
            ],
            'offers' => [
                '@type' => 'Offer',
                'price' => $tour->price,
                'priceCurrency' => 'USD',
                'availability' => 'https://schema.org/InStock',
                'validFrom' => now()->toIso8601String(),
            ],
            'provider' => [
                '@type' => 'TravelAgency',
                'name' => config('app.name', 'Victoria Tour'),
                'url' => config('app.url'),
            ],
        ];
    }

    protected function buildItineraryItems($tour): array
    {
        $items = [];
        for ($i = 1; $i <= $tour->duration_days; $i++) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $i,
                'name' => "Day {$i}",
            ];
        }
        return $items;
    }

    protected function destinationSchema(): array
    {
        if (!$this->data) {
            return [];
        }

        $destination = $this->data;

        return [
            '@context' => 'https://schema.org',
            '@type' => 'TouristDestination',
            'name' => $destination->name,
            'description' => strip_tags($destination->description ?? ''),
            'url' => route('destinations.show', $destination->slug),
            'image' => $destination->getFirstMediaUrl('image') ?: null,
            'touristType' => 'Leisure',
        ];
    }

    protected function blogSchema(): array
    {
        if (!$this->data) {
            return [];
        }

        $post = $this->data;

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => strip_tags($post->excerpt ?? ''),
            'url' => route('blog.show', $post->slug),
            'image' => $post->image ?: null,
            'datePublished' => $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'Victoria Tour'),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'Victoria Tour'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png'),
                ],
            ],
        ];
    }

    protected function breadcrumbSchema(): array
    {
        if (!$this->data || !is_array($this->data)) {
            return [];
        }

        $items = [];
        foreach ($this->data as $index => $item) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'] ?? null,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }

    protected function faqSchema(): array
    {
        if (!$this->data || !is_array($this->data)) {
            return [];
        }

        $items = [];
        foreach ($this->data as $faq) {
            $items[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $items,
        ];
    }

    public function render(): View
    {
        return view('components.json-ld');
    }
}
