<?php
require 'db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $password])) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<link rel="stylesheet" href="/css/style.css">
<form method="post">
    <h1>Регистрация</h1>
    <input type="text" name="username" required placeholder="Username">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <div>
        <button type="submit">Register</button>
    </div>
    <div style="text-align: center; margin-top:10px">
        <a href="/login.php">Есть аккаунт?</a>
    </div>
</form>