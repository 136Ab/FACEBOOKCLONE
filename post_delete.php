<?php require_once "auth_guard.php"; require_once "helpers.php";
$id=(int)($_GET['id'] ?? 0);
if(!csrf_check($_GET['csrf'] ?? "")) die("Bad request");
$st=$conn->prepare("DELETE FROM posts WHERE id=? AND user_id=?");
$st->bind_param("ii",$id,$_SESSION['user_id']);
$st->execute();
redirect_js("home.php");
