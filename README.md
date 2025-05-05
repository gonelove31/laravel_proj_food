# Order Food - Ứng dụng đặt đồ ăn

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

## Giới thiệu

Đây là ứng dụng đặt đồ ăn được phát triển bằng Laravel. Ứng dụng cho phép người dùng dễ dàng đặt món ăn trực tuyến, theo dõi đơn hàng và quản lý thanh toán.

## Tính năng chính

- **Đặt món ăn trực tuyến**: Dễ dàng chọn và đặt món ăn từ menu
- **Quản lý đơn hàng**: Theo dõi trạng thái đơn hàng
- **Thanh toán trực tuyến**: Hỗ trợ nhiều phương thức thanh toán
- **Quản lý người dùng**: Đăng ký, đăng nhập và quản lý tài khoản
- **Hệ thống admin**: Quản lý danh mục, sản phẩm, đơn hàng và người dùng

## Cài đặt và sử dụng

```bash
# Clone repository
git clone https://github.com/gonelove31/laravel_proj_food.git

# Di chuyển vào thư mục dự án
cd laravel_proj_food

# Cài đặt dependencies
composer install
npm install

# Cấu hình môi trường
cp .env.example .env
php artisan key:generate

# Chạy migrations và seeders
php artisan migrate --seed

# Khởi động server
php artisan serve
```

## Cấu trúc dự án

```
app/                  # Chứa mã nguồn chính của ứng dụng
├── Http/             # Controllers, Middleware, và Requests
├── Models/           # Các model của ứng dụng
├── Providers/        # Service providers
├── ...
resources/            # Views, assets, và ngôn ngữ
├── js/               # JavaScript
├── css/              # CSS và SASS
├── views/            # Blade templates
routes/               # Định nghĩa các routes
tests/                # Tests
database/             # Migrations và seeders
```

## Đóng góp

Mọi đóng góp đều được chào đón. Hãy tạo issue hoặc pull request để cải thiện ứng dụng.

## Liên hệ

Nếu có bất kỳ câu hỏi hoặc góp ý nào, vui lòng liên hệ qua email.
