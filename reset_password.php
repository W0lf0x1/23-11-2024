<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50));
    $expires = date("U") + 1800;

    $pdo = connectDB();
    $stmt = $pdo->prepare("INSERT INTO password_reset_tokens (user_id, token, created_at, expired_at) VALUES ((SELECT id FROM users WHERE email = :email), :token, NOW(), FROM_UNIXTIME(:expires))");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':expires', $expires);

    if ($stmt->execute()) {
        $resetLink = "/registrahion.php" . $token;
        mail($email, "Password Reset", "Click this link to reset your password: " . $resetLink);
        echo "Check your email for the password reset link.";
    } else {
        echo "Error occurred.";
    }
}
?>

<link rel="stylesheet" href="css/style.css">
<form method="POST">
    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Reset Password</button>
</form>