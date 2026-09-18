<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

$id = $_GET['id'];

$res = mysqli_query($conn, "SELECT description_file FROM assignments WHERE id=$id");
$row = mysqli_fetch_assoc($res);

unlink("uploads/assignments/".$row['description_file']);

mysqli_query($conn, "DELETE FROM assignments WHERE id=$id");

header("Location: assignments.php");
exit();