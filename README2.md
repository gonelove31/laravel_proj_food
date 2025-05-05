# Order Food Application

Laravel Food Ordering Application with payment integration.

## Features
- User Authentication
- Menu Management
- Cart & Checkout
- Payment Processing
- Order Tracking 

# Hướng dẫn xử lý thông tin nhạy cảm trong dự án Laravel

## Vấn đề gặp phải
Dự án gặp vấn đề khi đẩy code lên GitHub vì các API keys của Stripe, PayPal và Razorpay đã bị lộ trong các file:
- `database/seeders/PaymentGatewaySettingSeeder.php`
- `database.sql`
- Có thể còn nằm trong các commit trước đó

## Giải pháp đã thực hiện
1. Đã thay thế tất cả API keys thực trong `PaymentGatewaySettingSeeder.php` bằng các giá trị mẫu an toàn
2. Đã xóa file `database.sql` khỏi lịch sử Git bằng lệnh `git filter-branch`
3. Đã cố gắng force push lên GitHub với cờ -f

## Hướng dẫn cài đặt an toàn

### 1. Cài đặt dự án mới
Để cài đặt dự án mới an toàn (không có thông tin nhạy cảm), thực hiện các bước sau:

```bash
# Clone repository (không có lịch sử)
git clone --depth 1 https://github.com/username/order_food.git

# Cài đặt dependencies
composer install
npm install

# Cấu hình .env
cp .env.example .env
php artisan key:generate

# Cập nhật API keys thực trong file .env
# KHÔNG commit file .env lên GitHub
```

### 2. Xử lý API keys
- KHÔNG bao giờ lưu API keys thực trong code
- LUÔN sử dụng file `.env` để lưu thông tin nhạy cảm
- Đảm bảo file `.env` đã được thêm vào `.gitignore`
- Trong seeders và code, sử dụng `env('KEY_NAME')` để truy xuất giá trị từ file `.env`

### 3. Làm việc với file database
- KHÔNG commit file SQL chứa dữ liệu thực vào Git
- Sử dụng migrations và seeders với dữ liệu mẫu
- Nếu cần chia sẻ cấu trúc database, hãy loại bỏ dữ liệu thực

### 4. Kiểm tra code trước khi commit
```bash
# Kiểm tra không có thông tin nhạy cảm trước khi commit
git diff --staged

# Nếu thấy thông tin nhạy cảm, hãy loại bỏ trước khi commit
git reset HEAD <file>
```

### 5. Sửa lịch sử Git nếu đã lộ thông tin nhạy cảm
```bash
# Xóa file khỏi tất cả commit
git filter-branch --force --index-filter "git rm --cached --ignore-unmatch path/to/sensitive/file" --prune-empty --tag-name-filter cat -- --all

# Hoặc sửa nội dung trong file
git filter-branch --tree-filter "sed -i 's/api_key_actual/api_key_placeholder/g' file_with_keys.php" HEAD

# Force push lên remote repository
git push origin --force --all
```

Lưu ý: Việc sửa lịch sử Git sẽ ảnh hưởng đến tất cả các thành viên trong team, hãy thông báo trước khi thực hiện. 