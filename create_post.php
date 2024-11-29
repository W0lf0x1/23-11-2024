<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $userId = $_SESSION['user_id'];

    $pdo = connectDB();
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (:user_id, :title, :content)");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);

    if ($stmt->execute()) {
        echo "Post created successfully!";
    } else {
        echo "Error creating post.";
    }
}
?>

<link rel="stylesheet" href="css/style.css">
<form method="POST">
    <input type="text" name="title" placeholder="Post Title" required>
    <textarea name="content" placeholder="Post Content" required></textarea>
    <button type="submit">Create Post</button>
</form>