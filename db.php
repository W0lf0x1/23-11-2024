<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DB_HOST', '192.168.199.13');
define('DB_NAME', 'learn_horochev364');
define('DB_USER', 'learn');
define('DB_PASS', 'learn');

function connectDB() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        
        return $pdo;
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}
?>