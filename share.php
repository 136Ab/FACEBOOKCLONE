<?php require_once "auth_guard.php"; require_once "helpers.php";
if($_SERVER['REQUEST_METHOD']!=='POST' || !csrf_check($_POST['csrf'] ?? "")) die("Bad request");
$pid=(int)($_POST['post_id'] ?? 0);
$i=$conn->prepare("INSERT INTO shares(user_id,post_id) VALUES(?,?)");
$i->bind_param("ii", $_SESSION['user_id'], $pid); $i->execute();
redirect_js("home.php");
