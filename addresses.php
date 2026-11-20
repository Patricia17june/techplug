<?php
require "config/connection.php";
require "includes/auth.php";
require "includes/csrf.php";
requireLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_csrf();
  $pdo->prepare("UPDATE addresses SET is_default=0 WHERE user_id=?")->execute([$_SESSION['user_id']]);
  $stmt = $pdo->prepare("INSERT INTO addresses (user_id,label,county,town,street,phone,is_default) VALUES (?,?,?,?,?,?,1)");
  $stmt->execute([$_SESSION['user_id'], $_POST['label'], $_POST['county'], $_POST['town'], $_POST['street'], $_POST['phone']]);
}
$list = $pdo->prepare("SELECT * FROM addresses WHERE user_id=?");
$list->execute([$_SESSION['user_id']]);
?>

<h2>My Addresses</h2>
<form method="POST">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
    <input name="label" placeholder="Home / Office" required><br><br>
    <input name="county" placeholder="County e.g Nairobi" required><br><br>
    <input name="town" placeholder="Town" required><br><br>
    <input name="street" placeholder="Street / Estate" required><br><br>
    <input name="phone" placeholder="Phone" required><br><br>
    <button>Save Address</button>
</form>
<h3>Saved:</h3>

<?php foreach($list as $a): ?>
<p><?= $a['label'] ?> - <?= $a['town'] ?>, <?= $a['county'] ?> - <?= $a['street'] ?></p>
<?php endforeach; ?>
<a href="profile.php">Back to Profile</a>
