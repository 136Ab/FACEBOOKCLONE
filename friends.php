<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id, name, profile_pic FROM users WHERE id != ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$friends = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
<title>Friends</title>
<style>
body { font-family: Arial, sans-serif; background: #f0f2f5; margin:0; }
.navbar { background: linear-gradient(90deg,#1877f2,#42a5f5); padding: 15px; color: white; display:flex; justify-content:space-between; }
.navbar a { color: white; text-decoration:none; margin-left:15px; font-weight:bold; }
.friend-card { display:flex; align-items:center; background:white; padding:10px; margin:10px auto; max-width:500px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
.friend-card img { width:50px; height:50px; border-radius:50%; margin-right:10px; object-fit:cover; }
</style>
</head>
<body>

<div class="navbar">
    <div>Facebook Clone</div>
    <div>
        <a href="home.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="messages.php">Messages</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<?php while($row = $friends->fetch_assoc()): ?>
<div class="friend-card">
    <img src="uploads/<?php echo htmlspecialchars($row['profile_pic'] ?? 'default.png'); ?>">
    <div><?php echo htmlspecialchars($row['name']); ?></div>
</div>
<?php endwhile; ?>

</body>
</html>
