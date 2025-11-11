<?php
require_once 'oop.php';
$laf = new LostAndFound();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $student_id = $_POST['student_id'];
    $item_id = $_POST['item_id'];
    $found_id = $_POST['found_id'];

    $claimer_id = $laf->addClaimer($fname, $lname, $student_id);
    $laf->addClaim($claimer_id, $item_id, $found_id);

    $message = "✅ Claim submitted successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Claim Lost Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lost and Found System</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="found_form.php">Report Found Item</a>
        <a href="claim_form.php">Claim Lost Item</a>
        <a href="view_items.php">View Found Items</a>
    </nav>

    <div class="container">
        <form method="post">
            <h2>Claim Lost Item</h2>

            <?php if ($message): ?>
                <div class="success"><?= $message ?></div>
            <?php endif; ?>

            <label>First Name:</label>
            <input type="text" name="firstname" required>

            <label>Last Name:</label>
            <input type="text" name="lastname" required>

            <label>Student ID:</label>
            <input type="text" name="student_id" required>

            <label>Item ID:</label>
            <input type="number" name="item_id" required>

            <label>Found ID:</label>
            <input type="number" name="found_id" required>

            <input type="submit" value="Claim Item">
        </form>
    </div>

    <footer>© 2025 Lost and Found System</footer>
</body>
</html>
