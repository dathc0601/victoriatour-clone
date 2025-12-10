# Hướng Dẫn Sử Dụng Hệ Thống Quản Trị Victoria Tour

## Mục Lục

1. [Giới Thiệu](#1-giới-thiệu)
2. [Quản Lý Điểm Đến & Thành Phố](#2-quản-lý-điểm-đến--thành-phố)
3. [Quản Lý Tour](#3-quản-lý-tour)
4. [Quản Lý Khách Sạn](#4-quản-lý-khách-sạn)
5. [Quản Lý Nội Dung MICE](#5-quản-lý-nội-dung-mice)
6. [Quản Lý Blog](#6-quản-lý-blog)
7. [Quản Lý Trang](#7-quản-lý-trang)
8. [Quản Lý Slider & Điểm Khác Biệt](#8-quản-lý-slider--điểm-khác-biệt)
9. [Cấu Hình Trang Giới Thiệu (About)](#9-cấu-hình-trang-giới-thiệu-about)
10. [Quản Lý Điều Hướng (Navigation)](#10-quản-lý-điều-hướng-navigation)
11. [Quản Lý Yêu Cầu Khách Hàng](#11-quản-lý-yêu-cầu-khách-hàng)
12. [Cài Đặt Hệ Thống](#12-cài-đặt-hệ-thống)
13. [Cài Đặt Footer](#13-cài-đặt-footer)
14. [Quản Lý Ngôn Ngữ](#14-quản-lý-ngôn-ngữ)
15. [Hướng Dẫn Nhập Liệu Đa Ngôn Ngữ](#15-hướng-dẫn-nhập-liệu-đa-ngôn-ngữ)
16. [Mẹo & Thực Hành Tốt Nhất](#16-mẹo--thực-hành-tốt-nhất)

---

## 1. Giới Thiệu

### 1.1 Tổng Quan Hệ Thống

Victoria Tour Admin Panel là hệ thống quản trị nội dung (CMS) toàn diện được xây dựng để quản lý website du lịch Victoria Tour. Hệ thống cho phép bạn:

- Quản lý điểm đến, thành phố và tour du lịch
- Quản lý khách sạn và dịch vụ lưu trú
- Quản lý nội dung MICE (Hội nghị, Sự kiện doanh nghiệp)
- Viết và đăng bài blog
- Tạo và quản lý các trang tĩnh
- Quản lý slider trang chủ và nội dung marketing
- Xử lý yêu cầu từ khách hàng
- Cấu hình toàn bộ hệ thống

### 1.2 Đăng Nhập Hệ Thống

**Bước 1:** Truy cập địa chỉ admin panel:
```
https://[tên-miền-của-bạn]/admin
```

**Bước 2:** Nhập thông tin đăng nhập:
- **Email:** Email tài khoản admin của bạn
- **Mật khẩu:** Mật khẩu đã được cung cấp

**Bước 3:** Nhấn nút **"Sign in"** để đăng nhập

> **Lưu ý:** Nếu quên mật khẩu, vui lòng liên hệ bộ phận kỹ thuật để được hỗ trợ reset mật khẩu.

### 1.3 Giao Diện Dashboard

Sau khi đăng nhập thành công, bạn sẽ thấy trang Dashboard với các thành phần chính:

#### Menu Điều Hướng (Sidebar Trái)

Menu được chia thành các nhóm:

| Nhóm | Chức năng |
|------|-----------|
| **Content** | Điểm đến, Thành phố, Danh mục Tour, Tour, Khách sạn, MICE |
| **Blog** | Danh mục Blog, Bài viết Blog |
| **Pages** | Trang, Slider, Điểm khác biệt, Trang About |
| **Inquiries** | Yêu cầu từ khách hàng |
| **Settings** | Ngôn ngữ, Điều hướng, Cài đặt, Footer |

#### Các Widget Trên Dashboard

**1. Stats Overview (Tổng quan số liệu)**
- **New Inquiries:** Số yêu cầu mới chưa xử lý (màu cam)
- **Total Inquiries:** Tổng số yêu cầu
- **Tour Bookings:** Số yêu cầu đặt tour
- **Newsletter Signups:** Số đăng ký nhận tin
- **Active Tours:** Số tour đang hoạt động
- **Destinations:** Số điểm đến
- **Blog Posts:** Số bài viết blog
- **Active Pages:** Số trang đang hoạt động

**2. Quick Actions (Thao tác nhanh)**
- Thêm Tour mới
- Thêm Bài viết Blog
- Xem Yêu cầu khách hàng
- Thêm Điểm đến mới

**3. Latest Inquiries (Yêu cầu mới nhất)**
- Hiển thị 8 yêu cầu gần nhất từ khách hàng

**4. Latest Tours (Tour mới nhất)**
- Hiển thị 5 tour được cập nhật gần nhất

**5. Latest Blog Posts (Bài viết mới nhất)**
- Hiển thị 5 bài viết blog gần nhất

---

## 2. Quản Lý Điểm Đến & Thành Phố

### 2.1 Quản Lý Điểm Đến (Destinations)

Điểm đến là đơn vị địa lý cấp cao nhất trong hệ thống, thường là quốc gia hoặc vùng lãnh thổ.

#### Truy Cập

Menu trái → **Content** → **Destinations**

#### Danh Sách Điểm Đến

Trang danh sách hiển thị:
- **Hình ảnh:** Hình thu nhỏ của điểm đến
- **Name:** Tên điểm đến
- **Cities:** Số thành phố thuộc điểm đến
- **Tours:** Số tour tại điểm đến
- **Featured:** Có phải điểm đến nổi bật không
- **Active:** Trạng thái hoạt động

#### Thêm Điểm Đến Mới

**Bước 1:** Nhấn nút **"Create"** ở góc trên phải

**Bước 2:** Điền thông tin cơ bản:

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Name** | Tên điểm đến (VD: Việt Nam, Nhật Bản) | ✅ |
| **Slug** | Đường dẫn URL (tự động tạo từ tên) | ✅ |
| **Description** | Mô tả chi tiết về điểm đến | ❌ |

**Bước 3:** Upload hình ảnh Hero:
- Nhấn vào vùng upload hoặc kéo thả hình ảnh
- **Kích thước khuyến nghị:** 1920x1080 pixels (tỷ lệ 16:9)
- Hình ảnh này sẽ hiển thị ở đầu trang chi tiết điểm đến

**Bước 4:** Cấu hình Thông Tin Visa (nếu có):
- Bật **"Enable Visa Section"**
- Điền **Title:** Tiêu đề phần visa (VD: "Thông tin Visa")
- Điền **Content:** Nội dung chi tiết về visa
- Upload hình ảnh minh họa (nếu có)

**Bước 5:** Cấu hình Chính Sách Du Lịch (nếu có):
- Bật **"Enable Travel Policy"**
- Điền **Title:** Tiêu đề phần chính sách
- Điền **Content:** Nội dung chi tiết
- Upload hình ảnh minh họa (nếu có)

**Bước 6:** Cài đặt hiển thị:
- **Order:** Thứ tự hiển thị (số nhỏ hiển thị trước)
- **Featured:** Bật nếu muốn đánh dấu là điểm đến nổi bật
- **Active:** Bật để hiển thị trên website

**Bước 7:** Nhấn **"Create"** để lưu

#### Chỉnh Sửa Điểm Đến

1. Trong danh sách, nhấn vào tên điểm đến hoặc biểu tượng bút chì
2. Thực hiện các thay đổi cần thiết
3. Nhấn **"Save changes"** để lưu

#### Quản Lý Nội Dung Liên Quan

Khi chỉnh sửa điểm đến, bạn sẽ thấy các tab bổ sung:
- **Cities:** Quản lý thành phố thuộc điểm đến
- **Tours:** Xem danh sách tour tại điểm đến
- **Hotels:** Quản lý khách sạn tại điểm đến

#### Sắp Xếp Thứ Tự

Bạn có thể kéo thả các điểm đến trong danh sách để thay đổi thứ tự hiển thị.

#### Xóa Điểm Đến

1. Trong danh sách, nhấn biểu tượng thùng rác ở cột cuối
2. Xác nhận xóa trong hộp thoại hiện ra

> **Cảnh báo:** Xóa điểm đến sẽ ảnh hưởng đến các thành phố, tour và khách sạn liên quan. Hãy cân nhắc kỹ trước khi xóa.

---

### 2.2 Quản Lý Thành Phố (Cities)

Thành phố là đơn vị địa lý cấp 2, thuộc về một điểm đến cụ thể.

#### Truy Cập

Menu trái → **Content** → **Cities**

#### Danh Sách Thành Phố

Trang hiển thị:
- **Image:** Hình ảnh thành phố
- **Name:** Tên thành phố
- **Destination:** Điểm đến mà thành phố thuộc về
- **Tours:** Số tour tại thành phố
- **Active:** Trạng thái hoạt động

#### Thêm Thành Phố Mới

**Bước 1:** Nhấn nút **"Create"**

**Bước 2:** Điền thông tin:

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Destination** | Chọn điểm đến mà thành phố thuộc về | ✅ |
| **Name** | Tên thành phố (VD: Hà Nội, Tokyo) | ✅ |
| **Slug** | Đường dẫn URL (tự động tạo) | ✅ |
| **Description** | Mô tả về thành phố | ❌ |
| **Image** | Hình ảnh đại diện | ❌ |
| **Active** | Bật/tắt hiển thị | ✅ |

**Bước 3:** Nhấn **"Create"** để lưu

#### Lọc Thành Phố

Sử dụng các bộ lọc ở đầu bảng:
- **Destination:** Lọc theo điểm đến
- **Active:** Lọc theo trạng thái

---

## 3. Quản Lý Tour

### 3.1 Quản Lý Danh Mục Tour (Tour Categories)

#### Truy Cập

Menu trái → **Content** → **Tour Categories**

#### Thêm Danh Mục Mới

**Bước 1:** Nhấn **"Create"**

**Bước 2:** Điền thông tin:
- **Name:** Tên danh mục (VD: Adventure, Cultural, Family, Beach)
- **Slug:** Đường dẫn URL (tự động tạo)
- **Active:** Trạng thái hoạt động

**Bước 3:** Nhấn **"Create"**

#### Các Danh Mục Phổ Biến
- Adventure (Mạo hiểm)
- Cultural (Văn hóa)
- Beach (Biển)
- Food Tour (Ẩm thực)
- Wellness (Sức khỏe)
- Eco-Tourism (Du lịch sinh thái)
- Family (Gia đình)

---

### 3.2 Quản Lý Tour

#### Truy Cập

Menu trái → **Content** → **Tours**

#### Danh Sách Tour

Trang hiển thị:
- **Image:** Hình ảnh đại diện
- **Title:** Tên tour
- **Destination:** Điểm đến
- **Price:** Giá tour
- **Rating:** Đánh giá
- **Featured/Active:** Trạng thái

#### Thêm Tour Mới

Form thêm tour được chia thành nhiều tab:

##### Tab 1: Basic Information (Thông tin cơ bản)

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Title** | Tên tour | ✅ |
| **Slug** | Đường dẫn URL | ✅ |
| **Destination** | Chọn điểm đến | ✅ |
| **City** | Chọn thành phố (danh sách thay đổi theo điểm đến) | ❌ |
| **Excerpt** | Tóm tắt ngắn (hiển thị trong danh sách) | ❌ |
| **Description** | Mô tả chi tiết tour | ❌ |

##### Tab 2: Pricing & Duration (Giá & Thời gian)

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Duration (Days)** | Số ngày tour | ❌ |
| **Price Type** | Loại giá: Fixed (Cố định) / From (Từ) / Contact (Liên hệ) | ✅ |
| **Price** | Giá tour (USD) - hiển thị nếu chọn Fixed hoặc From | ❌ |
| **Rating** | Đánh giá từ 0-5 sao | ❌ |

**Giải thích Price Type:**
- **Fixed:** Hiển thị giá cố định (VD: $500)
- **From:** Hiển thị giá khởi điểm (VD: From $500)
- **Contact:** Hiển thị "Contact for Price"

##### Tab 3: Itinerary (Lịch trình)

Sử dụng trình soạn thảo văn bản để viết lịch trình chi tiết theo từng ngày.

**Ví dụ cấu trúc:**
```
Ngày 1: Đón khách - Tham quan thành phố
- Đón khách tại sân bay
- Check-in khách sạn
- Tham quan trung tâm thành phố

Ngày 2: Tour tham quan di tích
- Thăm đền chùa lịch sử
- Ăn trưa đặc sản địa phương
...
```

##### Tab 4: Inclusions & Exclusions (Bao gồm & Không bao gồm)

**Inclusions (Dịch vụ bao gồm):**
Liệt kê những gì có trong giá tour:
- Xe đưa đón
- Hướng dẫn viên
- Bữa ăn theo chương trình
- Vé tham quan
- v.v.

**Exclusions (Không bao gồm):**
Liệt kê những gì khách cần chi trả thêm:
- Vé máy bay
- Chi phí cá nhân
- Tip cho hướng dẫn viên
- v.v.

##### Tab 5: Categories (Danh mục)

Chọn một hoặc nhiều danh mục phù hợp với tour (có thể chọn nhiều).

##### Tab 6: Media (Hình ảnh)

**Featured Image (Hình đại diện):**
- Upload 1 hình ảnh chính
- **Kích thước khuyến nghị:** 1920x1080 pixels (tỷ lệ 16:9)
- Hình này hiển thị trong danh sách tour và đầu trang chi tiết

**Gallery (Bộ sưu tập):**
- Upload nhiều hình ảnh
- Có thể kéo thả để sắp xếp thứ tự
- **Kích thước khuyến nghị:** 1200x800 pixels

##### Tab 7: Settings (Cài đặt)

| Trường | Mô tả |
|--------|-------|
| **Order** | Thứ tự hiển thị (số nhỏ hiển thị trước) |
| **Featured** | Đánh dấu tour nổi bật |
| **Active** | Bật/tắt hiển thị trên website |

##### Tab 8: SEO

| Trường | Mô tả |
|--------|-------|
| **Meta Title** | Tiêu đề SEO (hiển thị trên tab trình duyệt và kết quả Google) |
| **Meta Description** | Mô tả SEO (hiển thị trong kết quả tìm kiếm Google) |

**Khuyến nghị SEO:**
- Meta Title: 50-60 ký tự
- Meta Description: 150-160 ký tự

#### Chỉnh Sửa Tour

1. Nhấn vào tên tour hoặc biểu tượng bút chì
2. Thực hiện thay đổi trong các tab
3. Nhấn **"Save changes"**

#### Lọc & Tìm Kiếm Tour

Sử dụng các bộ lọc:
- **Destination:** Lọc theo điểm đến
- **Categories:** Lọc theo danh mục
- **Active:** Lọc theo trạng thái
- **Featured:** Lọc tour nổi bật

---

## 4. Quản Lý Khách Sạn

### 4.1 Truy Cập

Menu trái → **Content** → **Hotels**

### 4.2 Thêm Khách Sạn Mới

**Bước 1:** Nhấn **"Create"**

**Bước 2:** Điền thông tin trong các phần:

#### Phần Basic Information

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Destination** | Chọn điểm đến | ✅ |
| **Name** | Tên khách sạn | ✅ |
| **Slug** | Đường dẫn URL | ✅ |
| **Address** | Địa chỉ đầy đủ | ❌ |
| **Description** | Mô tả về khách sạn | ❌ |

#### Phần Pricing & Rating

| Trường | Mô tả |
|--------|-------|
| **Rating** | Số sao khách sạn (0-5) |
| **Price Per Night** | Giá phòng mỗi đêm (USD) |

#### Phần Room Types (Loại phòng)

Nhấn **"Add Room Type"** để thêm loại phòng:
- **Name:** Tên loại phòng (VD: Standard, Deluxe, Suite)
- **Capacity:** Sức chứa (số người)

Bạn có thể thêm nhiều loại phòng khác nhau.

#### Phần Amenities (Tiện nghi)

Nhập các tiện nghi của khách sạn. Hệ thống gợi ý sẵn các tiện nghi phổ biến:
- Free WiFi
- Swimming Pool
- Spa
- Gym/Fitness Center
- Restaurant
- Room Service
- Airport Shuttle
- Parking
- Bar/Lounge
- Business Center
- Laundry Service
- Pet Friendly

Bạn có thể nhập thêm tiện nghi khác ngoài danh sách gợi ý.

#### Phần Media

**Featured Image:**
- Upload 1 hình ảnh đại diện
- **Kích thước khuyến nghị:** 1200x900 pixels (tỷ lệ 4:3)

**Gallery:**
- Upload nhiều hình ảnh
- Có thể sắp xếp lại thứ tự bằng kéo thả

#### Phần Settings

- **Order:** Thứ tự hiển thị
- **Featured:** Đánh dấu khách sạn nổi bật
- **Active:** Bật/tắt hiển thị

**Bước 3:** Nhấn **"Create"** để lưu

---

## 5. Quản Lý Nội Dung MICE

MICE là viết tắt của Meetings (Hội họp), Incentives (Khen thưởng), Conferences (Hội nghị), và Events/Exhibitions (Sự kiện/Triển lãm). Đây là mảng du lịch doanh nghiệp.

### 5.1 Truy Cập

Menu trái → **Content** → **MICE Content**

### 5.2 Thêm Nội Dung MICE

Form được chia thành các tab:

#### Tab Content (Nội dung)

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Destination** | Chọn quốc gia/điểm đến | ✅ |
| **Region** | Vùng/Khu vực cụ thể | ❌ |
| **Title** | Tiêu đề | ✅ |
| **Subtitle** | Phụ đề | ❌ |
| **Description** | Mô tả chi tiết | ❌ |

#### Tab Features (Tính năng)

**Capacity (Sức chứa):**
- **Min Delegates:** Số đại biểu tối thiểu
- **Max Delegates:** Số đại biểu tối đa

**Venue Features (Tính năng địa điểm):**
Chọn từ danh sách gợi ý:
- Conference Rooms
- Auditorium
- Exhibition Hall
- Meeting Rooms
- Outdoor Venue
- Ballroom
- Breakout Rooms
- Theater

**Services Included (Dịch vụ đi kèm):**
- Catering
- AV Equipment
- WiFi
- Event Planning
- Translation Services
- Transportation
- Accommodation
- Entertainment

**Highlights:** Các điểm nổi bật về địa điểm/dịch vụ

#### Tab Media

- Featured Image
- Gallery

#### Tab Settings

- Order
- Featured
- Active

---

## 6. Quản Lý Blog

### 6.1 Quản Lý Danh Mục Blog

#### Truy Cập

Menu trái → **Blog** → **Blog Categories**

#### Thêm Danh Mục

1. Nhấn **"Create"**
2. Điền:
   - **Name:** Tên danh mục
   - **Slug:** Đường dẫn URL
   - **Active:** Trạng thái
3. Nhấn **"Create"**

---

### 6.2 Quản Lý Bài Viết Blog

#### Truy Cập

Menu trái → **Blog** → **Blog Posts**

#### Danh Sách Bài Viết

Hiển thị:
- Image
- Title
- Category
- Author
- Published Date
- Featured
- Active

#### Thêm Bài Viết Mới

**Bước 1:** Nhấn **"Create"**

**Bước 2:** Điền thông tin:

##### Phần Basic Information

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Category** | Chọn danh mục bài viết | ✅ |
| **Title** | Tiêu đề bài viết | ✅ |
| **Slug** | Đường dẫn URL | ✅ |
| **Author** | Tên tác giả | ❌ |
| **Published At** | Ngày xuất bản (để trống = chưa xuất bản) | ❌ |
| **Excerpt** | Tóm tắt ngắn (hiển thị trong danh sách) | ❌ |

##### Phần Content

Sử dụng trình soạn thảo văn bản để viết nội dung bài viết. Hỗ trợ:
- Tiêu đề (H1, H2, H3...)
- In đậm, in nghiêng
- Danh sách có đánh số và không đánh số
- Link
- Hình ảnh trong nội dung

##### Phần Image

Upload hình ảnh đại diện cho bài viết.
- **Kích thước khuyến nghị:** 1200x630 pixels

##### Phần SEO

| Trường | Khuyến nghị |
|--------|-------------|
| **Meta Title** | 50-60 ký tự, chứa từ khóa chính |
| **Meta Description** | 150-160 ký tự, mô tả hấp dẫn |

##### Phần Settings

- **Featured:** Đánh dấu bài viết nổi bật (hiển thị ở vị trí đặc biệt)
- **Active:** Bật/tắt hiển thị

**Bước 3:** Nhấn **"Create"** để lưu

#### Đăng Bài Viết

Để bài viết hiển thị trên website:
1. Đảm bảo **Active** đã được bật
2. Điền ngày vào **Published At** (ngày trong quá khứ hoặc hiện tại)

> **Lưu ý:** Bài viết với ngày Published At trong tương lai sẽ tự động hiển thị khi đến ngày đó.

---

## 7. Quản Lý Trang

### 7.1 Truy Cập

Menu trái → **Pages** → **Pages**

### 7.2 Các Loại Template

Hệ thống hỗ trợ các template:
- **Default:** Trang nội dung thông thường
- **About:** Template trang giới thiệu (có cấu trúc đặc biệt)
- **MICE:** Template trang MICE
- **Contact:** Template trang liên hệ

### 7.3 Thêm Trang Mới

**Bước 1:** Nhấn **"Create"**

**Bước 2:** Điền thông tin:

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Title** | Tiêu đề trang | ✅ |
| **Slug** | Đường dẫn URL | ✅ |
| **Template** | Chọn template phù hợp | ✅ |
| **Content** | Nội dung trang (rich text) | ❌ |
| **Meta Title** | Tiêu đề SEO | ❌ |
| **Meta Description** | Mô tả SEO | ❌ |
| **Active** | Bật/tắt hiển thị | ✅ |

**Bước 3:** Nhấn **"Create"**

### 7.4 Ví Dụ Các Trang Thường Tạo

- Privacy Policy (Chính sách bảo mật)
- Terms of Service (Điều khoản dịch vụ)
- FAQ (Câu hỏi thường gặp)
- Cancellation Policy (Chính sách hủy tour)

---

## 8. Quản Lý Slider & Điểm Khác Biệt

### 8.1 Quản Lý Slider (Trình chiếu trang chủ)

#### Truy Cập

Menu trái → **Pages** → **Sliders**

#### Thêm Slide Mới

**Bước 1:** Nhấn **"Create"**

**Bước 2:** Điền thông tin:

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Title** | Tiêu đề chính của slide | ✅ |
| **Subtitle** | Phụ đề | ❌ |
| **Button Text** | Chữ trên nút (VD: "Khám phá ngay") | ❌ |
| **Button URL** | Link khi nhấn nút | ❌ |
| **Image** | Hình ảnh slide | ✅ |
| **Order** | Thứ tự hiển thị | ✅ |
| **Active** | Bật/tắt hiển thị | ✅ |

**Yêu cầu hình ảnh:**
- **Kích thước khuyến nghị:** 1920x800 pixels hoặc lớn hơn
- **Tỷ lệ:** Ngang (landscape)
- **Chất lượng:** Cao, không bị vỡ hạt

**Bước 3:** Nhấn **"Create"**

#### Sắp Xếp Slider

Kéo thả các slide trong danh sách để thay đổi thứ tự hiển thị.

---

### 8.2 Quản Lý Điểm Khác Biệt (Differentiators)

Đây là các điểm USP (Unique Selling Points) của công ty, thường hiển thị ở trang chủ.

#### Truy Cập

Menu trái → **Pages** → **Differentiators**

#### Thêm Điểm Khác Biệt

**Bước 1:** Nhấn **"Create"**

**Bước 2:** Điền thông tin:

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Title** | Tiêu đề ngắn gọn | ✅ |
| **Description** | Mô tả chi tiết | ❌ |
| **Icon** | Tên icon Heroicon hoặc emoji | ❌ |
| **Order** | Thứ tự hiển thị | ✅ |
| **Active** | Bật/tắt | ✅ |

**Ví dụ Icon:**
- `shield-check` - Biểu tượng an toàn
- `clock` - Biểu tượng thời gian
- `currency-dollar` - Biểu tượng giá cả
- `users` - Biểu tượng đội ngũ
- Hoặc dùng emoji: 🌟 ✈️ 🏆

**Bước 3:** Nhấn **"Create"**

---

## 9. Cấu Hình Trang Giới Thiệu (About)

### 9.1 Truy Cập

Menu trái → **Pages** → **About Page**

### 9.2 Các Tab Cấu Hình

#### Tab Hero (Banner đầu trang)

| Trường | Mô tả |
|--------|-------|
| **Category Label** | Nhãn nhỏ phía trên tiêu đề (VD: "About Us") |
| **Headline Line 1** | Dòng tiêu đề thứ 1 |
| **Headline Line 2** | Dòng tiêu đề thứ 2 |
| **Headline Line 3** | Dòng tiêu đề thứ 3 |
| **Subtitle** | Phụ đề mô tả ngắn |
| **Hero Image** | Hình ảnh banner (khuyến nghị 1920x1080px) |

#### Tab Story & Mission

**Story Section (Câu chuyện):**
- **Story Title:** Tiêu đề phần câu chuyện
- **Story Content:** Nội dung về câu chuyện hình thành công ty
- **Story Image:** Hình ảnh minh họa

**Mission Section (Sứ mệnh):**
- **Mission Title:** Tiêu đề phần sứ mệnh
- **Mission Content:** Nội dung sứ mệnh của công ty
- **Mission Image:** Hình ảnh minh họa

#### Tab Vision (Tầm nhìn)

- **Vision Title:** Tiêu đề phần tầm nhìn
- **Vision Content:** Nội dung tầm nhìn
- **Vision Image:** Hình ảnh minh họa

#### Tab Strengths (Điểm mạnh - Why Choose Us)

Thêm tối đa 4 điểm mạnh của công ty:

Nhấn **"Add Strength"** để thêm:
- **Title:** Tiêu đề điểm mạnh
- **Description:** Mô tả chi tiết
- **Active:** Bật/tắt hiển thị

Kéo thả để sắp xếp thứ tự.

#### Tab Stats (Số liệu thống kê)

Cấu hình 4 số liệu thống kê:

| Stat | Ví dụ |
|------|-------|
| **Stat 1** | Number: "500+", Label: "Tours hoàn thành" |
| **Stat 2** | Number: "10,000+", Label: "Khách hàng hài lòng" |
| **Stat 3** | Number: "50+", Label: "Điểm đến" |
| **Stat 4** | Number: "15+", Label: "Năm kinh nghiệm" |

#### Tab SEO

- **Meta Title:** Tiêu đề SEO cho trang About
- **Meta Description:** Mô tả SEO

### 9.3 Lưu Thay Đổi

Sau khi cấu hình xong, nhấn **"Save"** ở cuối trang để lưu tất cả thay đổi.

---

## 10. Quản Lý Điều Hướng (Navigation)

### 10.1 Truy Cập

Menu trái → **Settings** → **Navigation**

### 10.2 Các Loại Menu

Hệ thống hỗ trợ 2 vị trí menu:
- **Header:** Menu trên cùng của website
- **Footer:** Menu ở chân trang

### 10.3 Thêm Menu Item

**Bước 1:** Nhấn **"Create"**

**Bước 2:** Điền thông tin:

| Trường | Mô tả | Bắt buộc |
|--------|-------|----------|
| **Title** | Tên hiển thị trên menu | ✅ |
| **Location** | Vị trí: Header hoặc Footer | ✅ |
| **Type** | Loại link (xem bên dưới) | ✅ |

**Các loại Type:**

**1. Custom URL (URL tùy chỉnh):**
- Nhập URL đầy đủ (VD: https://facebook.com/victoriatour)
- Thường dùng cho link ngoài website

**2. Named Route (Route có sẵn):**
Chọn từ danh sách:
- `home` - Trang chủ
- `tours.index` - Danh sách tour
- `destinations.index` - Danh sách điểm đến
- `blog.index` - Blog
- `contact` - Liên hệ
- `search` - Tìm kiếm

**3. CMS Page (Trang CMS):**
- Chọn một trang đã tạo trong mục Pages
- Thường dùng cho Privacy Policy, Terms, FAQ...

**Các trường bổ sung:**
- **Icon:** Tên icon Heroicon (tùy chọn)
- **Target:** `_self` (mở cùng tab) hoặc `_blank` (mở tab mới)
- **Active:** Bật/tắt hiển thị

**Bước 3:** Nhấn **"Create"**

### 10.4 Ví Dụ Cấu Hình Menu

**Header Menu:**
| Title | Type | Route/URL |
|-------|------|-----------|
| Trang chủ | Named Route | home |
| Tour | Named Route | tours.index |
| Điểm đến | Named Route | destinations.index |
| Blog | Named Route | blog.index |
| Liên hệ | Named Route | contact |

**Footer Menu:**
| Title | Type | Page |
|-------|------|------|
| Chính sách bảo mật | CMS Page | privacy-policy |
| Điều khoản dịch vụ | CMS Page | terms-of-service |
| FAQ | CMS Page | faq |

---

## 11. Quản Lý Yêu Cầu Khách Hàng

### 11.1 Truy Cập

Menu trái → **Inquiries** → **Inquiries**

> **Lưu ý:** Số badge màu cam trên menu cho biết số yêu cầu mới chưa xử lý.

### 11.2 Các Loại Yêu Cầu

| Loại | Mô tả | Màu |
|------|-------|-----|
| **Contact** | Yêu cầu từ form liên hệ | Xanh dương |
| **Tour Booking** | Yêu cầu đặt tour | Xanh lá |
| **Newsletter** | Đăng ký nhận tin | Tím |

### 11.3 Trạng Thái Yêu Cầu

| Trạng thái | Mô tả | Màu |
|------------|-------|-----|
| **New** | Yêu cầu mới, chưa xem | Cam (Warning) |
| **Read** | Đã xem, chưa phản hồi | Xám |
| **Replied** | Đã phản hồi | Xanh lá |

### 11.4 Xem Chi Tiết Yêu Cầu

1. Nhấn vào tên khách hàng hoặc biểu tượng mắt
2. Xem đầy đủ thông tin:
   - Loại yêu cầu
   - Tour liên quan (nếu là Tour Booking)
   - Tên, email, số điện thoại
   - Nội dung tin nhắn
   - Trạng thái hiện tại

### 11.5 Cập Nhật Trạng Thái

1. Nhấn biểu tượng bút chì để chỉnh sửa
2. Thay đổi **Status** thành:
   - **Read:** Khi đã xem yêu cầu
   - **Replied:** Khi đã phản hồi khách hàng
3. Nhấn **"Save changes"**

### 11.6 Quy Trình Xử Lý Yêu Cầu

**Bước 1:** Kiểm tra Dashboard hàng ngày để thấy yêu cầu mới

**Bước 2:** Mở yêu cầu và đọc nội dung

**Bước 3:** Cập nhật trạng thái thành **Read**

**Bước 4:** Phản hồi khách hàng qua email hoặc điện thoại

**Bước 5:** Cập nhật trạng thái thành **Replied**

### 11.7 Lọc Yêu Cầu

Sử dụng bộ lọc:
- **Type:** Lọc theo loại yêu cầu
- **Status:** Lọc theo trạng thái

---

## 12. Cài Đặt Hệ Thống

### 12.1 Truy Cập

Menu trái → **Settings** → **Settings**

### 12.2 Các Phần Cài Đặt

#### General Settings (Cài đặt chung)

| Trường | Mô tả |
|--------|-------|
| **Site Name** | Tên website (VD: Victoria Tour) |
| **Tagline** | Slogan/Khẩu hiệu |

#### Contact Information (Thông tin liên hệ)

| Trường | Mô tả |
|--------|-------|
| **Phone** | Số điện thoại liên hệ |
| **Email** | Email liên hệ |
| **Address** | Địa chỉ văn phòng |

#### Social Media (Mạng xã hội)

Nhập URL đầy đủ cho các trang:
- Facebook
- Twitter/X
- Instagram
- YouTube
- TikTok

#### Branding & Media (Thương hiệu)

| Trường | Mô tả | Kích thước khuyến nghị |
|--------|-------|------------------------|
| **Header Logo** | Logo hiển thị ở header | PNG trong suốt, cao ~60px |
| **Footer Logo** | Logo hiển thị ở footer | PNG trong suốt |
| **Favicon** | Icon tab trình duyệt | 32x32px hoặc 16x16px |
| **OG Image** | Hình ảnh khi share trên mạng xã hội | 1200x630px |

#### SEO Settings (Cài đặt SEO)

| Trường | Mô tả |
|--------|-------|
| **Default Meta Title** | Tiêu đề SEO mặc định |
| **Default Meta Description** | Mô tả SEO mặc định |

#### Analytics & Tracking (Phân tích)

| Trường | Mô tả |
|--------|-------|
| **Google Analytics ID** | ID Google Analytics (GA4: G-XXXXXXXXXX) |
| **Google Tag Manager ID** | ID GTM (GTM-XXXXXXX) |

### 12.3 Lưu Cài Đặt

Nhấn **"Save"** ở cuối trang để lưu tất cả thay đổi.

---

## 13. Cài Đặt Footer

### 13.1 Truy Cập

Menu trái → **Settings** → **Footer**

### 13.2 Các Tab Cài Đặt

#### Tab Branding

| Trường | Mô tả |
|--------|-------|
| **Footer Logo** | Logo hiển thị ở footer |
| **Copyright Text** | Dòng bản quyền (VD: © 2024 Victoria Tour. All rights reserved.) |

#### Tab Contact Info

Thông tin liên hệ hiển thị ở footer (đồng bộ với Settings chính):
- Phone
- Email
- Address

#### Tab Social Media

Link mạng xã hội hiển thị ở footer (đồng bộ với Settings chính).

#### Tab Destinations

Chọn các điểm đến sẽ hiển thị trong footer. Tick vào checkbox của các điểm đến muốn hiển thị.

#### Tab Column Layout

Thông tin về cách quản lý cột footer (tham khảo để hiểu cấu trúc).

### 13.3 Lưu Thay Đổi

Nhấn **"Save"** để lưu.

---

## 14. Quản Lý Ngôn Ngữ

### 14.1 Truy Cập

Menu trái → **Settings** → **Languages**

### 14.2 Danh Sách Ngôn Ngữ

Hệ thống hỗ trợ sẵn:
- **English (EN)** - Tiếng Anh
- **Vietnamese (VI)** - Tiếng Việt

### 14.3 Cấu Hình Ngôn Ngữ

| Trường | Mô tả |
|--------|-------|
| **Code** | Mã ngôn ngữ (en, vi) |
| **Name** | Tên tiếng Anh |
| **Native Name** | Tên bằng ngôn ngữ đó |
| **Flag Icon** | Icon cờ quốc gia |
| **Order** | Thứ tự hiển thị |
| **Default** | Đánh dấu ngôn ngữ mặc định |
| **Active** | Bật/tắt ngôn ngữ |

### 14.4 Thay Đổi Ngôn Ngữ Mặc Định

1. Mở ngôn ngữ muốn đặt làm mặc định
2. Bật **"Is Default"**
3. Lưu thay đổi

---

## 15. Hướng Dẫn Nhập Liệu Đa Ngôn Ngữ

### 15.1 Cách Hoạt Động

Hệ thống Victoria Tour hỗ trợ đa ngôn ngữ cho hầu hết nội dung. Khi nhập liệu, bạn có thể nhập nội dung cho nhiều ngôn ngữ khác nhau.

### 15.2 Nhận Biết Trường Đa Ngôn Ngữ

Các trường hỗ trợ đa ngôn ngữ sẽ có **tab ngôn ngữ** ở phía trên (EN | VI). Nhấn vào tab để chuyển đổi giữa các ngôn ngữ.

### 15.3 Cách Nhập Liệu

**Bước 1:** Nhập nội dung tiếng Anh (tab EN)

**Bước 2:** Chuyển sang tab VI

**Bước 3:** Nhập nội dung tiếng Việt

**Bước 4:** Lưu - hệ thống sẽ lưu cả 2 phiên bản

### 15.4 Các Trường Thường Hỗ Trợ Đa Ngôn Ngữ

- Name/Title (Tên/Tiêu đề)
- Description (Mô tả)
- Excerpt (Tóm tắt)
- Content (Nội dung)
- Meta Title & Meta Description
- Address
- Itinerary (Lịch trình)
- Inclusions/Exclusions

### 15.5 Lưu Ý Quan Trọng

- Luôn nhập nội dung cho ngôn ngữ mặc định (thường là English)
- Nội dung tiếng Việt là tùy chọn nhưng nên có để phục vụ khách hàng Việt Nam
- Nếu thiếu nội dung một ngôn ngữ, hệ thống sẽ hiển thị ngôn ngữ mặc định

---

## 16. Mẹo & Thực Hành Tốt Nhất

### 16.1 Kích Thước Hình Ảnh Khuyến Nghị

| Loại | Kích thước | Tỷ lệ |
|------|------------|-------|
| Hero/Banner | 1920x1080px | 16:9 |
| Tour Featured Image | 1920x1080px | 16:9 |
| Hotel Featured Image | 1200x900px | 4:3 |
| Blog Image | 1200x630px | ~2:1 |
| Slider | 1920x800px | ~2.4:1 |
| Gallery Images | 1200x800px | 3:2 |
| Logo (Header) | Cao ~60px | PNG trong suốt |
| Favicon | 32x32px | 1:1 |
| OG Image | 1200x630px | ~2:1 |

### 16.2 SEO Best Practices

**Meta Title:**
- Độ dài: 50-60 ký tự
- Chứa từ khóa chính
- Mỗi trang có tiêu đề riêng biệt
- Ví dụ: "Tour Hà Nội 3 Ngày 2 Đêm | Victoria Tour"

**Meta Description:**
- Độ dài: 150-160 ký tự
- Mô tả hấp dẫn, kêu gọi hành động
- Chứa từ khóa tự nhiên
- Ví dụ: "Khám phá vẻ đẹp Hà Nội với tour 3 ngày 2 đêm. Giá từ $299. Đặt ngay để nhận ưu đãi đặc biệt!"

**Slug (URL):**
- Ngắn gọn, dễ đọc
- Sử dụng gạch ngang (-) thay vì gạch dưới
- Không dùng dấu tiếng Việt
- Ví dụ: `tour-ha-noi-3-ngay-2-dem`

### 16.3 Workflow Quản Lý Tour Hiệu Quả

**1. Tạo cấu trúc trước:**
- Tạo Destinations trước
- Tạo Cities thuộc mỗi Destination
- Tạo Tour Categories

**2. Thêm Tour:**
- Chuẩn bị sẵn hình ảnh (đã resize đúng kích thước)
- Viết sẵn nội dung trong Word/Google Docs
- Copy paste vào hệ thống
- Kiểm tra preview trước khi Active

**3. Quy trình cập nhật:**
- Cập nhật giá định kỳ
- Kiểm tra và cập nhật hình ảnh cũ
- Review và cập nhật nội dung theo mùa

### 16.4 Xử Lý Inquiries Nhanh Chóng

**Nguyên tắc:**
- Kiểm tra Dashboard ít nhất 2 lần/ngày
- Phản hồi yêu cầu trong vòng 24 giờ
- Cập nhật trạng thái ngay sau khi xử lý

**Ưu tiên:**
1. Tour Booking (Cao nhất - có thể mất khách)
2. Contact (Trung bình)
3. Newsletter (Thấp - tự động)

### 16.5 Backup & An Toàn

- Không chia sẻ thông tin đăng nhập
- Đăng xuất khi không sử dụng
- Thay đổi mật khẩu định kỳ
- Báo ngay cho bộ phận kỹ thuật nếu phát hiện bất thường

### 16.6 Xử Lý Sự Cố Thường Gặp

**Hình ảnh không upload được:**
- Kiểm tra kích thước file (tối đa 10MB)
- Đảm bảo định dạng JPG, PNG, hoặc WebP
- Thử refresh trang và upload lại

**Nội dung không hiển thị trên website:**
- Kiểm tra trạng thái Active đã bật chưa
- Với Blog: Kiểm tra Published At có giá trị chưa
- Clear cache trình duyệt và kiểm tra lại

**Không lưu được thay đổi:**
- Kiểm tra kết nối internet
- Đảm bảo các trường bắt buộc đã điền
- Refresh trang và thử lại

---

## Liên Hệ Hỗ Trợ

Nếu gặp vấn đề kỹ thuật hoặc cần hỗ trợ, vui lòng liên hệ:

- **Email:** [Email hỗ trợ kỹ thuật]
- **Điện thoại:** [Số điện thoại hỗ trợ]

---

*Tài liệu được cập nhật lần cuối: Tháng 12, 2024*
