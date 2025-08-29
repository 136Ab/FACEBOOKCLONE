<?php require_once "auth_guard.php"; require_once "helpers.php";
if($_SERVER['REQUEST_METHOD']!=='POST' || !csrf_check($_POST['csrf'] ?? "")) die("Bad request");
$pid=(int)($_POST['post_id'] ?? 0);
$check=$conn->prepare("SELECT id FROM likes WHERE user_id=? AND post_id=?");
$check->bind_param("ii", $_SESSION['user_id'], $pid); $check->execute(); $check->store_result();
if($check->num_rows>0){
  $d=$conn->prepare("DELETE FROM likes WHERE user_id=? AND post_id=?");
  $d->bind_param("ii", $_SESSION['user_id'], $pid); $d->execute();
}else{
  $i=$conn->prepare("INSERT INTO likes(user_id,post_id) VALUES(?,?)");
  $i->bind_param("ii", $_SESSION['user_id'], $pid); $i->execute();
}
redirect_js("home.php");
