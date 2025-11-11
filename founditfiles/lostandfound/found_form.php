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

    // Save finder and item
    $finder_id = $laf->addFinder($fname, $lname, $dept, $student_id);
    $item_id = $laf->addItem($item, $desc);
    $laf->addFound($item_id, $room, $finder_id);

    $message = "✅ Item reported successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Found Item</title>
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
            <h2>Report Found Item</h2>

            <?php if ($message): ?>
                <div class="success"><?= $message ?></div>
            <?php endif; ?>

            <label>First Name:</label>
            <input type="text" name="firstname" required>

            <label>Last Name:</label>
            <input type="text" name="lastname" required>

            <label>Department:</label>
            <input type="text" name="department" required>

            <label>Student ID:</label>
            <input type="text" name="student_id" required>

            <label>Item Name:</label>
            <input type="text" name="item_name" required>

            <label>Description:</label>
            <textarea name="description" required></textarea>

            <label>Room Number Found:</label>
            <input type="number" name="room_no" required>

            <input type="submit" value="Submit Found Item">
        </form>
    </div>

    <footer>© 2025 Lost and Found System</footer>
</body>
</html>
