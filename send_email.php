<?php
require 'session_check.php';
require 'config.php';

$from = $_POST['from'];
$subject = $_POST['subject'];
$body = $_POST['body'];

$res = mysqli_query($conn, "SELECT email FROM users WHERE role='tutor'");

$headers = "From: $from";

$count = 0;

while($row = mysqli_fetch_assoc($res)) {

    $to = $row['email'];

    mail($to, $subject, $body, $headers);

    $count++;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="communication.css">
    <title>Επικοινωνίες</title>
</head>
<body>
<div class="container">
    <div class="container1">
        <h1 style="text-align: center">Επικοινωνίες</h1>
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
            <p>Η συγκεκριμένη ιστοσελίδα θα περιέχει δύο δυνατότητες για την αποστολή e-mail στον καθηγητή:</p>
            <ul>
                <li>Μέσω web φόρμας</li>
                <li>Με χρήση e-mail διεύθυνσης</li>
            </ul>
            <div class="communication-container">
			
                <h2 class="header1">Αποστολή e-mail μέσω web φόρμας</h2>
                <div class="text-margin">
					<h3>Το μήνυμα στάλθηκε σε <?php echo $count ?> tutor(s)</h3>
					<a href="communication.php">Επιστροφή</a>
					<hr class="hr1">
                    
                </div>
            </div>
            <div class="communication-container">
                <h2 class="header1">Αποστολή e-mail με χρήση e-mail διεύθυνσης</h2>
                <div class="text-margin">
                    <p> Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου <a href="mailto: tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a> </p>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>