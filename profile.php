<?php
require "config/connection.php";
require "includes/auth.php";
requireLogin();
$user = currentUser($pdo);
?>
<h2>Welcome, <?= htmlspecialchars($user['name']) ?> (<?= $user['role'] ?>)</h2>
<p>Email: <?= htmlspecialchars($user['email']) ?></p>
<p>Phone: <?= htmlspecialchars($user['phone']) ?></p>
<a href="addresses.php">My Addresses</a> | <a href="logout.php">Logout</a>
