<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$postId = $_GET['id'];
$pdo = connectDB();
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->bindParam(':id', $postId);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post || ($post['user_id'] != $_SESSION['user_id'] && $_SESSION['role'] !== 'admin')) {
    header('Location: view_posts.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
$stmt->bindParam(':id', $postId);

if ($stmt->execute()) {
    echo "Post deleted successfully!";
} else {
    echo "Error deleting post.";
}
header('Location: view_posts.php');
exit;