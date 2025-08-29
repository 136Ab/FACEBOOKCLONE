<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Example messages fetch (adjust table name & columns as per DB)
$stmt = $conn->prepare("SELECT sender_id, message, created_at FROM messages WHERE receiver_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$messages = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
<title>Messages</title>
<style>
body { font-family: Arial, sans-serif; background: #f0f2f5; margin:0; }
.navbar { background: linear-gradient(90deg,#1877f2,#42a5f5); padding: 15px; color: white; display:flex; justify-content:space-between; }
.navbar a { color: white; text-decoration:none; margin-left:15px; font-weight:bold; }
.message-card { background:white; padding:10px; margin:10px auto; max-width:500px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
</style>
</head>
<body>

<div class="navbar">
    <div>Facebook Clone</div>
    <div>
        <a href="home.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="friends.php">Friends</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<?php while($msg = $messages->fetch_assoc()): ?>
<div class="message-card">
    <strong>From User <?php echo $msg['sender_id']; ?>:</strong>
    <p><?php echo htmlspecialchars($msg['message']); ?></p>
    <small><?php echo $msg['created_at']; ?></small>
</div>
<?php endwhile; ?>

</body>
</html>
