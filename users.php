<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

$res = mysqli_query($conn, "SELECT * FROM users ORDER BY id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="users.css">
    <title>Χρήστες</title>
</head>
<body>
<div class="container">
    <div class="container1">
        <h1 style="text-align: center">Χρήστες</h1>
		<p style="margin-left:1em;">Καλώς ήρθες <?php echo $_SESSION['name']; ?>
			<a href="logout.php">[Logout]</a>
		</p>
    </div>
    <div class="container2">
        <div class="container3">
            <button class="buttons-margin1" type="button" onclick="window.location.href='index.php';">Αρχική σελίδα</button>
            <button class="buttons-margin2" type="button" onclick="window.location.href='announcements.php';" id="b-announcements">Ανακοινώσεις</button>
            <button class="buttons-margin2" type="button" onclick="window.location.href='communication.php';" id="b-communications">Επικοινωνία</button>
            <button class="buttons-margin1" type="button" onclick="window.location.href='documents.php';" id="b-documents">Έγγραφα μαθήματος</button>
            <button class="buttons-margin2" type="button" onclick="window.location.href='assignments.php';" id="b-assignments">Εργασίες</button>
			<?php if ($_SESSION['role'] == 'tutor'): ?>
				<button class="buttons-margin3" type="button" onclick="window.location.href='users.php';" id="b-users">Χρήστες</button>
			<?php endif; ?>
        </div>
        <div class="container4">
            <br>
			<a href="add_user.php">Προσθήκη νέου χρήστη</a>
			<br><br>
			<div class="text-margin">
			<hr class="hr1">
			</div>
			<br>

			<table border="1" cellpadding="8">
			<tr>
			<th>ID</th>
			<th>Όνομα</th>
			<th>Email</th>
			<th>Ρόλος</th>
			<th>Ενέργειες</th>
			</tr>

			<?php while($u = mysqli_fetch_assoc($res)): ?>

				<tr>
				<td><?php echo $u['id']; ?></td>
				<td><?php echo $u['firstname']." ".$u['lastname']; ?></td>
				<td><?php echo $u['email']; ?></td>
				<td><?php echo $u['role']; ?></td>
				<td>
				<a href="delete_user.php?id=<?php echo $u['id']; ?>">[διαγραφή]</a>
				<a href="edit_user.php?id=<?php echo $u['id']; ?>">[επεξεργασία]</a>
				</td>
				</tr>

			<?php endwhile; ?>

			</table><br>
						
						
		</div>
	</div>

</div>

</body>
</html>