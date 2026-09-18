<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM announcements WHERE id=$id");

header("Location: announcements.php");
exit();