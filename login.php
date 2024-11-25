<?php
require 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
    } else {
        echo "Invalid email or password.";
    }
}
?>
<link rel="stylesheet" href="/css/style.css">
<form method="post">
    <h1>Вход</h1>
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <div>
        <button type="submit">Login</button>
    </div>

    <div style="text-align: center; margin-top:10px">
        <a href="/registr.php">Нету аккаунта?</a>
    </div>
</form>