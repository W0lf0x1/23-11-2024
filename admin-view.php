<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$pdo = connectDB();
$stmt = $pdo->query("SELECT username, email FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="css/style.css">
<h1>Registered Users</h1>
<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo htmlspecialchars($user['username']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>