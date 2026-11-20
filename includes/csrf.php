<?php
// Function to generate CSRF token
function csrf_token() {
  if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
  return $_SESSION['csrf'];
}

// Function to check CSRF token
function check_csrf() {
  if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
    die("Invalid CSRF token");
  }
}
?>
