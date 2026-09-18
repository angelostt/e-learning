<?php require 'session_check.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <title>Αρχική σελίδα</title>
</head>
<body>
<div class="container">
    <div class="container1">
        <h1 style="text-align: center">Αρχική σελίδα</h1>
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
            <p>Καλωσόρισμα και εισαγωγικό κείμενο που θα περιγράφει τους στόχους (π.χ ιστοχώρος για εκμάθηση HΤΜL) και τις επιμέρους ιστοσελίδες του site (δηλ. τι περιέχεται στις ιστοσελίδες: Ανακοινώσεις, Επικοινωνία, Έγραφα μαθήματος, Εργασίες).</p>
            <img src="indeximage.jpg" alt="studying">
        </div>
    </div>

</div>

</body>
</html>