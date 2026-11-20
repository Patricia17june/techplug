<?php
// Database connection settings
$host = "localhost";
$db = "techplug";
$user = "root";
$pass = "";

try {
  // Create PDO connection
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
  // Enable exception mode for errors
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  // Die with error message if connection fails
  die("DB Error: " . $e->getMessage());
}
?>
