<?php
require "config/db.php";
require "includes/csrf.php";
require "includes/auth.php";
$token = $_GET['token'] ?? '';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_csrf();
  $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = $pdo->prepare("UPDATE users SET password_hash=?, reset_token=NULL WHERE reset_token=? AND reset_expires > NOW()");
  $stmt->execute([$hash, $_POST['token']]);
  $msg = $stmt->rowCount() ? "Password changed! <a href='login.php'>Login</a>" : "Link expired.";
}
?>

<h2>Reset Password</h2><p><?= $msg ?></p>
<form method="POST">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    <input name="password" type="password" placeholder="New password" required>
    <button>Reset</button>
</form>
