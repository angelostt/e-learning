<?php
require 'session_check.php';
require 'config.php';

if ($_SESSION['role'] != 'tutor') die("No access");

$id = $_GET['id'];

$res = mysqli_query($conn, "SELECT * FROM documents WHERE id=$id");
$doc = mysqli_fetch_assoc($res);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $desc = $_POST['description'];

    // αν ανέβηκε νέο αρχείο
    if (!empty($_FILES['file']['name'])) {

        $newname = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];

        move_uploaded_file($tmp, "uploads/".$newname);

        // σβήσε παλιό
        unlink("uploads/".$doc['filename']);

        $filename_sql = ", filename='$newname'";
    } else {
        $filename_sql = "";
    }

    mysqli_query($conn, "
        UPDATE documents
        SET title='$title',
            description='$desc'
            $filename_sql
        WHERE id=$id
    ");

    header("Location: documents.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="documents.css">
    <title>Έγγραφα</title>
</head>
<body>
<div class="container">
    <div class="container1">
        <h1 style="text-align: center">Επεξεργασία εγγράφου</h1>
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

			Τίτλος:
			<input name="title"
			value="<?php echo $doc['title']; ?>"><br><br>

			Περιγραφή:
			<textarea name="description"><?php echo $doc['description']; ?></textarea><br><br>

			Νέο αρχείο (προαιρετικό):
			<input type="file" name="file"><br>
			Τρέχον: <?php echo $doc['filename']; ?><br><br>

			<button>Αποθήκευση</button>

			</form>
			<br>
        </div>
    </div>

</div>

</body>
</html>