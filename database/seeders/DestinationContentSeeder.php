<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\DestinationVisa;
use App\Models\DestinationPolicy;
use Illuminate\Database\Seeder;

class DestinationContentSeeder extends Seeder
{
    public function run(): void
    {
        $content = [
            'vietnam' => [
                'visa' => [
                    'title' => ['en' => 'Vietnam Visa Service', 'vi' => 'Dịch Vụ Visa Việt Nam'],
                    'content' => [
                        'en' => '<p>Victoria Tour provides comprehensive visa assistance for visitors to Vietnam. We handle all paperwork and ensure a smooth entry process.</p><h3>Visa Types Available</h3><ul><li>Tourist Visa (single/multiple entry)</li><li>Business Visa</li><li>E-Visa (online application)</li></ul><h3>Requirements</h3><p>Valid passport with at least 6 months validity, passport photos, and completed application form.</p>',
                        'vi' => '<p>Victoria Tour cung cấp dịch vụ hỗ trợ visa toàn diện cho du khách đến Việt Nam. Chúng tôi xử lý tất cả giấy tờ và đảm bảo quy trình nhập cảnh suôn sẻ.</p><h3>Các Loại Visa</h3><ul><li>Visa du lịch (một/nhiều lần nhập cảnh)</li><li>Visa công tác</li><li>E-Visa (đăng ký trực tuyến)</li></ul><h3>Yêu Cầu</h3><p>Hộ chiếu còn hiệu lực ít nhất 6 tháng, ảnh hộ chiếu và mẫu đơn đã điền đầy đủ.</p>',
                    ],
                ],
                'policy' => [
                    'title' => ['en' => 'Travel Policy', 'vi' => 'Chính Sách Du Lịch'],
                    'content' => [
                        'en' => '<p>Tourism policies focus on promoting sustainable travel, preserving cultural heritage, and boosting local economies. They aim to create balanced development by supporting eco-friendly practices, improving infrastructure, and enhancing the visitor experience while minimizing environmental impact.</p><h3>Our Commitment</h3><p>Victoria Tour is committed to responsible tourism practices that benefit both travelers and local communities.</p>',
                        'vi' => '<p>Chính sách du lịch tập trung vào việc thúc đẩy du lịch bền vững, bảo tồn di sản văn hóa và thúc đẩy kinh tế địa phương. Chúng nhằm tạo ra sự phát triển cân bằng bằng cách hỗ trợ các hoạt động thân thiện với môi trường, cải thiện cơ sở hạ tầng và nâng cao trải nghiệm du khách trong khi giảm thiểu tác động môi trường.</p><h3>Cam Kết Của Chúng Tôi</h3><p>Victoria Tour cam kết thực hành du lịch có trách nhiệm, mang lại lợi ích cho cả du khách và cộng đồng địa phương.</p>',
                    ],
                ],
            ],
            'thailand' => [
                'visa' => [
                    'title' => ['en' => 'Thailand Visa Service', 'vi' => 'Dịch Vụ Visa Thái Lan'],
                    'content' => [
                        'en' => '<p>Many nationalities can enter Thailand visa-free for tourism. Victoria Tour assists with visa extensions and special visa categories.</p><h3>Visa-Free Entry</h3><p>Citizens of many countries can stay up to 30-60 days without a visa.</p><h3>Visa on Arrival</h3><p>Available for eligible nationalities at major airports and land borders.</p>',
                        'vi' => '<p>Nhiều quốc tịch có thể nhập cảnh Thái Lan miễn visa để du lịch. Victoria Tour hỗ trợ gia hạn visa và các loại visa đặc biệt.</p><h3>Nhập Cảnh Miễn Visa</h3><p>Công dân của nhiều quốc gia có thể lưu trú đến 30-60 ngày mà không cần visa.</p><h3>Visa Tại Sân Bay</h3><p>Có sẵn cho các quốc tịch đủ điều kiện tại các sân bay lớn và cửa khẩu đường bộ.</p>',
                    ],
                ],
                'policy' => [
                    'title' => ['en' => 'Travel Policy', 'vi' => 'Chính Sách Du Lịch'],
                    'content' => [
                        'en' => '<p>Thailand promotes responsible tourism with focus on cultural respect and environmental conservation. Our tours follow local guidelines and support community-based tourism initiatives.</p>',
                        'vi' => '<p>Thái Lan thúc đẩy du lịch có trách nhiệm với trọng tâm là tôn trọng văn hóa và bảo tồn môi trường. Các tour của chúng tôi tuân theo hướng dẫn địa phương và hỗ trợ các sáng kiến du lịch dựa vào cộng đồng.</p>',
                    ],
                ],
            ],
            'cambodia' => [
                'visa' => [
                    'title' => ['en' => 'Cambodia Visa Service', 'vi' => 'Dịch Vụ Visa Campuchia'],
                    'content' => [
                        'en' => '<p>Cambodia offers e-Visa and visa on arrival options. Victoria Tour helps streamline your visa application process.</p><h3>E-Visa</h3><p>Apply online before your trip for a hassle-free arrival.</p><h3>Visa on Arrival</h3><p>Available at airports and major land borders.</p>',
                        'vi' => '<p>Campuchia cung cấp các tùy chọn e-Visa và visa khi đến. Victoria Tour giúp đơn giản hóa quy trình xin visa của bạn.</p><h3>E-Visa</h3><p>Đăng ký trực tuyến trước chuyến đi để đến nơi không rắc rối.</p><h3>Visa Tại Sân Bay</h3><p>Có sẵn tại sân bay và các cửa khẩu đường bộ chính.</p>',
                    ],
                ],
                'policy' => [
                    'title' => ['en' => 'Travel Policy', 'vi' => 'Chính Sách Du Lịch'],
                    'content' => [
                        'en' => '<p>Cambodia emphasizes heritage preservation, especially around Angkor Wat. Our tours respect sacred sites and contribute to conservation efforts.</p>',
                        'vi' => '<p>Campuchia nhấn mạnh việc bảo tồn di sản, đặc biệt xung quanh Angkor Wat. Các tour của chúng tôi tôn trọng các địa điểm linh thiêng và đóng góp cho nỗ lực bảo tồn.</p>',
                    ],
                ],
            ],
        ];

        foreach ($content as $slug => $data) {
            $destination = Destination::where('slug', $slug)->first();
            if (!$destination) continue;

            // Create Visa content
            DestinationVisa::create([
                'destination_id' => $destination->id,
                'title' => $data['visa']['title'],
                'content' => $data['visa']['content'],
                'is_active' => true,
            ]);

            // Create Policy content
            DestinationPolicy::create([
                'destination_id' => $destination->id,
                'title' => $data['policy']['title'],
                'content' => $data['policy']['content'],
                'is_active' => true,
            ]);
        }
    }
}
