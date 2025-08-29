<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "uyxjoy1oa0goc"; // Hosting ka username
$pass = "ufekrvzpkslt";  // Hosting ka password
$dbname = "dbkggpyjp87wfl"; // Hosting ka database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
