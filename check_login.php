<?php
session_start();
require 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['name'] = $user['firstname'];

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./login.css">
	<title>Πιστοποίηση</title>
</head>

<body>

<div class="container">
<div class="login-box">

    <form action="check_login.php" method="post">
		
		<table style="width:100%">
		  <tr>
			<td></td>
			<td class="style1">Λάθος στοιχεία login</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td class="style1" >Πιστοποίηση</td>
			<td></td>
		  </tr>
		  <tr>
			<td class="style2">Login:</td>
			<td class="style1"><input type="email" name="email" required></td>
			<td></td>
		  </tr>
		  <tr>
			<td class="style2">Password:</td>
			<td class="style1"><input type="password" name="password" required></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td class="style1"><button type="submit">Είσοδος</button></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		</table>
        
    </form>

</div>
</div>