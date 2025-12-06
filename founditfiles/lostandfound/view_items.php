<?php
require_once 'oop.php';
$laf = new LostAndFound();
$items = $laf->getAllFoundItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Found Items</title>
    <link rel="stylesheet" href="styles/view_items.css" />
</head>
<body>
    <header class="page-header">
        <img src="images/logo.jpg" alt="Logo" class="logo" />
        <h1>Lost and Found System</h1>
    </header>

    <nav class="main-nav">
        <a href="index.php" class="nav-link">Home</a>
        <a href="found_form.php" class="nav-link">Report Found Item</a>
        <a href="claim_form.php" class="nav-link">Claim Lost Item</a>
        <a href="view_items.php" class="nav-link active">View Found Items</a>
    </nav>

    <main class="container">
        <h2>List of Found Items</h2>
        <div class="options">
            <?php foreach ($items as $item): ?>
                <div class="option-card">
                    <h3><?= htmlspecialchars($item['item_name']); ?> (ID: <?= $item['found_id']; ?>)</h3>
                    <p><strong>Description:</strong> <?= htmlspecialchars($item['description']); ?></p>
                    <p><strong>Room No:</strong> <?= htmlspecialchars($item['room_no']); ?></p>
                    <p><strong>Found At:</strong> <?= htmlspecialchars($item['found_at']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>© 2025 Lost and Found System</footer>
</body>
</html>
