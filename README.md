# FlowerSeller - Hệ Thống Quản Lý & Bán Hoa Trực Tuyến
# Sinh viên thực hiện: Phạm Như Thuật / MSSV: 22010498

## 1. Giới thiệu dự án

FlowerSeller là hệ thống thương mại điện tử chuyên về bán hoa, được xây dựng trên nền tảng PHP Laravel, hướng tới trải nghiệm người dùng hiện đại, thân thiện và tối ưu cho cả khách hàng lẫn quản trị viên. Dự án đáp ứng các yêu cầu thực tế về quản lý sản phẩm, đơn hàng, thương hiệu, chủ đề, bài viết, menu, đồng thời đảm bảo bảo mật, hiệu năng và khả năng mở rộng.

## 2. Kiến trúc & Công nghệ

- **Backend:** PHP Laravel (MVC), Eloquent ORM, MySQL
- **Frontend:** Blade Template, HTML5, CSS3 (Flexbox, Grid), Responsive UI, Badge, Icon, Animation
- **Công cụ hỗ trợ:** Composer, Laravel Artisan, Vite
- **Quản lý phiên bản:** Git

## 3. Cơ sở dữ liệu & Mô hình dữ liệu

- **Bảng chính:**
  - `users`: Người dùng hệ thống
  - `products`: Sản phẩm hoa
  - `orders`: Đơn hàng
  - `order_details`: Chi tiết đơn hàng
  - `categories`, `brands`, `banners`, `contacts`, `menus`, `posts`, `topics`

## 4. Chức năng hệ thống

### 4.1. Khách hàng
- Xem danh mục, chi tiết sản phẩm, lọc theo loại, giá
- Thêm vào giỏ hàng, đặt hàng, đăng ký/đăng nhập
- Xem lịch sử đơn hàng, thông tin liên hệ

### 4.2. Quản trị viên (Admin)
- Quản lý sản phẩm, danh mục, thương hiệu, chủ đề, bài viết, banner, menu
- Quản lý đơn hàng: xem, cập nhật, thống kê, xuất dữ liệu
- Quản lý người dùng, liên hệ
- Giao diện quản trị hiện đại, responsive, đồng bộ tiếng Việt, badge, icon, animation

## 5. Giao diện hệ thống
Dưới đây là một số ảnh chụp giao diện hệ thống FlowerSeller sau khi hiện đại hóa và đồng bộ UI/UX:

### Giao diện khách hàng

#### Trang chủ
![Trang chủ website](public/images/screenshots/home.png)

#### Trang danh sách sản phẩm
![Danh sách sản phẩm](public/images/screenshots/products.png)

#### Trang chi tiết sản phẩm
![Chi tiết sản phẩm](public/images/screenshots/product-detail.png)

#### Trang liên hệ
![Liên hệ](public/images/screenshots/contact.png)

#### Trang bài viết
![Bài viết](public/images/screenshots/post.png)

#### Trang giỏ hàng
![Giỏ hàng](public/images/screenshots/cart.png)

#### Trang đăng nhập
![Đăng nhập](public/images/screenshots/login.png)

#### Trang đăng ký
![Đăng ký](public/images/screenshots/register.png)

### Giao diện quản trị viên

#### Trang chủ chính
![Trang chủ chính](public/images/screenshots/trang-chu-chinh.png)

#### Trang quản lý người dùng
![Quản lý người dùng](public/images/screenshots/admin-user-list.png)

#### Trang quản lý sản phẩm
![Giao diện sản phẩm](public/images/screenshots/admin-product.png)

#### Trang quản trị danh mục sản phẩm
![Giao diện danh mục](public/images/screenshots/admin-category.png)

#### Trang quản trị thương hiệu
![Giao diện thương hiệu](public/images/screenshots/admin-brand.png)

#### Trang quản trị bài viết
![Giao diện bài viết](public/images/screenshots/admin-post.png)

#### Trang quản trị chủ đề
![Giao diện chủ đề](public/images/screenshots/admin-topic.png)

#### Trang quản lý đơn hàng
![Giao diện đơn hàng](public/images/screenshots/admin-order.png)

#### Trang quản lý menu
![Giao diện menu](public/images/screenshots/admin-menu.png)

## 6. Bảo mật & Xử lý dữ liệu

- **Validation:** Sử dụng validation Laravel cho mọi form (đăng ký, đăng nhập, đặt hàng, quản trị)
- **XSS/SQL Injection:** Escape dữ liệu, kiểm tra đầu vào, sử dụng Eloquent ORM
- **Quyền truy cập:** Phân quyền rõ ràng giữa khách và admin
- **Xử lý lỗi:** Thông báo rõ ràng, log lỗi hệ thống

## 7. Hướng dẫn cài đặt & sử dụng

1. **Yêu cầu:** PHP >= 8.x, Composer, MySQL
2. **Clone dự án:**
   ```bash
   git clone <repo-url>
   cd FlowerSeller
   ```
3. **Cài đặt package:**
   ```bash
   composer install
   npm install && npm run build
   ```
4. **Cấu hình môi trường:**
   - Copy `.env.example` thành `.env`, chỉnh sửa thông tin DB
   - Tạo database, chạy migration & seed:
     ```bash
     php artisan migrate --seed
     ```
5. **Khởi động server:**
   ```bash
   php artisan serve
   ```
6. **Truy cập:**
   - Trang khách: http://localhost:8000
   - Trang admin: http://localhost:8000/admin (tài khoản mẫu trong seed hoặc tạo mới)

## 8. Tính năng nổi bật

- **Giao diện responsive:** Tối ưu cho desktop
- **Quản lý đa dạng:** Sản phẩm, đơn hàng, người dùng, nội dung
- **Bảo mật cao:** Validation đầy đủ, phân quyền rõ ràng
- **UI/UX hiện đại:** Badge, icon, animation mượt mà
- **Tiếng Việt hoàn chỉnh:** Giao diện và thông báo đồng bộ

## 9. Cấu trúc thư mục chính

```
FlowerSeller/
├── app/                    # Logic ứng dụng
│   ├── Http/Controllers/   # Controllers
│   ├── Models/            # Models Eloquent
│   └── ...
├── database/              # Migration, seeder
├── public/               # Assets công khai
├── resources/            # Views, CSS, JS
├── routes/               # Định tuyến
└── storage/              # Lưu trữ file
```