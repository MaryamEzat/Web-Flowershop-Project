<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Flower Shop</title>
    <link rel="stylesheet" href="assets/styles/home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f9f9f9;
        }

        main {
            flex: 1;
        }

        header, footer {
            text-align: center;
            padding: 10px 0;
            background-color: #f8b1c4;
            color: white;
        }

        footer {
            background-color: #f8b1c4;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .page-content {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #f0748b;
            margin-bottom: 20px;
        }

        .about-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .about-item {
            flex: 1 1 300px;
            margin: 10px;
            padding: 20px;
            border-left: 3px solid #f0748b;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }

        .about-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .about-item h3 {
            color: #f0748b;
            font-size: 1.2rem;
        }

        .about-item i {
            color: #f0748b;
            margin-right: 10px;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?php echo $is_logged_in ? 'home.php' : 'index.html'; ?>"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="about-us.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li><a href="contact-us.php"><i class="fas fa-envelope"></i> Contact Us</a></li>
                <?php if ($is_logged_in): ?>
                    <li><a href="profile.html"><i class="fas fa-user-edit"></i> Profile</a></li>
                    <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php else: ?>
                    <li><a href="sign-in.html"><i class="fas fa-sign-in-alt"></i> Sign In</a></li>
                    <li><a href="sign-up.html"><i class="fas fa-user-plus"></i> Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="page-content">
            <h2>About Us</h2>
            <p>Welcome to <b>Flower Shop</b>, your go-to destination for fresh, beautiful, and diverse floral arrangements. Whether you're celebrating a special occasion or simply brightening up your day, we're here to help you bring nature's beauty into your life.</p>

            <div class="about-section">
                <div class="about-item">
                    <i class="fas fa-seedling"></i>
                    <h3>Our Mission</h3>
                    <p>Our mission is to provide high-quality, fresh flowers for every occasion. Whether you're celebrating a wedding, a birthday, or gifting someone special, we offer a range of stunning arrangements to suit every need.</p>
                </div>
                <div class="about-item">
                    <i class="fas fa-hand-holding-heart"></i>
                    <h3>Our Values</h3>
                    <ul>
                        <li><strong>Freshness:</strong> We deliver only the freshest flowers, sourced directly from the best farms.</li>
                        <li><strong>Quality:</strong> Our florists are experienced and passionate about creating lasting beauty.</li>
                        <li><strong>Customer Focus:</strong> We prioritize our customers' satisfaction, offering personalized service every time.</li>
                    </ul>
                </div>
                <div class="about-item">
                    <i class="fas fa-gift"></i>
                    <h3>Our Services</h3>
                    <p>We offer a range of services to help you with all your floral needs:</p>
                    <ul>
                        <li>Custom floral arrangements for events</li>
                        <li>Subscription-based flower delivery</li>
                        <li>Specialized floral gifts for all occasions</li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Flower Shop. All rights reserved.</p>
    </footer>
</body>
</html>