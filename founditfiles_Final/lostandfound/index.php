<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lost and Found System</title>
    <link rel="stylesheet" href="styles/index.css" />
</head>
<body>
    <!-- Header -->
    <header class="page-header">
        <img src="images/logo.jpg" alt="Logo" class="logo" />
        <h1>Lost and Found System</h1>
    </header>

    <!-- Navigation -->
    <nav class="main-nav">
        <a href="index.php" class="nav-link active">Home</a>
        <a href="found_form.php" class="nav-link">Report Found Item</a>
        <a href="claim_form.php" class="nav-link">Claim Lost Item</a>
        <a href="view_items.php" class="nav-link">View Found Items</a>
    </nav>

    <!-- Main Content -->
    <main class="container">
        <h2>Welcome to the Lost and Found Portal</h2>
        <p>
            This system helps students report found items or claim lost ones.  
            Use the navigation links above to get started.
        </p>

        <section class="options">
            <a href="found_form.php" class="option-card">
                <h3>Report Found Item</h3>
                <p>Notify us about items you've found.</p>
            </a>
            <a href="claim_form.php" class="option-card">
                <h3>Claim Lost Item</h3>
                <p>Submit a claim for your lost belongings.</p>
            </a>
            <a href="view_items.php" class="option-card">
                <h3>View Found Items</h3>
                <p>Browse items that have been found.</p>
            </a>
            <a href="view_items.php" class="option-card">
                <h3>View Claimed Items</h3>
                <p>Browse items that have been found.</p>
            </a>
        </section>
    </main>

    <!-- Footer -->
    <footer>© 2025 Lost and Found System</footer>
</body>
</html>
