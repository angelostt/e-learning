<?php
require 'session_check.php';
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
					<form method="post" action="send_email.php">

					<b>Αποστολέας:</b>
					<input type="email" name="from" value="<πεδίο για την δν/ση του αποστολέα>" size="28" required><br><br>

					<b>Θέμα:</b>
					<input type="text" name="subject" value="<πεδίο για το θέμα>" size="13" required><br><br>

					<b>Κείμενο:</b>
					<textarea type="text" name="body" value="<πεδίο για το κείμενο>" rows="1" cols="22"><πεδίο για το κείμενο></textarea><br><br>

					<button type="submit">Αποστολή</button>

					</form>
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