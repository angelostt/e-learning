<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

$id = $_GET['id'];

$res = mysqli_query($conn, "SELECT * FROM assignments WHERE id=$id");
$a = mysqli_fetch_assoc($res);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $goals = $_POST['goals'];
    $deliv = $_POST['deliverables'];
    $due = $_POST['due_date'];

    if (!empty($_FILES['file']['name'])) {

        $newfile = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];

        move_uploaded_file($tmp, "uploads/assignments/".$newfile);

        unlink("uploads/assignments/".$a['description_file']);

        $file_sql = ", description_file='$newfile'";
    } else {
        $file_sql = "";
    }

    mysqli_query($conn, "
        UPDATE assignments
        SET goals='$goals',
            deliverables='$deliv',
            due_date='$due'
            $file_sql
        WHERE id=$id
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
        <h1 style="text-align: center">Επεξεργασία εργασίας</h1>
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
            <form method="post" enctype="multipart/form-data">

			Στόχοι:
			<textarea name="goals"><?php echo $a['goals']; ?></textarea><br><br>

			Παραδοτέα:
			<textarea name="deliverables"><?php echo $a['deliverables']; ?></textarea><br><br>

			Ημερομηνία παράδοσης:
			<input type="date" name="due_date"
			value="<?php echo $a['due_date']; ?>"><br><br>

			Νέο αρχείο εκφώνησης:
			<input type="file" name="file"><br>
			Τρέχον: <?php echo $a['description_file']; ?><br><br>

			<button>Αποθήκευση</button>

			</form>
			<br>
        </div>
    </div>

</div>

</body>
</html>