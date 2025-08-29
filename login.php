<?php
require_once "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);

    if ($stmt->fetch()) {
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            echo "<script>alert('Login successful!'); window.location='home.php';</script>";
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('No account found with this email!');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - Facebook Clone</title>
<style>
body { font-family: Arial; background: linear-gradient(to right, #1877f2, #42b72a); color: white; text-align: center; padding: 50px; }
form { background: white; color: black; padding: 20px; border-radius: 10px; width: 300px; margin: auto; }
input { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
button { background: #42b72a; color: white; padding: 10px; border: none; border-radius: 5px; width: 100%; font-size: 16px; }
button:hover { background: #36a420; }
</style>
</head>
<body>
<h2>Login to Facebook Clone</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="signup.php" style="color: yellow;">Sign up here</a></p>
</body>
</html>
