<?php
require 'db.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
die("Access denied.");
}

$stmt = $pdo->query("SELECT username, email FROM users");
$users = $stmt->fetchAll();
?>
<table>
<tr>
<th>Username</th>
<th>Email</th>
</tr>
<?php foreach ($users as $user): ?>
<tr>
<td><?php echo $user['username']; ?></td>
<td><?php echo $user['email']; ?></td>
</tr>
<?php endforeach; ?>
</table>
