<?php
session_start();
require 'db.php';

// User Login Check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get User Info
$stmt = $conn->prepare("SELECT name, email, profile_pic FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$user_name = $user['name'] ?? "User";
$profile_pic = $user['profile_pic'] ?? "default.png";
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo htmlspecialchars($user_name); ?> - Profile</title>
<style>
body { font-family: Arial, sans-serif; background: #f0f2f5; margin:0; }
.navbar { background: linear-gradient(90deg,#1877f2,#42a5f5); padding: 15px; color: white; display:flex; justify-content:space-between; }
.navbar a { color: white; text-decoration:none; margin-left:15px; font-weight:bold; }
.profile-card { max-width:500px; background:white; margin:30px auto; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:center; }
.profile-card img { width:120px; height:120px; border-radius:50%; object-fit:cover; }
</style>
</head>
<body>

<div class="navbar">
    <div>Facebook Clone</div>
    <div>
        <a href="home.php">Home</a>
        <a href="friends.php">Friends</a>
        <a href="messages.php">Messages</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="profile-card">
    <img src="uploads/<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture">
    <h2><?php echo htmlspecialchars($user_name); ?></h2>
    <p><?php echo htmlspecialchars($user['email'] ?? 'No Email'); ?></p>
</div>

</body>
</html>
