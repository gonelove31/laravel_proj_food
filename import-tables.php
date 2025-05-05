<?php

// Cấu hình kết nối MySQL từ file .env
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$database = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

try {
    // Kết nối đến MySQL
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Xóa và tạo lại cơ sở dữ liệu
    $pdo->exec("DROP DATABASE IF EXISTS `$database`");
    echo "Đã xóa cơ sở dữ liệu cũ.\n";
    
    $pdo->exec("CREATE DATABASE `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Đã tạo cơ sở dữ liệu mới.\n";
    
    // Chuyển đến cơ sở dữ liệu mới tạo
    $pdo->exec("USE `$database`");
    
    // Sử dụng các migration của Laravel để tạo cấu trúc bảng
    echo "Đang chạy migration để tạo cấu trúc bảng...\n";
    $command = "php artisan migrate";
    echo shell_exec($command);
    
    echo "Đã tạo cấu trúc bảng. Bây giờ chạy các seeder cơ bản...\n";
    $seeders = [
        'UserSeeder',
        'CategorySeeder',
        'SectionTitleSeeder',
        'SettingSeeder',
        'PaymentGatewaySettingSeeder'
    ];
    
    foreach ($seeders as $seeder) {
        echo "Đang chạy $seeder...\n";
        $command = "php artisan db:seed --class=$seeder";
        echo shell_exec($command);
    }
    
    echo "Hoàn tất! Cơ sở dữ liệu đã được thiết lập lại.\n";
    
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage() . "\n";
} 