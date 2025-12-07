<?php

namespace Database\Seeders;

use App\Models\MiceContent;
use Illuminate\Database\Seeder;

class MiceContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $miceContents = [
            // Vietnam
            [
                'destination_id' => 1,
                'region' => 'Ho Chi Minh City',
                'title' => [
                    'en' => 'Saigon Convention Center',
                    'vi' => 'Trung tâm Hội nghị Sài Gòn',
                ],
                'subtitle' => [
                    'en' => 'Premier MICE venue in the heart of Vietnam\'s business capital',
                    'vi' => 'Địa điểm MICE hàng đầu tại trung tâm thủ đô kinh doanh Việt Nam',
                ],
                'description' => [
                    'en' => '<p>Experience world-class corporate events at Saigon Convention Center, offering state-of-the-art facilities and unparalleled service in the vibrant heart of Ho Chi Minh City.</p><p>Our venue features multiple flexible spaces, cutting-edge technology, and a dedicated team of event professionals.</p>',
                    'vi' => '<p>Trải nghiệm các sự kiện doanh nghiệp đẳng cấp thế giới tại Trung tâm Hội nghị Sài Gòn, với cơ sở vật chất hiện đại và dịch vụ tuyệt vời tại trung tâm sôi động của TP.HCM.</p>',
                ],
                'min_delegates' => 50,
                'max_delegates' => 2000,
                'venue_features' => ['Conference Rooms', 'Exhibition Halls', 'Banquet Facilities', 'Business Center', 'Auditorium'],
                'services_included' => ['Catering', 'AV Equipment', 'Event Planning', 'Transportation'],
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'destination_id' => 1,
                'region' => 'Hanoi',
                'title' => [
                    'en' => 'Hanoi International Convention Center',
                    'vi' => 'Trung tâm Hội nghị Quốc tế Hà Nội',
                ],
                'subtitle' => [
                    'en' => 'Historic elegance meets modern conference facilities',
                    'vi' => 'Sự thanh lịch lịch sử kết hợp cơ sở hội nghị hiện đại',
                ],
                'description' => [
                    'en' => '<p>Set against the backdrop of Vietnam\'s historic capital, our convention center combines traditional Vietnamese hospitality with world-class meeting facilities.</p>',
                    'vi' => '<p>Nằm trong bối cảnh thủ đô lịch sử của Việt Nam, trung tâm hội nghị của chúng tôi kết hợp sự hiếu khách truyền thống Việt Nam với cơ sở họp đẳng cấp thế giới.</p>',
                ],
                'min_delegates' => 30,
                'max_delegates' => 1500,
                'venue_features' => ['Conference Rooms', 'Ballroom', 'Outdoor Venues', 'Breakout Rooms'],
                'services_included' => ['Catering', 'Interpretation', 'Event Planning'],
                'is_featured' => false,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'destination_id' => 1,
                'region' => 'Da Nang',
                'title' => [
                    'en' => 'Da Nang Beach Resort & Convention',
                    'vi' => 'Resort Biển & Hội nghị Đà Nẵng',
                ],
                'subtitle' => [
                    'en' => 'Beachfront meetings with breathtaking ocean views',
                    'vi' => 'Họp mặt bên bờ biển với tầm nhìn đại dương ngoạn mục',
                ],
                'description' => [
                    'en' => '<p>Combine business with pleasure at our stunning beachfront resort. Perfect for incentive trips and corporate retreats with team-building activities.</p>',
                    'vi' => '<p>Kết hợp công việc với giải trí tại resort bờ biển tuyệt đẹp. Hoàn hảo cho chuyến du lịch khuyến thưởng và nghỉ dưỡng doanh nghiệp.</p>',
                ],
                'min_delegates' => 20,
                'max_delegates' => 500,
                'venue_features' => ['Beachfront Venue', 'Conference Rooms', 'Outdoor Venues', 'Spa'],
                'services_included' => ['Team Building', 'Accommodation', 'Catering', 'Water Sports'],
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],

            // Thailand
            [
                'destination_id' => 2,
                'region' => 'Bangkok',
                'title' => [
                    'en' => 'Bangkok Grand Convention Center',
                    'vi' => 'Trung tâm Hội nghị Lớn Bangkok',
                ],
                'subtitle' => [
                    'en' => 'Southeast Asia\'s premier MICE destination',
                    'vi' => 'Điểm đến MICE hàng đầu Đông Nam Á',
                ],
                'description' => [
                    'en' => '<p>Bangkok Grand Convention Center offers the largest and most sophisticated event space in Thailand, perfect for international conferences and exhibitions.</p>',
                    'vi' => '<p>Trung tâm Hội nghị Lớn Bangkok cung cấp không gian sự kiện lớn nhất và tinh vi nhất Thái Lan.</p>',
                ],
                'min_delegates' => 100,
                'max_delegates' => 5000,
                'venue_features' => ['Exhibition Halls', 'Conference Rooms', 'Auditorium', 'VIP Lounges', 'Press Center'],
                'services_included' => ['Catering', 'AV Equipment', 'Security', 'Registration', 'Transportation'],
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'destination_id' => 2,
                'region' => 'Phuket',
                'title' => [
                    'en' => 'Phuket Island Resort MICE',
                    'vi' => 'MICE Resort Đảo Phuket',
                ],
                'subtitle' => [
                    'en' => 'Tropical paradise for incentive travel',
                    'vi' => 'Thiên đường nhiệt đới cho du lịch khuyến thưởng',
                ],
                'description' => [
                    'en' => '<p>Reward your team with an unforgettable experience in Phuket. Our resort combines luxury accommodations with versatile meeting spaces.</p>',
                    'vi' => '<p>Thưởng cho đội ngũ của bạn với trải nghiệm khó quên ở Phuket. Resort kết hợp chỗ ở sang trọng với không gian họp đa năng.</p>',
                ],
                'min_delegates' => 20,
                'max_delegates' => 300,
                'venue_features' => ['Beach Venue', 'Conference Rooms', 'Pool Deck', 'Spa & Wellness'],
                'services_included' => ['Team Building', 'Island Tours', 'Water Activities', 'Gala Dinner'],
                'is_featured' => false,
                'is_active' => true,
                'order' => 2,
            ],

            // Cambodia
            [
                'destination_id' => 3,
                'region' => 'Siem Reap',
                'title' => [
                    'en' => 'Angkor Conference & Events',
                    'vi' => 'Hội nghị & Sự kiện Angkor',
                ],
                'subtitle' => [
                    'en' => 'Where ancient wonders meet modern business',
                    'vi' => 'Nơi kỳ quan cổ đại gặp gỡ kinh doanh hiện đại',
                ],
                'description' => [
                    'en' => '<p>Host your event against the magnificent backdrop of Angkor Wat. Unique venues combining Khmer heritage with contemporary facilities.</p>',
                    'vi' => '<p>Tổ chức sự kiện với bối cảnh tuyệt vời của Angkor Wat. Địa điểm độc đáo kết hợp di sản Khmer với cơ sở hiện đại.</p>',
                ],
                'min_delegates' => 30,
                'max_delegates' => 800,
                'venue_features' => ['Temple Tours', 'Conference Rooms', 'Outdoor Venues', 'Cultural Shows'],
                'services_included' => ['Cultural Experiences', 'Catering', 'Temple Access', 'Photography'],
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],

            // Singapore
            [
                'destination_id' => 8,
                'region' => 'Marina Bay',
                'title' => [
                    'en' => 'Marina Bay Sands MICE',
                    'vi' => 'MICE Marina Bay Sands',
                ],
                'subtitle' => [
                    'en' => 'Iconic venue for world-class events',
                    'vi' => 'Địa điểm mang tính biểu tượng cho sự kiện đẳng cấp',
                ],
                'description' => [
                    'en' => '<p>Experience the pinnacle of MICE facilities at Marina Bay Sands. Our integrated resort offers seamless event experiences.</p>',
                    'vi' => '<p>Trải nghiệm đỉnh cao cơ sở MICE tại Marina Bay Sands. Resort tích hợp mang đến trải nghiệm sự kiện liền mạch.</p>',
                ],
                'min_delegates' => 50,
                'max_delegates' => 10000,
                'venue_features' => ['Exhibition Halls', 'Conference Rooms', 'Ballroom', 'Rooftop Venue', 'Theater'],
                'services_included' => ['Catering', 'AV Equipment', 'Event Planning', 'VIP Services', 'Entertainment'],
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'destination_id' => 8,
                'region' => 'Sentosa',
                'title' => [
                    'en' => 'Sentosa Island Corporate Retreats',
                    'vi' => 'Nghỉ dưỡng Doanh nghiệp Đảo Sentosa',
                ],
                'subtitle' => [
                    'en' => 'Island escape for team bonding and incentives',
                    'vi' => 'Kỳ nghỉ đảo cho gắn kết đội nhóm và khuyến thưởng',
                ],
                'description' => [
                    'en' => '<p>Sentosa Island offers the perfect blend of work and play. From beach activities to adventure sports, create lasting memories.</p>',
                    'vi' => '<p>Đảo Sentosa mang đến sự kết hợp hoàn hảo giữa công việc và vui chơi. Tạo kỷ niệm khó phai.</p>',
                ],
                'min_delegates' => 15,
                'max_delegates' => 200,
                'venue_features' => ['Beach Club', 'Golf Course', 'Conference Rooms', 'Theme Parks'],
                'services_included' => ['Team Building', 'Adventure Activities', 'Golf Events', 'Beach Parties'],
                'is_featured' => false,
                'is_active' => true,
                'order' => 2,
            ],

            // Malaysia
            [
                'destination_id' => 7,
                'region' => 'Kuala Lumpur',
                'title' => [
                    'en' => 'Kuala Lumpur Convention Centre',
                    'vi' => 'Trung tâm Hội nghị Kuala Lumpur',
                ],
                'subtitle' => [
                    'en' => 'Award-winning venue in the heart of KL',
                    'vi' => 'Địa điểm đạt giải thưởng tại trung tâm KL',
                ],
                'description' => [
                    'en' => '<p>The award-winning Kuala Lumpur Convention Centre is Malaysia\'s premier purpose-built convention and exhibition center.</p>',
                    'vi' => '<p>Trung tâm Hội nghị Kuala Lumpur đạt giải thưởng là trung tâm hội nghị và triển lãm hàng đầu Malaysia.</p>',
                ],
                'min_delegates' => 100,
                'max_delegates' => 3000,
                'venue_features' => ['Exhibition Halls', 'Plenary Hall', 'Conference Rooms', 'Banquet Hall'],
                'services_included' => ['Catering', 'AV Equipment', 'Event Management', 'Security'],
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],

            // India
            [
                'destination_id' => 6,
                'region' => 'Mumbai',
                'title' => [
                    'en' => 'Mumbai World Trade Centre',
                    'vi' => 'Trung tâm Thương mại Thế giới Mumbai',
                ],
                'subtitle' => [
                    'en' => 'India\'s gateway for international MICE',
                    'vi' => 'Cửa ngõ Ấn Độ cho MICE quốc tế',
                ],
                'description' => [
                    'en' => '<p>Mumbai World Trade Centre combines strategic location with world-class infrastructure for successful corporate events.</p>',
                    'vi' => '<p>Trung tâm Thương mại Thế giới Mumbai kết hợp vị trí chiến lược với cơ sở hạ tầng đẳng cấp.</p>',
                ],
                'min_delegates' => 50,
                'max_delegates' => 2000,
                'venue_features' => ['Exhibition Center', 'Conference Halls', 'Business Suites', 'Networking Lounges'],
                'services_included' => ['Catering', 'Technical Support', 'Business Services', 'Translation'],
                'is_featured' => false,
                'is_active' => true,
                'order' => 1,
            ],
        ];

        foreach ($miceContents as $content) {
            MiceContent::create($content);
        }

        $this->command->info('Seeded ' . count($miceContents) . ' MICE contents successfully!');
    }
}
