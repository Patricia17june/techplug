<?php
require "config/connection.php";
require "includes/auth.php";
require "includes/csrf.php";

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_csrf();
  $name = $_POST['name']; 
  $email = $_POST['email']; 
  $phone = $_POST['phone'];
  $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
  try {
    $stmt = $pdo->prepare("INSERT INTO users (name,email,password_hash,phone) VALUES (?,?,?,?)");
    $stmt->execute([$name,$email,$hash,$phone]);
    $msg = "Account created! <a href='login.php'>Login now</a>";
  } catch(Exception $e) { $msg = "Email already exists."; }
}
?>
<h2>Register - TechPlug</h2>
<p><?= $msg ?></p>
<form method="POST">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
    <input name="name" placeholder="Full Name" required><br><br>
    <input name="email" type="email" placeholder="Email" required><br><br>
    <input name="phone" placeholder="Phone" required><br><br>
    <input name="password" type="password" placeholder="Password" required><br><br>
    <button>Register</button>
</form>
<a href="login.php">Already have account? Login</a>
