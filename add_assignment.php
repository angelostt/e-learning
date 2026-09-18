<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $goals = $_POST['goals'];
    $deliverables = $_POST['deliverables'];
    $due = $_POST['due_date'];

    $fname = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];

    move_uploaded_file($tmp, "uploads/assignments/".$fname);

    // insert assignment
    mysqli_query($conn, "
        INSERT INTO assignments (goals, description_file, deliverables, due_date)
        VALUES ('$goals','$fname','$deliverables','$due')
    ");

    $aid = mysqli_insert_id($conn);

    $today = date("Y-m-d");

    $subject = "Ανένηκε η εργασία $aid";
	
	$ddue = date_format(date_create($due),"d/m/y");
    $body = "Η ημερομηνία παράδοσης είναι $ddue";

    mysqli_query($conn, "
        INSERT INTO announcements (date, subject, body)
        VALUES ('$today','$subject','$body')
    ");

    header("Location: assignments.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assignments.css">
    <title>Εργασίες</title>
</head>
<body>
<div class="container">
    <div class="container1">
        <h1 style="text-align: center">Προσθήκη νέας εργασίας</h1>
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
            <form method="post" enctype="multipart/form-data">
			<br>
			Στόχοι:
			<textarea name="goals"></textarea><br><br>

			Παραδοτέα:
			<textarea name="deliverables"></textarea><br><br>

			Ημερομηνία παράδοσης:
			<input type="date" name="due_date"><br><br>

			Εκφώνηση (αρχείο):
			<input type="file" name="file"><br><br>

			<button type="submit">Αποθήκευση</button>

			</form>
			<br>
        </div>
    </div>

</div>

</body>
</html>