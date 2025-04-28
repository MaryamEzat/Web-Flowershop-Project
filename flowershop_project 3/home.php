<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Redirect to guest homepage if not logged in
    exit();
}

// Get user name from the session
$user_name = $_SESSION['user_name'];
$first_name = explode(' ', $user_name)[0]; // Extract the first name
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Flower Shop</title>
    <link rel="stylesheet" href="assets/styles/home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
         /* Page Layout */
         header, footer {
            text-align: center;
            padding: 10px 0;
            background-color: #f8b1c4;
            color: white;
        }

        main {
            flex: 1; /* Pushes the footer to the bottom */
            text-align: center;
            padding: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes full viewport height */
            background-color: #f9f9f9;
        }

        /* Categories */
        .category-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .category-link {
            background-color: #f0748b;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .category-link:hover {
            background-color: #e55466;
        }

        /* Animations */
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Welcome Section */
        .welcome-section {
            background-color: #f8b1c4; /* Match header color */
            color: white;
            text-align: center;
            padding: 20px 0; /* Add padding for spacing */
            margin-bottom: 20px;
        }

        .welcome-section h2 {
            margin: 0;
            font-size: 1.8rem; /* Adjust font size for visibility */
        }

        .welcome-section p {
            margin: 5px 0;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <!-- Header Navigation -->
    <header>
        <nav>
            <ul class="nav-menu">
                <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="about-us.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li><a href="contact-us.php"><i class="fas fa-envelope"></i> Contact Us</a></li>
                <li><a href="profile.html"><i class="fas fa-user-edit"></i> Profile</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Welcome Section -->
    <section class="welcome-section">
        <h2>Welcome, <?php echo htmlspecialchars($first_name); ?>!</h2>
        <p>We’re so glad to have you here!</p>
    </section>

    <!-- Main Content -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Welcome to Our Flower Shop</h1>
                <p>Discover the beauty of flowers and bring nature to your home!</p>
            </div>
        </section>

        <section class="categories">
            <h2>Explore Our Bouquets</h2>
            <div class="category-links">
                <a href="rose-bouquets.php" class="category-link">🌹 Rose Bouquets</a>
                <a href="tulip-bouquets.php" class="category-link">🌷 Tulip Bouquets</a>
                <a href="sunflower-bouquets.php" class="category-link">🌻 Sunflower Bouquets</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Flower Shop. All rights reserved.</p>
    </footer>
</body>
</html>