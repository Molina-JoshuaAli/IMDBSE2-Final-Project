<?php
require_once 'oop.php';
$laf = new LostAndFound();

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $dept = $_POST['department'];
    $student_id = $_POST['student_id'];
    $item = $_POST['item_name'];
    $desc = $_POST['description'];
    $room = $_POST['room_no'];

    $finder_id = $laf->addFinder($fname, $lname, $dept, $student_id);
    $item_id = $laf->addItem($item, $desc);
    $laf->addFound($item_id, $room, $finder_id);

    $message = "✅ Item reported successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Report Found Item</title>
    <link rel="stylesheet" href="styles/found_form.css" />
</head>
<body>
    <header class="page-header">
        <img src="images/logo.jpg" alt="Logo" class="logo" />
        <h1>Lost and Found System</h1>
    </header>

    <nav class="main-nav">
        <a href="index.php" class="nav-link">Home</a>
        <a href="found_form.php" class="nav-link active">Report Found Item</a>
        <a href="claim_form.php" class="nav-link">Claim Lost Item</a>
        <a href="view_items.php" class="nav-link">View Found Items</a>
    </nav>

    <main class="container">
        <form method="post">
            <h2>Report Found Item</h2>

            <?php if ($message): ?>
                <div class="success"><?= $message ?></div>
            <?php endif; ?>

            <label>First Name:</label>
            <input type="text" name="firstname" placeholder="Enter your first name" required>

            <label>Last Name:</label>
            <input type="text" name="lastname" placeholder="Enter your last name" required>

            <label>Department:</label>
            <input type="text" name="department" placeholder="Your department" required>

            <label>Student ID:</label>
            <input type="text" name="student_id" placeholder="Your student ID" required>

            <label>Item Name:</label>
            <input type="text" name="item_name" placeholder="Name of the item found" required>

            <label>Description:</label>
            <textarea name="description" placeholder="Brief description of the item" required></textarea>

            <label>Room Number Found:</label>
            <input type="number" name="room_no" placeholder="Room number where found" required>

            <input type="submit" value="Submit Found Item" class="submit-btn">
        </form>
    </main>

    <footer>© 2025 Lost and Found System</footer>
</body>
</html>
