<?php
require 'db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
if ($stmt->execute([$username, $email, $password, $user_id])) {
echo "Profile updated!";
} else {
echo "Error: " . $stmt->error;
}
} else {
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
}
?>
<form method="post">
<input type="text" name="username" value="<?php echo $user['username']; ?>" required placeholder="Username">
<input type="email" name="email" value="<?php echo $user['email']; ?>" required placeholder="Email">
<input type="password" name="password" required placeholder="New Password">
<button type="submit">Update</button>
</form>