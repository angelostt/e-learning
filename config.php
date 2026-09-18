<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "3392partBdb";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("DB connection failed");
}
?>