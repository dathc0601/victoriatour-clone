<?php

use App\Models\MenuItem;
use Illuminate\Support\Collection;

if (!function_exists('navigation')) {
    /**
     * Get navigation menu items by location.
     *
     * @param string $location The menu location ('header' or 'footer')
     * @return Collection
     */
    function navigation(string $location = 'header'): Collection
    {
        return MenuItem::getTreeByLocation($location);
    }
}

if (!function_exists('menu_url')) {
    /**
     * Get the URL for a menu item.
     *
     * @param MenuItem $item
     * @return string|null
     */
    function menu_url(MenuItem $item): ?string
    {
        return $item->getUrl();
    }
}
