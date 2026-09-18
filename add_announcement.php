<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    mysqli_query($conn, "
        INSERT INTO announcements (date, subject, body)
        VALUES ('$date','$subject','$body')
    ");

    header("Location: announcements.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="announcements.css">
    <title>Ανακοινώσεις</title>
</head>
<body>
<div class="container">
    <div class="container1">
        <h1 style="text-align: center">Προσθήκη νέας ανακοίνωσης</h1>
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
			Ημερομηνία:
			<input type="date" name="date" ><br><br>

			Θέμα:
			<input type="text" name="subject"><br><br>

			Κείμενο:
			<textarea name="body"></textarea><br><br>

			<button type="submit">Αποθήκευση</button>
			</form>
        </div>
    </div>

</div>

</body>
</html>


