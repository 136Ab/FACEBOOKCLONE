<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$content = trim($_POST['content']);
$image_name = "";

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $image_name = time() . "_" . uniqid() . "." . strtolower($ext);
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image_name);
}

$stmt = $conn->prepare("INSERT INTO posts (user_id, content, image) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $content, $image_name);

if ($stmt->execute()) {
    echo "<script>alert('Post added successfully!'); window.location.href='home.php';</script>";
} else {
    echo "<script>alert('Error adding post!'); window.location.href='home.php';</script>";
}
?>
