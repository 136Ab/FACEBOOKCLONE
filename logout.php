<?php require_once "db.php"; require_once "helpers.php";
session_destroy();
echo "<script>alert('Logged out'); window.location.href='login.php';</script>";
