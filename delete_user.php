<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

$id = $_GET['id'];

// μην σβήσει τον εαυτό του
if ($id == $_SESSION['user_id']) die("Δεν μπορείς να διαγράψεις τον εαυτό σου");

mysqli_query($conn, "DELETE FROM users WHERE id=$id");

header("Location: users.php");
exit();