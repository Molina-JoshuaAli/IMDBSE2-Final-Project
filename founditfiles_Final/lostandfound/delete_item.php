<?php
require_once 'oop.php';
$laf = new LostAndFound();

if (isset($_GET['id'])) {
    $found_id = $_GET['id'];
    
    // Delete the item
    $success = $laf->deleteFoundItem($found_id);
    
    if ($success) {
        header("Location: view_items.php?deleted=true");
    } else {
        header("Location: view_items.php?error=delete_failed");
    }
} else {
    header("Location: view_items.php");
}
exit();