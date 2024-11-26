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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':id', $postId);

    if ($stmt->execute()) {
        echo "Post updated successfully!";
    } else {
        echo "Error updating post.";
    }
}
?>

<link rel="stylesheet" href="css/style.css">
<form method="POST">
    <input type="text" name="title " value="<?php echo htmlspecialchars($post['title']); ?>" required>
    <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
    <button type="submit">Update Post</button>
</form>