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
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Lấy danh sách các bảng
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Danh sách các bảng trong cơ sở dữ liệu '$database':\n";
    foreach ($tables as $table) {
        echo "- $table\n";
        
        // Lấy số lượng bản ghi trong bảng
        $countStmt = $pdo->query("SELECT COUNT(*) FROM `$table`");
        $count = $countStmt->fetchColumn();
        
        echo "  Số bản ghi: $count\n";
        
        // Nếu có dữ liệu, hiển thị một số bản ghi đầu tiên
        if ($count > 0) {
            $rowsStmt = $pdo->query("SELECT * FROM `$table` LIMIT 3");
            $rows = $rowsStmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo "  Mẫu dữ liệu:\n";
            foreach ($rows as $row) {
                echo "    ";
                foreach ($row as $key => $value) {
                    if (strlen($key) <= 5) {
                        echo "$key: $value, ";
                    }
                }
                echo "\n";
            }
        }
        
        echo "\n";
    }
    
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage() . "\n";
} 