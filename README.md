# Báo Cáo Môn Web Nâng Cao: Trang Web Bán Hoa 
# Sinh viên thực hiện: Phạm Như Thuật - 22010498

## 1. Giới thiệu dự án

Dự án phát triển một trang web bán hoa trực tuyến nhằm cung cấp nền tảng cho phép khách hàng xem, chọn và đặt mua các sản phẩm hoa một cách dễ dàng. Trang web được xây dựng như một yêu cầu của môn Web Nâng Cao, sử dụng **PHP Laravel** làm framework backend, **MySQL** làm cơ sở dữ liệu, và giao diện frontend được phát triển với **HTML** và **CSS**. Mục tiêu là tạo ra một hệ thống thương mại điện tử cơ bản, thân thiện với người dùng và đáp ứng các yêu cầu kỹ thuật của môn học.

## 2. Công nghệ sử dụng

### 2.1. Backend

- **PHP Laravel**: Framework PHP mạnh mẽ, hỗ trợ mô hình MVC (Model-View-Controller), giúp tổ chức mã nguồn rõ ràng và dễ bảo trì.
  - Xử lý các chức năng như quản lý sản phẩm, giỏ hàng, và đơn hàng.
- **MySQL**: Cơ sở dữ liệu quan hệ dùng để lưu trữ thông tin về sản phẩm, khách hàng, và đơn hàng.
  - **Cấu trúc bảng chính**:
    - `products`: Lưu thông tin sản phẩm (ID, tên, giá, mô tả, hình ảnh).
    - `users`: Lưu thông tin người dùng (ID, tên, email, mật khẩu).
    - `orders`: Lưu thông tin đơn hàng (ID, ID khách hàng, tổng tiền, trạng thái).
    - `order_details`: Chi tiết đơn hàng (ID sản phẩm, số lượng, giá).
  - **Các bảng khác**:
    - `banners`: Lưu thông tin banner.
    - `brands`: Lưu thông tin thương hiệu.
    - `categories`: Lưu thông tin danh mục.
    - `contacts`: Lưu thông tin liên hệ.
    - `menus`: Lưu thông tin menu.
    - `posts`: Lưu thông tin bài viết.
    - `topics`: Lưu thông tin chủ đề.
    - `migrations`, `cache`, `cache_locks`, `failed_jobs`, `job_batches`, `password_resets`, `sessions`: Bảng hỗ trợ hệ thống Laravel.

### 2.2. Frontend

- **HTML**: Xây dựng cấu trúc giao diện cho các trang như trang chủ, danh sách sản phẩm, chi tiết sản phẩm, giỏ hàng, và thanh toán.
- **CSS**: Thiết kế giao diện responsive, đảm bảo hiển thị tốt trên cả desktop và thiết bị di động.
  - Sử dụng **Flexbox** và **Grid** để bố cục.
  - Áp dụng các hiệu ứng **hover** và **animation** cơ bản để tăng trải nghiệm người dùng.

### 2.3. Các công cụ hỗ trợ

- **Composer**: Quản lý thư viện PHP.
- **Laravel Artisan**: Hỗ trợ tạo model, controller, và migration.

## 3. Cấu trúc hệ thống

### 3.1. Chức năng chính

- **Khách hàng**:
  - Xem danh sách sản phẩm hoa, phân bón (lọc theo loại hoa, giá).
  - Xem chi tiết sản phẩm (hình ảnh, mô tả, giá).
  - Thêm sản phẩm vào giỏ hàng và đặt hàng.
  - Đăng ký/đăng nhập tài khoản.
- **Quản trị viên**:
  - Quản lý sản phẩm (thêm, sửa, xóa).
  - Xem và cập nhật trạng thái đơn hàng.

### 3.2. Cấu trúc mã nguồn

- **Routes** (`routes/web.php`): Định nghĩa các route cho trang chủ, sản phẩm, giỏ hàng, và khu vực quản trị.
- **Controllers**:
  - `ProductController`: Xử lý hiển thị và quản lý sản phẩm.
  - `CartController`: Quản lý giỏ hàng.
  - `OrderController`: Xử lý đơn hàng.
- **Models**: Sử dụng Eloquent để ánh xạ các bảng trong cơ sở dữ liệu.
- **Views**: Blade templates cho giao diện (trang chủ, sản phẩm, giỏ hàng).
- **Database Migrations**: Định nghĩa cấu trúc bảng MySQL.

### 3.3. Luồng hoạt động

1. Người dùng truy cập trang chủ, xem danh sách sản phẩm.
2. Chọn sản phẩm, thêm vào giỏ hàng (lưu tạm trong session hoặc database).
3. Đăng nhập/đăng ký để đặt hàng.
4. Gửi thông tin đơn hàng đến backend, lưu vào bảng `orders` và `order_details`.
5. Quản trị viên xem và xử lý đơn hàng qua giao diện admin.

## 5. Bảo mật

- **Validation Input**: Áp dụng kiểm tra và xác thực đầu vào (input validation) trên các form như đăng ký, đăng nhập, và đặt hàng để ngăn chặn các cuộc tấn công như SQL Injection và Cross-Site Scripting (XSS).
  - Sử dụng các quy tắc validation của Laravel (ví dụ: `required`, `email`, `max`, v.v.) để đảm bảo dữ liệu nhập vào hợp lệ.
  - Xử lý lỗi và thông báo người dùng khi dữ liệu không đúng định dạng.