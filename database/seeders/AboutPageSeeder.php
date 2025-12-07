<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use App\Models\AboutStrength;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or get the AboutPage record
        $about = AboutPage::firstOrCreate([]);

        // Hero Section
        $about->setTranslations('hero_category', [
            'en' => 'About Victoria Tour',
            'vi' => 'Về Victoria Tour',
        ]);
        $about->setTranslations('hero_line1', [
            'en' => 'YOUR TRUSTED',
            'vi' => 'ĐỐI TÁC DU LỊCH',
        ]);
        $about->setTranslations('hero_line2', [
            'en' => 'TRAVEL PARTNER',
            'vi' => 'ĐÁNG TIN CẬY',
        ]);
        $about->setTranslations('hero_line3', [
            'en' => 'SINCE 2010',
            'vi' => 'TỪ NĂM 2010',
        ]);
        $about->setTranslations('hero_subtitle', [
            'en' => 'We create unforgettable journeys across Southeast Asia, connecting travelers with authentic cultural experiences and breathtaking natural wonders.',
            'vi' => 'Chúng tôi tạo nên những chuyến đi đáng nhớ khắp Đông Nam Á, kết nối du khách với những trải nghiệm văn hóa đích thực và kỳ quan thiên nhiên tuyệt đẹp.',
        ]);

        // Story Section
        $about->setTranslations('story_title', [
            'en' => 'Our Story',
            'vi' => 'Câu Chuyện Của Chúng Tôi',
        ]);
        $about->setTranslations('story_content', [
            'en' => '<p>Victoria Tour began in 2010 with a simple yet powerful vision: to share the authentic beauty of Southeast Asia with travelers from around the world. Founded by a team of passionate local experts, we started as a small operation in Ho Chi Minh City, offering personalized tours to Vietnam\'s hidden gems.</p><p>Over the years, we\'ve grown into a trusted travel partner, expanding our reach across Vietnam, Cambodia, Thailand, Laos, and Myanmar. Our success is built on our deep understanding of local cultures, our commitment to sustainable tourism, and our dedication to creating meaningful connections between travelers and the communities they visit.</p>',
            'vi' => '<p>Victoria Tour bắt đầu vào năm 2010 với một tầm nhìn đơn giản nhưng mạnh mẽ: chia sẻ vẻ đẹp đích thực của Đông Nam Á với du khách từ khắp nơi trên thế giới. Được thành lập bởi một nhóm chuyên gia địa phương đầy nhiệt huyết, chúng tôi bắt đầu như một hoạt động nhỏ tại Thành phố Hồ Chí Minh, cung cấp các tour du lịch cá nhân hóa đến những viên ngọc ẩn giấu của Việt Nam.</p><p>Qua nhiều năm, chúng tôi đã phát triển thành một đối tác du lịch đáng tin cậy, mở rộng phạm vi hoạt động khắp Việt Nam, Campuchia, Thái Lan, Lào và Myanmar. Thành công của chúng tôi được xây dựng dựa trên sự hiểu biết sâu sắc về văn hóa địa phương, cam kết với du lịch bền vững, và sự cống hiến trong việc tạo ra những kết nối ý nghĩa giữa du khách và cộng đồng họ ghé thăm.</p>',
        ]);

        // Mission Section
        $about->setTranslations('mission_title', [
            'en' => 'Our Mission',
            'vi' => 'Sứ Mệnh Của Chúng Tôi',
        ]);
        $about->setTranslations('mission_content', [
            'en' => '<p>Our mission is to create transformative travel experiences that enrich lives, foster cultural understanding, and support local communities. We believe travel should be more than just visiting places—it should be about creating lasting memories and meaningful connections.</p><p>We are committed to responsible tourism that preserves the natural beauty and cultural heritage of the destinations we serve, ensuring that future generations can enjoy these wonders as we do today.</p>',
            'vi' => '<p>Sứ mệnh của chúng tôi là tạo ra những trải nghiệm du lịch biến đổi cuộc sống, làm phong phú thêm cuộc sống, thúc đẩy sự hiểu biết văn hóa và hỗ trợ cộng đồng địa phương. Chúng tôi tin rằng du lịch không chỉ đơn thuần là ghé thăm các địa điểm—mà còn là tạo ra những kỷ niệm lâu dài và những kết nối ý nghĩa.</p><p>Chúng tôi cam kết thực hiện du lịch có trách nhiệm, bảo tồn vẻ đẹp tự nhiên và di sản văn hóa của các điểm đến mà chúng tôi phục vụ, đảm bảo rằng các thế hệ tương lai có thể thưởng thức những kỳ quan này như chúng ta ngày nay.</p>',
        ]);

        // Vision Section
        $about->setTranslations('vision_title', [
            'en' => 'Our Vision',
            'vi' => 'Tầm Nhìn Của Chúng Tôi',
        ]);
        $about->setTranslations('vision_content', [
            'en' => '<p>We envision a world where travel bridges cultures and creates global citizens. Our goal is to become Southeast Asia\'s most trusted travel partner, known for our authentic experiences, exceptional service, and unwavering commitment to sustainability.</p><p>We strive to innovate continuously, embracing new technologies and methods to enhance our travelers\' experiences while staying true to our core values of authenticity, integrity, and excellence.</p>',
            'vi' => '<p>Chúng tôi hình dung một thế giới nơi du lịch kết nối các nền văn hóa và tạo ra những công dân toàn cầu. Mục tiêu của chúng tôi là trở thành đối tác du lịch đáng tin cậy nhất Đông Nam Á, được biết đến với những trải nghiệm đích thực, dịch vụ xuất sắc, và cam kết không lay chuyển với sự bền vững.</p><p>Chúng tôi nỗ lực đổi mới liên tục, nắm bắt các công nghệ và phương pháp mới để nâng cao trải nghiệm của du khách trong khi vẫn trung thành với các giá trị cốt lõi của chúng tôi: tính đích thực, chính trực và xuất sắc.</p>',
        ]);

        // Stats
        $about->stat1_number = '15+';
        $about->setTranslations('stat1_label', [
            'en' => 'Years Experience',
            'vi' => 'Năm Kinh Nghiệm',
        ]);
        $about->stat2_number = '5000+';
        $about->setTranslations('stat2_label', [
            'en' => 'Happy Travelers',
            'vi' => 'Khách Hàng Hài Lòng',
        ]);
        $about->stat3_number = '50+';
        $about->setTranslations('stat3_label', [
            'en' => 'Destinations',
            'vi' => 'Điểm Đến',
        ]);
        $about->stat4_number = '100%';
        $about->setTranslations('stat4_label', [
            'en' => 'Satisfaction',
            'vi' => 'Hài Lòng',
        ]);

        // SEO
        $about->setTranslations('meta_title', [
            'en' => 'About Us - Victoria Tour | Your Trusted Travel Partner',
            'vi' => 'Về Chúng Tôi - Victoria Tour | Đối Tác Du Lịch Đáng Tin Cậy',
        ]);
        $about->setTranslations('meta_description', [
            'en' => 'Learn about Victoria Tour, your trusted travel partner since 2010. We create unforgettable journeys across Southeast Asia with authentic experiences and exceptional service.',
            'vi' => 'Tìm hiểu về Victoria Tour, đối tác du lịch đáng tin cậy của bạn từ năm 2010. Chúng tôi tạo nên những chuyến đi đáng nhớ khắp Đông Nam Á với trải nghiệm đích thực và dịch vụ xuất sắc.',
        ]);

        $about->save();

        // Download and attach images from Unsplash
        try {
            // Hero Image - Scenic travel landscape
            $about->addMediaFromUrl('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1920&q=80')
                  ->toMediaCollection('hero_image');

            // Story Image - Team/office environment
            $about->addMediaFromUrl('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80')
                  ->toMediaCollection('story_image');

            // Mission Image - Cultural/destination scene
            $about->addMediaFromUrl('https://images.unsplash.com/photo-1528127269322-539801943592?w=800&q=80')
                  ->toMediaCollection('mission_image');

            // Vision Image - Inspiring landscape
            $about->addMediaFromUrl('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80')
                  ->toMediaCollection('vision_image');
        } catch (\Exception $e) {
            // If image download fails, continue without images
            $this->command->warn('Could not download images: ' . $e->getMessage());
        }

        // Create Strengths
        AboutStrength::truncate();

        AboutStrength::create([
            'title' => [
                'en' => 'Local Expertise',
                'vi' => 'Chuyên Gia Địa Phương',
            ],
            'description' => [
                'en' => 'Deep knowledge of Southeast Asia destinations, culture, and hidden gems that only locals know.',
                'vi' => 'Kiến thức sâu sắc về các điểm đến Đông Nam Á, văn hóa và những viên ngọc ẩn giấu mà chỉ người địa phương mới biết.',
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        AboutStrength::create([
            'title' => [
                'en' => 'Tailored Journeys',
                'vi' => 'Hành Trình Riêng Biệt',
            ],
            'description' => [
                'en' => 'Every trip is meticulously crafted to match your preferences, interests, and travel style.',
                'vi' => 'Mỗi chuyến đi được thiết kế tỉ mỉ phù hợp với sở thích, mối quan tâm và phong cách du lịch của bạn.',
            ],
            'order' => 2,
            'is_active' => true,
        ]);

        AboutStrength::create([
            'title' => [
                'en' => '24/7 Support',
                'vi' => 'Hỗ Trợ 24/7',
            ],
            'description' => [
                'en' => 'We\'re always just a call away. Our dedicated team ensures your journey is smooth and worry-free.',
                'vi' => 'Chúng tôi luôn sẵn sàng chỉ một cuộc gọi. Đội ngũ tận tâm đảm bảo hành trình của bạn suôn sẻ và an tâm.',
            ],
            'order' => 3,
            'is_active' => true,
        ]);

        AboutStrength::create([
            'title' => [
                'en' => 'Best Value',
                'vi' => 'Giá Trị Tốt Nhất',
            ],
            'description' => [
                'en' => 'Premium quality experiences at competitive prices. No hidden fees, no surprises—just great value.',
                'vi' => 'Trải nghiệm chất lượng cao với giá cạnh tranh. Không phí ẩn, không bất ngờ—chỉ có giá trị tuyệt vời.',
            ],
            'order' => 4,
            'is_active' => true,
        ]);

        $this->command->info('About page content seeded successfully!');
    }
}
