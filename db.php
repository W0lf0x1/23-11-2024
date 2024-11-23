<?php
$dsn = "mysql:host=151.248.115.10;port=3306;dbname=is64_horochev";
$username = "root";
$password = "Kwuy1mSu4Y";

try {
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
die("Connection failed: " . $e->getMessage());
}
?>