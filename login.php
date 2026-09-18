<?php session_start(); ?>
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
			<td></td>
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

</html>