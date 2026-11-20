<?php
session_start();

// Function to require login
function requireLogin() {
  if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); exit;
  }
}

// Function to require admin role
function requireAdmin() {
  requireLogin();
  if ($_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
  }
}

// Function to get current user details
function currentUser($pdo) {
  if (!isset($_SESSION['user_id'])) return null;
  $stmt=$pdo->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->execute([$_SESSION['user_id']]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
