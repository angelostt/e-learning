<?php
require 'session_check.php';
require 'config.php';

$result = mysqli_query($conn, "SELECT * FROM announcements ORDER BY id ASC");
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
        <h1 style="text-align: center">Ανακοικνώσεις</h1>
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
			<div class="announcement-container">
				<br>
				<?php if ($_SESSION['role'] == 'tutor'): ?>
					<a href="add_announcement.php">Προσθήκη νέας ανακοίνωσης</a>
					<div class="text-margin">
						<br><hr class="hr1">
					</div>
				<?php endif; ?>
			</div>
			
			<?php $count = 0 ?>
			<?php while($row = mysqli_fetch_assoc($result)): ?>
			<?php $count++ ?>
            <div class="announcement-container">
                <h2 class="header1">Ανακοίνωση <?php echo $count ?>
				<?php if ($_SESSION['role'] == 'tutor'): ?>
					<a href="delete_announcement.php?id=<?php echo $row['id']; ?>">[διαγραφή]</a>
					<a href="edit_announcement.php?id=<?php echo $row['id']; ?>">[επεξεργασία]</a>
				<?php endif; ?>
				</h2>
                <div class="text-margin">
                    <p> <b>Ημερομηνία:</b> <?php echo date_format(date_create($row['date']),"d/m/y"); ?></p>
                    <p> <b>Θέμα:</b> <?php echo $row['subject']; ?></p>
                    <p class="text-border"> <?php echo nl2br($row['body']); ?></p>
                </div>
            </div>
			
			<?php endwhile; ?>

            <div class="top-button">
                <a href="#">top</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>