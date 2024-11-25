<?php
define('DB_HOST', '151.248.115.10:3306');
define('DB_NAME', 'is64_horochev');
define('DB_USER', 'root');
define('DB_PASS', 'Kwuy1mSu4Y');

function connectDB() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}
?>