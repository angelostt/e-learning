<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

$id = $_GET['id'];

$res = mysqli_query($conn, "SELECT * FROM announcements WHERE id=$id");
$row = mysqli_fetch_assoc($res);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    mysqli_query($conn, "
        UPDATE announcements
        SET date='$date',
            subject='$subject',
            body='$body'
        WHERE id=$id
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
        <h1 style="text-align: center">Επεξεργασία ανακοίνωσης</h1>
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
			<input type="date" name="date"
			value="<?php echo $row['date']; ?>"><br><br>

			Θέμα:
			<input name="subject"
			value="<?php echo $row['subject']; ?>"><br><br>

			Κείμενο:
			<textarea name="body"><?php echo $row['body']; ?></textarea><br><br>

			<button>Αποθήκευση</button>

			</form>
			<br>
        </div>
    </div>

</div>

</body>
</html>

