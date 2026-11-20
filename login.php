<?php
require "config/connection.php";
require "includes/auth.php";
require "includes/csrf.php";

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_csrf();
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$_POST['email']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user && password_verify($_POST['password'], $user['password_hash'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['name'] = $user['name'];
    header("Location: profile.php"); exit;
  } else { $msg = "Wrong email or password"; }
}
?>
<h2>Login - TechPlug</h2>
<p><?= $msg ?></p>
<form method="POST">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
    <input name="email" type="email" placeholder="Email" required><br><br>
    <input name="password" type="password" placeholder="Password" required><br><br>
    <button>Login</button>
</form>
<a href="register.php">No account? Register</a> | <a href="forgot-password.php">Forgot password?</a>
