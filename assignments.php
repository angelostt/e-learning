<?php
require 'session_check.php';
require 'config.php';

$result = mysqli_query($conn, "SELECT * FROM assignments ORDER BY id ASC");
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
        <h1 style="text-align: center">Εργασίες</h1>
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
			<?php if ($_SESSION['role'] == 'tutor'): ?>
				<a href="add_assignment.php">Προσθήκη νέας εργασίας</a>
				<div class="text-margin">
					<br><hr class="hr1">
				</div>
			<?php endif; ?>
			
			<?php while($row = mysqli_fetch_assoc($result)): ?>
			
            <div class="announcement-container">
                <h2 class="header1">Εργασία <?php echo $row['id']; ?> <?php if ($_SESSION['role']=='tutor'): ?>
					<a href="delete_assignment.php?id=<?php echo $row['id']; ?>">[διαγραφή]</a>
					<a href="edit_assignment.php?id=<?php echo $row['id']; ?>">[επεξεργασία]</a>
					<?php endif; ?></h2>
                <div class="text-margin">
                    <i><p> Στόχοι: Οι στόχοι τις εργασίας είναι</p></i>
						<p class="text-padding"><?php echo nl2br($row['goals']); ?></p>
                    <i><p> Εκφώνηση:</p></i>
                    <p class="text-padding">Κατεβάστε την εκφώνηση της εργασίας από <a href="uploads/assignments/<?php echo $row['description_file']; ?>" download>εδώ</a></p>
                    <i>Παραδοτέα:</i><br>
					<p class="text-padding"><?php echo nl2br($row['deliverables']); ?></p>
					
                    <p class="text-border"><i  class="text-color1">Ημερομηνία παράδοσης:</i> <?php echo date_format(date_create($row['due_date']),"d/m/y"); ?></p>
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