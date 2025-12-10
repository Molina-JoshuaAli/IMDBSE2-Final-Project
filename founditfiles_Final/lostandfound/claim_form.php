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
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Claim Lost Item</title>
    <link rel="stylesheet" href="styles/claim_form.css" />
</head>
<body>
    <header class="page-header">
        <img src="images/logo.jpg" alt="Logo" class="logo" />
        <h1>Lost and Found System</h1>
    </header>

    <nav class="main-nav">
        <a href="index.php" class="nav-link">Home</a>
        <a href="found_form.php" class="nav-link">Report Found Item</a>
        <a href="claim_form.php" class="nav-link active">Claim Lost Item</a>
        <a href="view_items.php" class="nav-link">View Found Items</a>
    </nav>

    <main class="container">
        <form method="post">
            <h2>Claim Lost Item</h2>

            <?php if ($message): ?>
                <div class="success"><?= $message ?></div>
            <?php endif; ?>

            <label>First Name:</label>
            <input type="text" name="firstname" placeholder="Your first name" required>

            <label>Last Name:</label>
            <input type="text" name="lastname" placeholder="Your last name" required>

            <label>Student ID:</label>
            <input type="text" name="student_id" placeholder="Your student ID" required>

            <label>Item ID:</label>
            <input type="number" name="item_id" placeholder="ID of the lost item" required>

            <label>Found ID:</label>
            <input type="number" name="found_id" placeholder="ID of the found record" required>

            <input type="submit" value="Claim Item" class="submit-btn">
        </form>
    </main>

    <footer>© 2025 Lost and Found System</footer>
</body>
</html>
