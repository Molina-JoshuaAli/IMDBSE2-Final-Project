<?php
require_once 'oop.php';
$laf = new LostAndFound();
$claimedItems = $laf->getAllClaimedItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Claimed Items - Lost and Found System</title>
    <link rel="stylesheet" href="styles/index.css" />
    <style>
        .claimed-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .claimed-table th {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: left;
        }
        
        .claimed-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        
        .claimed-table tr:hover {
            background-color: #f5f5f5;
        }
        
        .claimed-table tr:last-child td {
            border-bottom: none;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
            background: #f9f9f9;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .item-name {
            font-weight: bold;
            color: #333;
        }
        
        .back-link {
            display: inline-block;
            margin: 20px 0;
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .success-badge {
            background-color: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.9em;
            font-weight: bold;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        .stats-summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.1em;
        }
        
        .stats-summary strong {
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="page-header">
        <img src="images/logo.jpg" alt="Logo" class="logo" />
        <h1>Lost and Found System</h1>
    </header>

    <!-- Navigation -->
    <nav class="main-nav">
        <a href="index.php" class="nav-link">Home</a>
        <a href="found_form.php" class="nav-link">Report Found Item</a>
        <a href="claim_form.php" class="nav-link">Claim Lost Item</a>
        <a href="view_items.php" class="nav-link">View Found Items</a>
        <a href="claimed_items.php" class="nav-link active">View