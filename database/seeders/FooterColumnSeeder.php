<?php

namespace Database\Seeders;

use App\Models\FooterColumn;
use Illuminate\Database\Seeder;

class FooterColumnSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing footer columns
        FooterColumn::truncate();

        $columns = [
            [
                'title' => ['en' => 'Company', 'vi' => 'Công ty'],
                'type' => FooterColumn::TYPE_LOGO_CONTACT,
                'order' => 0,
                'width' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Destinations', 'vi' => 'Điểm đến'],
                'type' => FooterColumn::TYPE_DESTINATIONS,
                'order' => 1,
                'width' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Quick Links', 'vi' => 'Liên kết nhanh'],
                'type' => FooterColumn::TYPE_MENU_LINKS,
                'order' => 2,
                'width' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Newsletter', 'vi' => 'Đăng ký nhận tin'],
                'type' => FooterColumn::TYPE_NEWSLETTER_SOCIAL,
                'order' => 3,
                'width' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($columns as $column) {
            FooterColumn::create($column);
        }

        $this->command->info('Footer columns seeded successfully!');
    }
}
