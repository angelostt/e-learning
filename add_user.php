<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fn = $_POST['firstname'];
    $ln = $_POST['lastname'];
    $em = $_POST['email'];
    $pw = $_POST['password'];
    $role = $_POST['role'];

    mysqli_query($conn, "
        INSERT INTO users (firstname, lastname, email, password, role)
        VALUES ('$fn','$ln','$em','$pw','$role')
    ");

    header("Location: users.php");
    exit();
}
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
        <h1 style="text-align: center">Προσθήκη χρήστη</h1>
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
            <form method="post">

			Όνομα:
			<input name="firstname" required><br><br>

			Επώνυμο:
			<input name="lastname" required><br><br>

			Email (login):
			<input name="email" type="email" required><br><br>

			Password:
			<input name="password" required><br><br>

			Ρόλος:
			<select name="role">
			<option value="student">Student</option>
			<option value="tutor">Tutor</option>
			</select><br><br>

			<button>Αποθήκευση</button>

			</form>
			<br>
        </div>
    </div>

</div>

</body>
</html>