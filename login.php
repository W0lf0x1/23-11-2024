<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        echo "Login successful!";
    } else {
        echo "Invalid email or password.";
    }
}
?>
    <link rel="stylesheet" href="css/style.css">
    <div class="menu-list">
        <a href="/create_post.php">Create post</a>
        <a href="view_posts.php">Check posts</a>
        <a href="/view_accounts.php">Admin panel</a>
        <a href="/edit_account.php">Change your account</a>
    </div>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <a href="/registration.php">Dont have account?</a>
</form>