<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

$id = $_GET['id'];

$res = mysqli_query($conn, "SELECT filename FROM documents WHERE id=$id");
$row = mysqli_fetch_assoc($res);

unlink("uploads/".$row['filename']);

mysqli_query($conn, "DELETE FROM documents WHERE id=$id");

header("Location: documents.php");
exit();