<?php
session_start();
require 'db.php';

$pdo = connectDB();
$stmt = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="css/style.css">
<h1>Posts</h1>
<?php foreach ($posts as $post): ?>
    <div class="post">
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p><?php echo htmlspecialchars($post['content']); ?></p>
        <p>By: <?php echo htmlspecialchars($post['username']); ?> on <?php echo $post['created_at']; ?></p>
        <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $post['user_id'] || $_SESSION['role'] == 'admin')): ?>
            <a href="/edit_post.php?id=<?php echo $post['id']; ?>">Edit</a>
            <a href="/delete_post.php?id=<?php echo $post['id']; ?>">Delete</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>