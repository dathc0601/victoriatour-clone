<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Destination;
use App\Models\City;
use App\Models\TourCategory;
use App\Models\Tour;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Differentiator;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@victoriatour.com',
            'password' => bcrypt('password'),
        ]);

        // Languages
        Language::create(['code' => 'en', 'name' => 'English', 'native_name' => 'English', 'is_default' => true, 'order' => 1]);
        Language::create(['code' => 'vi', 'name' => 'Vietnamese', 'native_name' => 'Tiếng Việt', 'is_default' => false, 'order' => 2]);

        // Site Settings
        Setting::set('site_name', ['en' => 'Victoria Tour', 'vi' => 'Victoria Tour'], 'general');
        Setting::set('site_tagline', ['en' => 'Travel Around The World Your Way', 'vi' => 'Du Lịch Theo Cách Của Bạn'], 'general');
        Setting::set('contact_phone', '+84 85 692 9229', 'contact');
        Setting::set('contact_email', 'info@victoriatour.com', 'contact');
        Setting::set('contact_address', ['en' => 'Ho Chi Minh City, Vietnam', 'vi' => 'Thành phố Hồ Chí Minh, Việt Nam'], 'contact');

        // Destinations
        $destinations = [
            ['name' => ['en' => 'Vietnam', 'vi' => 'Việt Nam'], 'slug' => 'vietnam', 'is_featured' => true, 'order' => 1],
            ['name' => ['en' => 'Thailand', 'vi' => 'Thái Lan'], 'slug' => 'thailand', 'is_featured' => true, 'order' => 2],
            ['name' => ['en' => 'Cambodia', 'vi' => 'Campuchia'], 'slug' => 'cambodia', 'is_featured' => true, 'order' => 3],
            ['name' => ['en' => 'Laos', 'vi' => 'Lào'], 'slug' => 'laos', 'is_featured' => false, 'order' => 4],
            ['name' => ['en' => 'Myanmar', 'vi' => 'Myanmar'], 'slug' => 'myanmar', 'is_featured' => false, 'order' => 5],
        ];

        foreach ($destinations as $destData) {
            $dest = Destination::create([
                'name' => $destData['name'],
                'slug' => $destData['slug'],
                'description' => ['en' => "Discover the beauty of {$destData['name']['en']}.", 'vi' => "Khám phá vẻ đẹp của {$destData['name']['vi']}."],
                'image' => 'https://picsum.photos/seed/' . $destData['slug'] . '/800/600',
                'meta_title' => ['en' => "Tours in {$destData['name']['en']}", 'vi' => "Du lịch {$destData['name']['vi']}"],
                'meta_description' => ['en' => "Explore tours and travel packages in {$destData['name']['en']}.", 'vi' => "Khám phá các tour du lịch tại {$destData['name']['vi']}."],
                'is_featured' => $destData['is_featured'],
                'order' => $destData['order'],
                'is_active' => true,
            ]);

            // Create cities for each destination
            for ($i = 1; $i <= rand(2, 3); $i++) {
                City::factory()->create([
                    'destination_id' => $dest->id,
                ]);
            }
        }

        // Tour Categories
        $categories = [
            ['en' => 'Adventure', 'vi' => 'Phiêu lưu', 'slug' => 'adventure'],
            ['en' => 'Cultural', 'vi' => 'Văn hóa', 'slug' => 'cultural'],
            ['en' => 'Beach & Islands', 'vi' => 'Biển & Đảo', 'slug' => 'beach-islands'],
            ['en' => 'Food & Culinary', 'vi' => 'Ẩm thực', 'slug' => 'food-culinary'],
            ['en' => 'Wellness & Spa', 'vi' => 'Sức khỏe & Spa', 'slug' => 'wellness-spa'],
            ['en' => 'Eco-Tourism', 'vi' => 'Du lịch sinh thái', 'slug' => 'eco-tourism'],
        ];
        $createdCategories = [];
        foreach ($categories as $cat) {
            $createdCategories[] = TourCategory::create([
                'name' => ['en' => $cat['en'], 'vi' => $cat['vi']],
                'slug' => $cat['slug'],
                'is_active' => true,
            ]);
        }

        // Tours
        $destinations = Destination::all();
        foreach ($destinations as $dest) {
            $numTours = rand(3, 5);
            for ($i = 0; $i < $numTours; $i++) {
                $tour = Tour::factory()->create([
                    'destination_id' => $dest->id,
                    'city_id' => $dest->cities->random()?->id,
                ]);
                // Attach random categories
                $tour->categories()->attach(
                    collect($createdCategories)->random(rand(1, 2))->pluck('id')
                );
            }
        }

        // Blog Categories
        $blogCategories = [
            ['en' => 'Travel Tips', 'vi' => 'Mẹo du lịch', 'slug' => 'travel-tips'],
            ['en' => 'Destinations', 'vi' => 'Điểm đến', 'slug' => 'destinations'],
            ['en' => 'Culture & History', 'vi' => 'Văn hóa & Lịch sử', 'slug' => 'culture-history'],
            ['en' => 'Food & Dining', 'vi' => 'Ẩm thực', 'slug' => 'food-dining'],
            ['en' => 'Adventure Stories', 'vi' => 'Câu chuyện phiêu lưu', 'slug' => 'adventure-stories'],
        ];
        $createdBlogCategories = [];
        foreach ($blogCategories as $cat) {
            $createdBlogCategories[] = BlogCategory::create([
                'name' => ['en' => $cat['en'], 'vi' => $cat['vi']],
                'slug' => $cat['slug'],
                'is_active' => true,
            ]);
        }

        // Blog Posts
        foreach ($createdBlogCategories as $cat) {
            BlogPost::factory(2)->create([
                'blog_category_id' => $cat->id,
            ]);
        }

        // Pages
        Page::create([
            'title' => ['en' => 'About Us', 'vi' => 'Về Chúng Tôi'],
            'slug' => 'about-us',
            'content' => [
                'en' => '<h2>Welcome to Victoria Tour</h2><p>We are a trusted B2B travel agency specializing in Asian destinations.</p>',
                'vi' => '<h2>Chào mừng đến với Victoria Tour</h2><p>Chúng tôi là công ty du lịch B2B đáng tin cậy chuyên về các điểm đến châu Á.</p>'
            ],
            'template' => 'about',
            'is_active' => true,
        ]);

        Page::create([
            'title' => ['en' => 'MICE Services', 'vi' => 'Dịch vụ MICE'],
            'slug' => 'mice',
            'content' => [
                'en' => '<h2>Meetings, Incentives, Conferences & Exhibitions</h2><p>We offer comprehensive MICE services for corporate clients.</p>',
                'vi' => '<h2>Hội nghị, Khuyến thưởng, Hội thảo & Triển lãm</h2><p>Chúng tôi cung cấp dịch vụ MICE toàn diện cho khách hàng doanh nghiệp.</p>'
            ],
            'template' => 'mice',
            'is_active' => true,
        ]);

        Page::create([
            'title' => ['en' => 'Contact Us', 'vi' => 'Liên Hệ'],
            'slug' => 'contact-us',
            'content' => [
                'en' => '<h2>Get in Touch</h2><p>We would love to hear from you.</p>',
                'vi' => '<h2>Liên Hệ Với Chúng Tôi</h2><p>Chúng tôi rất mong được lắng nghe từ bạn.</p>'
            ],
            'template' => 'contact',
            'is_active' => true,
        ]);

        Page::create([
            'title' => ['en' => 'Privacy Policy', 'vi' => 'Chính Sách Bảo Mật'],
            'slug' => 'privacy-policy',
            'content' => [
                'en' => '<h2>Privacy Policy</h2>
<p>Your privacy is important to us. This privacy policy explains how we collect, use, and protect your personal information.</p>
<h3>Information We Collect</h3>
<p>We collect information you provide directly to us, such as when you fill out a contact form, subscribe to our newsletter, or make an inquiry about our tours.</p>
<h3>How We Use Your Information</h3>
<p>We use the information we collect to provide, maintain, and improve our services, process your inquiries, and send you updates about our tours and promotions.</p>
<h3>Cookies</h3>
<p>We use cookies and similar technologies to enhance your experience on our website. You can choose to disable cookies through your browser settings.</p>
<h3>Contact Us</h3>
<p>If you have any questions about this privacy policy, please contact us.</p>',
                'vi' => '<h2>Chính Sách Bảo Mật</h2>
<p>Quyền riêng tư của bạn rất quan trọng với chúng tôi. Chính sách bảo mật này giải thích cách chúng tôi thu thập, sử dụng và bảo vệ thông tin cá nhân của bạn.</p>
<h3>Thông Tin Chúng Tôi Thu Thập</h3>
<p>Chúng tôi thu thập thông tin bạn cung cấp trực tiếp, chẳng hạn như khi bạn điền biểu mẫu liên hệ, đăng ký nhận bản tin hoặc yêu cầu thông tin về các tour của chúng tôi.</p>
<h3>Cách Chúng Tôi Sử Dụng Thông Tin</h3>
<p>Chúng tôi sử dụng thông tin thu thập để cung cấp, duy trì và cải thiện dịch vụ, xử lý yêu cầu của bạn và gửi cập nhật về các tour và khuyến mãi.</p>
<h3>Cookies</h3>
<p>Chúng tôi sử dụng cookies và các công nghệ tương tự để nâng cao trải nghiệm của bạn trên website. Bạn có thể chọn tắt cookies thông qua cài đặt trình duyệt.</p>
<h3>Liên Hệ</h3>
<p>Nếu bạn có bất kỳ câu hỏi nào về chính sách bảo mật này, vui lòng liên hệ với chúng tôi.</p>'
            ],
            'template' => 'default',
            'is_active' => true,
        ]);

        Page::create([
            'title' => ['en' => 'Terms of Service', 'vi' => 'Điều Khoản Dịch Vụ'],
            'slug' => 'terms-of-service',
            'content' => [
                'en' => '<h2>Terms of Service</h2>
<p>By using Victoria Tour services, you agree to be bound by the following terms and conditions.</p>
<h3>Booking & Payments</h3>
<p>All bookings are subject to availability and confirmation. Payment terms will be specified at the time of booking.</p>
<h3>Cancellation Policy</h3>
<p>Cancellation policies vary depending on the tour and season. Please review the specific terms for your booking.</p>
<h3>Liability</h3>
<p>Victoria Tour acts as an intermediary between travelers and service providers. We are not liable for acts of third parties or force majeure events.</p>
<h3>Changes to Terms</h3>
<p>We reserve the right to modify these terms at any time. Continued use of our services constitutes acceptance of any changes.</p>',
                'vi' => '<h2>Điều Khoản Dịch Vụ</h2>
<p>Bằng việc sử dụng dịch vụ Victoria Tour, bạn đồng ý tuân theo các điều khoản và điều kiện sau.</p>
<h3>Đặt Chỗ & Thanh Toán</h3>
<p>Tất cả đặt chỗ phụ thuộc vào tình trạng còn chỗ và xác nhận. Điều khoản thanh toán sẽ được nêu rõ khi đặt chỗ.</p>
<h3>Chính Sách Hủy</h3>
<p>Chính sách hủy khác nhau tùy thuộc vào tour và mùa. Vui lòng xem xét các điều khoản cụ thể cho đặt chỗ của bạn.</p>
<h3>Trách Nhiệm</h3>
<p>Victoria Tour hoạt động như một trung gian giữa du khách và nhà cung cấp dịch vụ. Chúng tôi không chịu trách nhiệm về hành vi của bên thứ ba hoặc sự kiện bất khả kháng.</p>
<h3>Thay Đổi Điều Khoản</h3>
<p>Chúng tôi có quyền sửa đổi các điều khoản này bất cứ lúc nào. Việc tiếp tục sử dụng dịch vụ của chúng tôi đồng nghĩa với việc chấp nhận mọi thay đổi.</p>'
            ],
            'template' => 'default',
            'is_active' => true,
        ]);

        // Sliders
        Slider::create([
            'title' => ['en' => 'Travel Around The World Your Way', 'vi' => 'Du Lịch Khắp Thế Giới Theo Cách Của Bạn'],
            'subtitle' => ['en' => 'Discover amazing destinations with Victoria Tour', 'vi' => 'Khám phá những điểm đến tuyệt vời với Victoria Tour'],
            'image' => 'https://picsum.photos/seed/slider1/1920/800',
            'button_text' => ['en' => 'Discover More', 'vi' => 'Khám Phá'],
            'button_url' => '/destinations',
            'order' => 1,
            'is_active' => true,
        ]);

        Slider::create([
            'title' => ['en' => 'Explore Southeast Asia', 'vi' => 'Khám Phá Đông Nam Á'],
            'subtitle' => ['en' => 'From Vietnam to Thailand, Cambodia and beyond', 'vi' => 'Từ Việt Nam đến Thái Lan, Campuchia và hơn thế nữa'],
            'image' => 'https://picsum.photos/seed/slider2/1920/800',
            'button_text' => ['en' => 'View Tours', 'vi' => 'Xem Tour'],
            'button_url' => '/tours',
            'order' => 2,
            'is_active' => true,
        ]);

        Slider::create([
            'title' => ['en' => 'Authentic Experiences', 'vi' => 'Trải Nghiệm Đích Thực'],
            'subtitle' => ['en' => 'Immerse yourself in local cultures', 'vi' => 'Hòa mình vào văn hóa địa phương'],
            'image' => 'https://picsum.photos/seed/slider3/1920/800',
            'button_text' => ['en' => 'Learn More', 'vi' => 'Tìm Hiểu Thêm'],
            'button_url' => '/about-us',
            'order' => 3,
            'is_active' => true,
        ]);

        // Differentiators
        $differentiators = [
            ['title' => ['en' => 'Own Operations', 'vi' => 'Vận Hành Riêng'], 'icon' => 'heroicon-o-building-office', 'description' => ['en' => 'We operate our own tours ensuring quality control.', 'vi' => 'Chúng tôi vận hành tour riêng đảm bảo kiểm soát chất lượng.']],
            ['title' => ['en' => 'Customer Focused', 'vi' => 'Tập Trung Khách Hàng'], 'icon' => 'heroicon-o-heart', 'description' => ['en' => 'Your satisfaction is our top priority.', 'vi' => 'Sự hài lòng của bạn là ưu tiên hàng đầu của chúng tôi.']],
            ['title' => ['en' => 'Responsible Travel', 'vi' => 'Du Lịch Có Trách Nhiệm'], 'icon' => 'heroicon-o-globe-alt', 'description' => ['en' => 'Sustainable and eco-friendly practices.', 'vi' => 'Thực hành bền vững và thân thiện với môi trường.']],
            ['title' => ['en' => '24/7 Support', 'vi' => 'Hỗ Trợ 24/7'], 'icon' => 'heroicon-o-phone', 'description' => ['en' => 'Round the clock assistance for all travelers.', 'vi' => 'Hỗ trợ suốt ngày đêm cho mọi du khách.']],
            ['title' => ['en' => 'Expert Guides', 'vi' => 'Hướng Dẫn Viên Chuyên Nghiệp'], 'icon' => 'heroicon-o-user-group', 'description' => ['en' => 'Local experts who know the best spots.', 'vi' => 'Chuyên gia địa phương biết những điểm tốt nhất.']],
            ['title' => ['en' => 'Best Value', 'vi' => 'Giá Trị Tốt Nhất'], 'icon' => 'heroicon-o-currency-dollar', 'description' => ['en' => 'Quality tours at competitive prices.', 'vi' => 'Tour chất lượng với giá cạnh tranh.']],
        ];

        foreach ($differentiators as $index => $diff) {
            Differentiator::create([
                'title' => $diff['title'],
                'description' => $diff['description'],
                'icon' => $diff['icon'],
                'order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}
