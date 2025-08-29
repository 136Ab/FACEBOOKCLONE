<?php
require_once "db.php";
session_start();

// Agar login nahi kiya to redirect
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location='login.php';</script>";
    exit;
}

// Post add karna
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['content'])) {
    $content = trim($_POST['content']);
    if (!empty($content)) {
        $stmt = $conn->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");
        $stmt->bind_param("is", $_SESSION['user_id'], $content);
        $stmt->execute();
        $stmt->close();
    }
}

// User info
$user_id = $_SESSION['user_id'];
$user_stmt = $conn->prepare("SELECT name FROM users WHERE id=?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_stmt->bind_result($username);
$user_stmt->fetch();
$user_stmt->close();

// Posts fetch
$posts = $conn->query("SELECT posts.content, posts.created_at, users.name 
                       FROM posts 
                       JOIN users ON posts.user_id = users.id 
                       ORDER BY posts.created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Home - Facebook Clone</title>
<style>
body { font-family: Arial; margin: 0; background: #f0f2f5; }
.navbar { background: #1877f2; padding: 10px; display: flex; justify-content: space-between; align-items: center; color: white; }
.navbar a { color: white; text-decoration: none; margin: 0 10px; font-weight: bold; }
.navbar a:hover { text-decoration: underline; }

.container { width: 60%; margin: 20px auto; }
.post-box { background: white; padding: 15px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; resize: none; }
button { background: #42b72a; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; }
button:hover { background: #36a420; }

.post { background: white; padding: 15px; border-radius: 10px; margin-bottom: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
.post h4 { margin: 0 0 5px; color: #1877f2; }
.post small { color: gray; }
</style>
</head>
<body>

<div class="navbar">
    <div>Facebook Clone</div>
    <div>
        <a href="home.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="messages.php">Messages</a>
        <a href="friends.php">Friends</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <div class="post-box">
        <h3>Welcome, <?php echo htmlspecialchars($username); ?> 👋</h3>
        <form method="POST">
            <textarea name="content" placeholder="What's on your mind?" rows="3" required></textarea>
            <button type="submit">Post</button>
        </form>
    </div>

    <?php while($row = $posts->fetch_assoc()) { ?>
        <div class="post">
            <h4><?php echo htmlspecialchars($row['name']); ?></h4>
            <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
            <small><?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?></small>
        </div>
    <?php } ?>
</div>

</body>
</html>
