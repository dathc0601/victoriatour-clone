<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [
            'vietnam' => [
                [
                    'name' => ['en' => 'Vinpearl Resort & Spa Ha Long', 'vi' => 'Vinpearl Resort & Spa Hạ Long'],
                    'address' => ['en' => 'Area 2, Ha Long street, Bai Chay ward', 'vi' => 'Khu 2, đường Hạ Long, phường Bãi Cháy'],
                    'rating' => 5.0,
                    'price' => 250,
                    'room_types' => [['name' => 'Deluxe Room', 'capacity' => 2], ['name' => 'Suite', 'capacity' => 4]],
                    'amenities' => ['WiFi', 'Swimming Pool', 'Spa', 'Restaurant', 'Room Service'],
                ],
                [
                    'name' => ['en' => 'InterContinental Danang Sun Peninsula', 'vi' => 'InterContinental Đà Nẵng Sun Peninsula'],
                    'address' => ['en' => 'Bai Bac, Son Tra Peninsula, Danang', 'vi' => 'Bãi Bắc, Bán đảo Sơn Trà, Đà Nẵng'],
                    'rating' => 5.0,
                    'price' => 350,
                    'room_types' => [['name' => 'Classic Room', 'capacity' => 2], ['name' => 'Ocean View Suite', 'capacity' => 3]],
                    'amenities' => ['WiFi', 'Private Beach', 'Spa', 'Restaurant', 'Gym', 'Airport Shuttle'],
                ],
                [
                    'name' => ['en' => 'JW Marriott Phu Quoc', 'vi' => 'JW Marriott Phú Quốc'],
                    'address' => ['en' => 'Bai Dai Beach, Phu Quoc Island', 'vi' => 'Bãi Dài, Đảo Phú Quốc'],
                    'rating' => 4.9,
                    'price' => 280,
                    'room_types' => [['name' => 'Garden View', 'capacity' => 2], ['name' => 'Beach Villa', 'capacity' => 4]],
                    'amenities' => ['WiFi', 'Swimming Pool', 'Spa', 'Restaurant', 'Water Sports'],
                ],
                [
                    'name' => ['en' => 'Park Hyatt Saigon', 'vi' => 'Park Hyatt Sài Gòn'],
                    'address' => ['en' => '2 Lam Son Square, District 1, Ho Chi Minh City', 'vi' => '2 Công trường Lam Sơn, Quận 1, TP.HCM'],
                    'rating' => 4.8,
                    'price' => 320,
                    'room_types' => [['name' => 'Park Room', 'capacity' => 2], ['name' => 'Park Suite', 'capacity' => 3]],
                    'amenities' => ['WiFi', 'Swimming Pool', 'Spa', 'Restaurant', 'Gym', 'Parking'],
                ],
            ],
            'thailand' => [
                [
                    'name' => ['en' => 'Mandarin Oriental Bangkok', 'vi' => 'Mandarin Oriental Bangkok'],
                    'address' => ['en' => '48 Oriental Avenue, Bangkok', 'vi' => '48 Đại lộ Oriental, Bangkok'],
                    'rating' => 5.0,
                    'price' => 380,
                    'room_types' => [['name' => 'Superior Room', 'capacity' => 2], ['name' => 'River Suite', 'capacity' => 3]],
                    'amenities' => ['WiFi', 'Swimming Pool', 'Spa', 'Restaurant', 'River View'],
                ],
                [
                    'name' => ['en' => 'Banyan Tree Phuket', 'vi' => 'Banyan Tree Phuket'],
                    'address' => ['en' => '33 Moo 4, Srisoonthorn Road, Phuket', 'vi' => '33 Moo 4, Đường Srisoonthorn, Phuket'],
                    'rating' => 4.9,
                    'price' => 290,
                    'room_types' => [['name' => 'Pool Villa', 'capacity' => 2], ['name' => 'Spa Sanctuary', 'capacity' => 4]],
                    'amenities' => ['WiFi', 'Private Pool', 'Spa', 'Restaurant', 'Golf Course'],
                ],
            ],
            'cambodia' => [
                [
                    'name' => ['en' => 'Sofitel Angkor Phokeethra', 'vi' => 'Sofitel Angkor Phokeethra'],
                    'address' => ['en' => 'Vithei Charles de Gaulle, Siem Reap', 'vi' => 'Đường Charles de Gaulle, Siem Reap'],
                    'rating' => 4.8,
                    'price' => 180,
                    'room_types' => [['name' => 'Superior Room', 'capacity' => 2], ['name' => 'Opera Suite', 'capacity' => 3]],
                    'amenities' => ['WiFi', 'Swimming Pool', 'Spa', 'Restaurant', 'Temple Tours'],
                ],
                [
                    'name' => ['en' => 'Rosewood Phnom Penh', 'vi' => 'Rosewood Phnom Penh'],
                    'address' => ['en' => 'Vattanac Capital Tower, Phnom Penh', 'vi' => 'Tháp Vattanac Capital, Phnom Penh'],
                    'rating' => 4.9,
                    'price' => 220,
                    'room_types' => [['name' => 'Deluxe Room', 'capacity' => 2], ['name' => 'Manor House Suite', 'capacity' => 4]],
                    'amenities' => ['WiFi', 'Swimming Pool', 'Spa', 'Restaurant', 'City View'],
                ],
            ],
        ];

        foreach ($hotels as $slug => $hotelList) {
            $destination = Destination::where('slug', $slug)->first();
            if (!$destination) continue;

            foreach ($hotelList as $index => $hotelData) {
                Hotel::create([
                    'destination_id' => $destination->id,
                    'name' => $hotelData['name'],
                    'address' => $hotelData['address'],
                    'description' => [
                        'en' => "Experience luxury at {$hotelData['name']['en']}. Perfect for travelers seeking comfort and elegance.",
                        'vi' => "Trải nghiệm sang trọng tại {$hotelData['name']['vi']}. Hoàn hảo cho du khách tìm kiếm sự thoải mái và thanh lịch.",
                    ],
                    'rating' => $hotelData['rating'],
                    'price_per_night' => $hotelData['price'],
                    'room_types' => $hotelData['room_types'],
                    'amenities' => $hotelData['amenities'],
                    'is_featured' => $index < 2,
                    'is_active' => true,
                    'order' => $index,
                ]);
            }
        }
    }
}
