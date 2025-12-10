<?php
require_once 'oop.php';
$laf = new LostAndFound();

// Get item details if ID is provided
$item = null;
if (isset($_GET['id'])) {
    $item = $laf->getFoundItemById($_GET['id']);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $found_id = $_POST['found_id'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $room_no = $_POST['room_no'];
    
    $success = $laf->updateFoundItem($found_id, $item_name, $description, $room_no);
    
    if ($success) {
        header("Location: view_items.php?updated=true");
        exit();
    } else {
        $error = "Failed to update item. Please try again.";
    }
}

// If no item found, redirect
if (!$item && !isset($_POST['update'])) {
    header("Location: view_items.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-back {
            background-color: #666;
            margin-left: 10px;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Found Item</h1>
        
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <input type="hidden" name="found_id" value="<?= htmlspecialchars($item['found_id']); ?>">
            
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" id="item_name" name="item_name" 
                       value="<?= htmlspecialchars($item['item_name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?= 
                    htmlspecialchars($item['description']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="room_no">Room Number:</label>
                <input type="text" id="room_no" name="room_no" 
                       value="<?= htmlspecialchars($item['room_no']); ?>">
            </div>
            
            <button type="submit" name="update" class="btn">Update Item</button>
            <a href="view_items.php" class="btn btn-back">Cancel</a>
        </form>
    </div>
</body>
</html>