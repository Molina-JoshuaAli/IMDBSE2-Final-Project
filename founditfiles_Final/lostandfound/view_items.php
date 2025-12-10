<?php
require_once 'oop.php';
$laf = new LostAndFound();
$items = $laf->getAllFoundItems();

// Handle delete action
if (isset($_GET['delete_id'])) {
    // You'll need to add a delete method to your LostAndFound class
    // For now, we'll redirect to a delete script
    header("Location: delete_item.php?id=" . $_GET['delete_id']);
    exit();
}

// Handle update action
if (isset($_GET['update_id'])) {
    header("Location: update_form.php?id=" . $_GET['update_id']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Found Items</title>
    <link rel="stylesheet" href="styles/view_items.css" />
    <style>
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-update {
            background-color: #4CAF50;
            color: white;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .no-items {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 18px;
        }
    </style>
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
        
        <?php if (empty($items)): ?>
            <div class="no-items">
                <p>No found items in the system yet.</p>
                <p><a href="found_form.php" style="color: #4CAF50; text-decoration: underline;">Report the first found item!</a></p>
            </div>
        <?php else: ?>
            <div class="options">
                <?php foreach ($items as $item): ?>
                    <div class="option-card">
                        <h3><?= htmlspecialchars($item['item_name']); ?> (ID: <?= $item['found_id']; ?>)</h3>
                        <p><strong>Description:</strong> <?= htmlspecialchars($item['description']); ?></p>
                        <p><strong>Room No:</strong> <?= htmlspecialchars($item['room_no']); ?></p>
                        <p><strong>Found At:</strong> <?= htmlspecialchars($item['found_at']); ?></p>
                        
                        <div class="action-buttons">
                            <a href="?update_id=<?= $item['found_id']; ?>" class="btn btn-update">Update</a>
                            <a href="?delete_id=<?= $item['found_id']; ?>" 
                               class="btn btn-delete" 
                               onclick="return confirm('Are you sure you want to delete this item? This action cannot be undone.');">
                               Delete
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer>© 2025 Lost and Found System</footer>
</body>
</html>