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
    
    // Đọc file SQL
    $sql = file_get_contents('database.sql');
    
    // Tách các câu lệnh SQL bằng dấu chấm phẩy (;)
    $statements = explode(";\n", $sql);
    
    // Thực thi từng câu lệnh SQL
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            try {
                $pdo->exec($statement);
            } catch (PDOException $e) {
                echo "Lỗi khi thực thi câu lệnh: " . $e->getMessage() . "\n";
                echo "Câu lệnh: " . substr($statement, 0, 100) . "...\n";
            }
        }
    }
    
    echo "Đã nhập dữ liệu thành công!\n";
    
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage() . "\n";
} 