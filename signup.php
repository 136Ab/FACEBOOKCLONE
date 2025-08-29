<?php
require_once "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Email check
    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            echo "<script>alert('Signup successful! Redirecting...'); window.location='home.php';</script>";
        } else {
            echo "<script>alert('Error: Could not register.');</script>";
        }
        $stmt->close();
    }
    $check->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Signup - Facebook Clone</title>
<style>
body { font-family: Arial; background: linear-gradient(to right, #1877f2, #42b72a); color: white; text-align: center; padding: 50px; }
form { background: white; color: black; padding: 20px; border-radius: 10px; width: 300px; margin: auto; }
input { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
button { background: #1877f2; color: white; padding: 10px; border: none; border-radius: 5px; width: 100%; font-size: 16px; }
button:hover { background: #165fbe; }
</style>
</head>
<body>
<h2>Create an Account</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Sign Up</button>
</form>
<p>Already have an account? <a href="login.php" style="color: yellow;">Login here</a></p>
</body>
</html>
