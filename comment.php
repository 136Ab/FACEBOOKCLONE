<?php require_once "auth_guard.php"; require_once "helpers.php";
if($_SERVER['REQUEST_METHOD']!=='POST' || !csrf_check($_POST['csrf'] ?? "")) die("Bad request");
$pid=(int)($_POST['post_id'] ?? 0);
$text=trim($_POST['text'] ?? "");
if($text!==""){
  $i=$conn->prepare("INSERT INTO comments(user_id,post_id,text) VALUES(?,?,?)");
  $i->bind_param("iis", $_SESSION['user_id'], $pid, $text); $i->execute();
}
redirect_js("home.php");
