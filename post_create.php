<?php require_once "auth_guard.php"; require_once "helpers.php";
if($_SERVER['REQUEST_METHOD']!=='POST' || !csrf_check($_POST['csrf'] ?? "")) die("Bad request");
$content = trim($_POST['content'] ?? "");
$img = upload_image('image');
$st=$conn->prepare("INSERT INTO posts(user_id,content,image_path) VALUES(?,?,?)");
$st->bind_param("iss", $_SESSION['user_id'], $content, $img);
$st->execute();
redirect_js("home.php");
