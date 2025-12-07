<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = BlogCategory::pluck('id')->toArray();

        $posts = [
            // Travel Tips (Category 1)
            [
                'title' => ['en' => '10 Essential Packing Tips for Southeast Asia', 'vi' => '10 Mẹo Đóng Gói Cần Thiết Cho Đông Nam Á'],
                'excerpt' => ['en' => 'Master the art of packing light while staying prepared for tropical adventures.', 'vi' => 'Nắm vững nghệ thuật đóng gói gọn nhẹ trong khi vẫn sẵn sàng cho những chuyến phiêu lưu nhiệt đới.'],
                'category_id' => 1,
                'is_featured' => true,
            ],
            [
                'title' => ['en' => 'Best Time to Visit Vietnam: A Complete Guide', 'vi' => 'Thời Điểm Tốt Nhất Để Thăm Việt Nam: Hướng Dẫn Đầy Đủ'],
                'excerpt' => ['en' => 'Plan your perfect trip with our month-by-month weather breakdown.', 'vi' => 'Lên kế hoạch cho chuyến đi hoàn hảo với phân tích thời tiết từng tháng.'],
                'category_id' => 1,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'How to Get Around Vietnam Like a Local', 'vi' => 'Cách Di Chuyển Ở Việt Nam Như Người Địa Phương'],
                'excerpt' => ['en' => 'From motorbikes to trains, discover the best transportation options.', 'vi' => 'Từ xe máy đến tàu hỏa, khám phá các phương tiện di chuyển tốt nhất.'],
                'category_id' => 1,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Budget Travel Tips for Backpacking Vietnam', 'vi' => 'Mẹo Du Lịch Tiết Kiệm Khi Đi Bụi Việt Nam'],
                'excerpt' => ['en' => 'Stretch your dong further with these money-saving strategies.', 'vi' => 'Tiết kiệm tiền hơn với những chiến lược tiết kiệm này.'],
                'category_id' => 1,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Vietnam Visa Guide 2025: Everything You Need to Know', 'vi' => 'Hướng Dẫn Visa Việt Nam 2025: Mọi Thứ Bạn Cần Biết'],
                'excerpt' => ['en' => 'Navigate the visa process with our comprehensive guide.', 'vi' => 'Điều hướng quy trình visa với hướng dẫn toàn diện của chúng tôi.'],
                'category_id' => 1,
                'is_featured' => true,
            ],

            // Destinations (Category 2)
            [
                'title' => ['en' => 'Ha Long Bay: The Ultimate Travel Guide', 'vi' => 'Vịnh Hạ Long: Hướng Dẫn Du Lịch Toàn Diện'],
                'excerpt' => ['en' => 'Explore the stunning limestone karsts and emerald waters of this UNESCO site.', 'vi' => 'Khám phá những núi đá vôi tuyệt đẹp và vùng nước ngọc lục bảo của di sản UNESCO này.'],
                'category_id' => 2,
                'is_featured' => true,
            ],
            [
                'title' => ['en' => 'Hidden Gems of Hoi An: Beyond the Ancient Town', 'vi' => 'Những Viên Ngọc Ẩn Của Hội An: Ngoài Phố Cổ'],
                'excerpt' => ['en' => 'Discover secret spots that most tourists miss in this charming city.', 'vi' => 'Khám phá những địa điểm bí mật mà hầu hết du khách bỏ lỡ trong thành phố quyến rũ này.'],
                'category_id' => 2,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Sapa Trekking: Routes, Tips, and What to Expect', 'vi' => 'Trekking Sapa: Lộ Trình, Mẹo Và Những Gì Nên Mong Đợi'],
                'excerpt' => ['en' => 'Everything you need for an unforgettable mountain adventure.', 'vi' => 'Mọi thứ bạn cần cho một chuyến phiêu lưu núi khó quên.'],
                'category_id' => 2,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Phu Quoc Island: Paradise Found', 'vi' => 'Đảo Phú Quốc: Thiên Đường Được Tìm Thấy'],
                'excerpt' => ['en' => 'Sun, sand, and seafood on Vietnam\'s largest island.', 'vi' => 'Nắng, cát và hải sản trên hòn đảo lớn nhất Việt Nam.'],
                'category_id' => 2,
                'is_featured' => true,
            ],
            [
                'title' => ['en' => 'Da Nang: The City That Has It All', 'vi' => 'Đà Nẵng: Thành Phố Có Tất Cả'],
                'excerpt' => ['en' => 'Beaches, mountains, and modern attractions in one destination.', 'vi' => 'Biển, núi và các điểm tham quan hiện đại trong một điểm đến.'],
                'category_id' => 2,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Ninh Binh: Vietnam\'s Hidden Treasure', 'vi' => 'Ninh Bình: Kho Báu Ẩn Của Việt Nam'],
                'excerpt' => ['en' => 'Explore the stunning landscapes of "Ha Long Bay on land".', 'vi' => 'Khám phá cảnh quan tuyệt đẹp của "Vịnh Hạ Long trên cạn".'],
                'category_id' => 2,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Mekong Delta: Life on the Water', 'vi' => 'Đồng Bằng Sông Cửu Long: Cuộc Sống Trên Nước'],
                'excerpt' => ['en' => 'Experience floating markets and river life in southern Vietnam.', 'vi' => 'Trải nghiệm chợ nổi và cuộc sống sông nước ở miền Nam Việt Nam.'],
                'category_id' => 2,
                'is_featured' => false,
            ],

            // Culture & History (Category 3)
            [
                'title' => ['en' => 'The Ancient Temples of Angkor Wat', 'vi' => 'Những Ngôi Đền Cổ Angkor Wat'],
                'excerpt' => ['en' => 'Journey through the magnificent ruins of the Khmer Empire.', 'vi' => 'Hành trình qua những tàn tích tráng lệ của Đế chế Khmer.'],
                'category_id' => 3,
                'is_featured' => true,
            ],
            [
                'title' => ['en' => 'Vietnamese Water Puppetry: A Living Tradition', 'vi' => 'Múa Rối Nước Việt Nam: Truyền Thống Sống'],
                'excerpt' => ['en' => 'Discover the unique art form that dates back 1,000 years.', 'vi' => 'Khám phá loại hình nghệ thuật độc đáo có lịch sử 1.000 năm.'],
                'category_id' => 3,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'The Imperial City of Hue: A Royal Journey', 'vi' => 'Kinh Thành Huế: Hành Trình Hoàng Gia'],
                'excerpt' => ['en' => 'Walk through the former capital of the Nguyen Dynasty.', 'vi' => 'Đi bộ qua cố đô của triều Nguyễn.'],
                'category_id' => 3,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Understanding Vietnamese Festivals', 'vi' => 'Tìm Hiểu Các Lễ Hội Việt Nam'],
                'excerpt' => ['en' => 'From Tet to Mid-Autumn, explore Vietnam\'s vibrant celebrations.', 'vi' => 'Từ Tết đến Trung Thu, khám phá những lễ hội sôi động của Việt Nam.'],
                'category_id' => 3,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'The Cu Chi Tunnels: Underground History', 'vi' => 'Địa Đạo Củ Chi: Lịch Sử Dưới Lòng Đất'],
                'excerpt' => ['en' => 'Explore the incredible tunnel network from the Vietnam War era.', 'vi' => 'Khám phá hệ thống đường hầm đáng kinh ngạc từ thời chiến tranh Việt Nam.'],
                'category_id' => 3,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Traditional Vietnamese Architecture', 'vi' => 'Kiến Trúc Truyền Thống Việt Nam'],
                'excerpt' => ['en' => 'From pagodas to communal houses, discover Vietnam\'s building heritage.', 'vi' => 'Từ chùa đến đình làng, khám phá di sản kiến trúc Việt Nam.'],
                'category_id' => 3,
                'is_featured' => false,
            ],

            // Cuisine (Category 4)
            [
                'title' => ['en' => 'The Ultimate Guide to Vietnamese Pho', 'vi' => 'Hướng Dẫn Toàn Diện Về Phở Việt Nam'],
                'excerpt' => ['en' => 'Everything you need to know about Vietnam\'s most famous soup.', 'vi' => 'Mọi thứ bạn cần biết về món súp nổi tiếng nhất Việt Nam.'],
                'category_id' => 4,
                'is_featured' => true,
            ],
            [
                'title' => ['en' => 'Street Food Tour: Hanoi\'s Best Bites', 'vi' => 'Tour Ẩm Thực Đường Phố: Những Món Ngon Nhất Hà Nội'],
                'excerpt' => ['en' => 'Navigate the bustling streets for authentic local flavors.', 'vi' => 'Điều hướng những con phố nhộn nhịp để thưởng thức hương vị địa phương đích thực.'],
                'category_id' => 4,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Banh Mi: The Perfect Vietnamese Sandwich', 'vi' => 'Bánh Mì: Chiếc Sandwich Hoàn Hảo Của Việt Nam'],
                'excerpt' => ['en' => 'How French colonialism created Vietnam\'s most portable meal.', 'vi' => 'Cách chủ nghĩa thực dân Pháp tạo ra món ăn di động nhất của Việt Nam.'],
                'category_id' => 4,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Vietnamese Coffee Culture Explained', 'vi' => 'Văn Hóa Cà Phê Việt Nam Được Giải Thích'],
                'excerpt' => ['en' => 'From ca phe sua da to egg coffee, discover Vietnam\'s caffeine scene.', 'vi' => 'Từ cà phê sữa đá đến cà phê trứng, khám phá thế giới caffeine Việt Nam.'],
                'category_id' => 4,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Cooking Classes in Vietnam: Where to Learn', 'vi' => 'Lớp Học Nấu Ăn Ở Việt Nam: Nơi Học Tập'],
                'excerpt' => ['en' => 'Roll up your sleeves and master Vietnamese cuisine.', 'vi' => 'Xắn tay áo lên và làm chủ ẩm thực Việt Nam.'],
                'category_id' => 4,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Regional Food Differences in Vietnam', 'vi' => 'Sự Khác Biệt Ẩm Thực Vùng Miền Ở Việt Nam'],
                'excerpt' => ['en' => 'North, Central, and South: Three distinct culinary traditions.', 'vi' => 'Bắc, Trung, Nam: Ba truyền thống ẩm thực riêng biệt.'],
                'category_id' => 4,
                'is_featured' => false,
            ],

            // Adventure Stories (Category 5)
            [
                'title' => ['en' => 'Conquering Fansipan: Vietnam\'s Highest Peak', 'vi' => 'Chinh Phục Fansipan: Đỉnh Cao Nhất Việt Nam'],
                'excerpt' => ['en' => 'My journey to the "Roof of Indochina" and what I learned.', 'vi' => 'Hành trình của tôi đến "Nóc nhà Đông Dương" và những gì tôi học được.'],
                'category_id' => 5,
                'is_featured' => true,
            ],
            [
                'title' => ['en' => 'Motorbike Adventure: Hai Van Pass', 'vi' => 'Phiêu Lưu Xe Máy: Đèo Hải Vân'],
                'excerpt' => ['en' => 'Riding one of the world\'s most scenic coastal roads.', 'vi' => 'Lái xe trên một trong những con đường ven biển đẹp nhất thế giới.'],
                'category_id' => 5,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Kayaking Through Ha Long Bay', 'vi' => 'Chèo Kayak Qua Vịnh Hạ Long'],
                'excerpt' => ['en' => 'An intimate way to explore the limestone karsts.', 'vi' => 'Cách thân mật để khám phá những núi đá vôi.'],
                'category_id' => 5,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Caving in Phong Nha: Into the Darkness', 'vi' => 'Khám Phá Hang Động Phong Nha: Vào Bóng Tối'],
                'excerpt' => ['en' => 'Exploring some of the world\'s largest cave systems.', 'vi' => 'Khám phá một số hệ thống hang động lớn nhất thế giới.'],
                'category_id' => 5,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Scuba Diving in Nha Trang', 'vi' => 'Lặn Biển Ở Nha Trang'],
                'excerpt' => ['en' => 'Discover the underwater world of Vietnam\'s diving capital.', 'vi' => 'Khám phá thế giới dưới nước của thủ đô lặn Việt Nam.'],
                'category_id' => 5,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Cycling the Vietnamese Countryside', 'vi' => 'Đạp Xe Ở Vùng Quê Việt Nam'],
                'excerpt' => ['en' => 'Slow travel through rice paddies and rural villages.', 'vi' => 'Du lịch chậm qua những cánh đồng lúa và làng quê.'],
                'category_id' => 5,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Homestay Experiences in Ethnic Villages', 'vi' => 'Trải Nghiệm Homestay Ở Làng Dân Tộc'],
                'excerpt' => ['en' => 'Living with local families in the northern highlands.', 'vi' => 'Sống cùng gia đình địa phương ở vùng cao phía Bắc.'],
                'category_id' => 5,
                'is_featured' => false,
            ],
            [
                'title' => ['en' => 'Night Markets of Southeast Asia', 'vi' => 'Chợ Đêm Đông Nam Á'],
                'excerpt' => ['en' => 'A sensory adventure through Asia\'s most vibrant markets.', 'vi' => 'Cuộc phiêu lưu giác quan qua những khu chợ sôi động nhất châu Á.'],
                'category_id' => 5,
                'is_featured' => false,
            ],
        ];

        $baseDate = Carbon::now();

        foreach ($posts as $index => $postData) {
            $publishedAt = $baseDate->copy()->subDays($index * 3 + rand(0, 2));

            $content = $this->generateContent($postData['title']['en'], $postData['excerpt']['en']);

            BlogPost::create([
                'blog_category_id' => $postData['category_id'],
                'title' => $postData['title'],
                'excerpt' => $postData['excerpt'],
                'content' => [
                    'en' => $content,
                    'vi' => $content, // Same content for simplicity
                ],
                'author' => $this->getRandomAuthor(),
                'published_at' => $publishedAt,
                'is_featured' => $postData['is_featured'],
                'is_active' => true,
            ]);
        }

        $this->command->info('Created ' . count($posts) . ' blog posts successfully!');
    }

    private function generateContent(string $title, string $excerpt): string
    {
        return "
<p class=\"lead\">{$excerpt}</p>

<h2>Introduction</h2>
<p>Southeast Asia has long been a magnet for travelers seeking adventure, culture, and natural beauty. In this comprehensive guide, we'll explore everything you need to know about {$title}.</p>

<p>Whether you're a first-time visitor or a seasoned traveler, there's always something new to discover in this fascinating region. From bustling cities to tranquil countryside, the diversity of experiences is truly remarkable.</p>

<h2>What Makes This Special</h2>
<p>The unique combination of ancient traditions and modern development creates an atmosphere unlike anywhere else in the world. Local communities have preserved their cultural heritage while embracing sustainable tourism practices.</p>

<blockquote>
\"Travel is the only thing you buy that makes you richer.\" - Anonymous
</blockquote>

<p>This sentiment perfectly captures the essence of exploring Southeast Asia. Every journey here becomes a transformative experience that stays with you long after you return home.</p>

<h2>Practical Tips</h2>
<ul>
<li>Best time to visit is during the dry season (November to April)</li>
<li>Learn a few basic phrases in the local language</li>
<li>Respect local customs and dress modestly at religious sites</li>
<li>Bargaining is expected at markets but do so respectfully</li>
<li>Stay hydrated and protect yourself from the sun</li>
</ul>

<h2>Getting There</h2>
<p>Major international airports serve as gateways to the region, with frequent connections from cities worldwide. Once you arrive, a well-developed network of domestic flights, trains, and buses makes getting around surprisingly easy.</p>

<p>For the more adventurous, renting a motorbike offers unparalleled freedom to explore at your own pace. Just remember to always wear a helmet and drive defensively.</p>

<h2>Where to Stay</h2>
<p>Accommodation options range from budget-friendly hostels to world-class luxury resorts. Homestays offer an authentic glimpse into local life and are highly recommended for cultural immersion.</p>

<h2>Final Thoughts</h2>
<p>No matter how you choose to experience this destination, you're sure to create memories that last a lifetime. The warmth of the local people, the richness of the culture, and the beauty of the landscapes combine to create truly unforgettable journeys.</p>

<p>Start planning your adventure today and discover why millions of travelers fall in love with Southeast Asia every year.</p>
";
    }

    private function getRandomAuthor(): string
    {
        $authors = [
            'Victoria Tour Team',
            'Minh Nguyen',
            'Sarah Johnson',
            'David Chen',
            'Linh Tran',
            'Michael Roberts',
        ];

        return $authors[array_rand($authors)];
    }
}
