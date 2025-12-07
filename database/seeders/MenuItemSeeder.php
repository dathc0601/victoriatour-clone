<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing menu items
        MenuItem::truncate();

        // Header Menu Items
        $headerItems = [
            [
                'title' => ['en' => 'About Us', 'vi' => 'Giới thiệu'],
                'type' => 'url',
                'url' => '/about-us',
                'icon' => 'heroicon-o-information-circle',
            ],
            [
                'title' => ['en' => 'Destinations', 'vi' => 'Điểm đến'],
                'type' => 'route',
                'route_name' => 'destinations.index',
                'icon' => 'heroicon-o-globe-alt',
            ],
            [
                'title' => ['en' => 'Blog', 'vi' => 'Blog'],
                'type' => 'route',
                'route_name' => 'blog.index',
                'icon' => 'heroicon-o-newspaper',
            ],
            [
                'title' => ['en' => 'Contact', 'vi' => 'Liên hệ'],
                'type' => 'route',
                'route_name' => 'contact',
                'icon' => 'heroicon-o-envelope',
            ],
            [
                'title' => ['en' => 'MICE', 'vi' => 'MICE'],
                'type' => 'url',
                'url' => '/mice',
                'icon' => 'heroicon-o-building-office',
            ],
        ];

        foreach ($headerItems as $order => $item) {
            MenuItem::create([
                'title' => $item['title'],
                'type' => $item['type'],
                'url' => $item['url'] ?? null,
                'route_name' => $item['route_name'] ?? null,
                'icon' => $item['icon'] ?? null,
                'location' => 'header',
                'order' => $order,
                'parent_id' => -1,
                'is_active' => true,
            ]);
        }

        // Footer Menu Items
        $footerItems = [
            [
                'title' => ['en' => 'About Us', 'vi' => 'Về chúng tôi'],
                'type' => 'url',
                'url' => '/about-us',
            ],
            [
                'title' => ['en' => 'Tours', 'vi' => 'Tour du lịch'],
                'type' => 'route',
                'route_name' => 'tours.index',
            ],
            [
                'title' => ['en' => 'Blog', 'vi' => 'Blog'],
                'type' => 'route',
                'route_name' => 'blog.index',
            ],
            [
                'title' => ['en' => 'Contact', 'vi' => 'Liên hệ'],
                'type' => 'route',
                'route_name' => 'contact',
            ],
            [
                'title' => ['en' => 'Privacy Policy', 'vi' => 'Chính sách bảo mật'],
                'type' => 'url',
                'url' => '/privacy-policy',
            ],
            [
                'title' => ['en' => 'Terms of Service', 'vi' => 'Điều khoản dịch vụ'],
                'type' => 'url',
                'url' => '/terms-of-service',
            ],
        ];

        foreach ($footerItems as $order => $item) {
            MenuItem::create([
                'title' => $item['title'],
                'type' => $item['type'],
                'url' => $item['url'] ?? null,
                'route_name' => $item['route_name'] ?? null,
                'location' => 'footer',
                'order' => $order,
                'parent_id' => -1,
                'is_active' => true,
            ]);
        }

        $this->command->info('Menu items seeded successfully!');
    }
}
