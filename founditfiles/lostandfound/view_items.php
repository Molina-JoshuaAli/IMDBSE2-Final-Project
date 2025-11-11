<?php
require_once 'oop.php';
$laf = new LostAndFound();
$items = $laf->getAllFoundItems();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Found Items</title>
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
        <h2>List of Found Items</h2>
        <table>
            <tr>
                <th>Found ID</th>
                <th>Item Name</th>
                <th>Description</th>
                <th>Room No</th>
                <th>Found At</th>
            </tr>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['found_id']; ?></td>
                <td><?= htmlspecialchars($item['item_name']); ?></td>
                <td><?= htmlspecialchars($item['description']); ?></td>
                <td><?= htmlspecialchars($item['room_no']); ?></td>
                <td><?= htmlspecialchars($item['found_at']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <footer>© 2025 Lost and Found System</footer>
</body>
</html>
