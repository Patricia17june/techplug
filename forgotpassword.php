<?php
require "config/connection.php";
require "includes/csrf.php";
require "includes/auth.php";
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_csrf();
  $token = bin2hex(random_bytes(32));
  $stmt = $pdo->prepare("UPDATE users SET reset_token=?, reset_expires=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email=?");
  $stmt->execute([$token, $_POST['email']]);
  $msg = "If email exists, reset link is: <br><a href='reset-password.php?token=$token'>reset-password.php?token=$token</a><br>(In real project this is emailed)";
}
?>

<h2>Forgot Password</h2><p><?= $msg ?></p>
<form method="POST">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
    <input name="email" type="email" placeholder="Your email" required>
    <button>Send Reset Link</button>
</form>