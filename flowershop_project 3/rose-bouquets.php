<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : null; // Retrieve the user's name if logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rose Bouquets - Flower Shop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* General Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        /* Flex Layout to keep footer at the bottom */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        main {
            flex: 1; /* Allows the main content to expand and footer to stick */
        }

        /* Scoped Header Styling */
        header {
            background: linear-gradient(to bottom, #f0748b, #f8b1c4);
            padding: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #f0748b;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #e55466;
            transform: scale(1.1);
        }

        /* Flower Category Section */
        .flower-category {
            text-align: center;
            padding: 30px 20px;
        }

        .flower-category h1 {
            font-size: 3rem;
            color: #f0748b;
            margin-bottom: 10px;
        }

        .quote {
            font-size: 1.4rem;
            color: #555;
            margin-bottom: 30px;
            font-style: italic;
        }

        .bouquet-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .bouquet {
            background-color: #fff;
            border: 2px solid #f0748b;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .bouquet:hover { transform: scale(1.05); }
        .bouquet img { width: 100%; height: auto; }
        .bouquet-info {
            padding: 15px;
        }
        .bouquet-info h3 {
            color: #f0748b;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .description {
            color: #555;
            font-size: 1rem;
            margin-bottom: 10px;
        }
        .price {
            font-weight: bold;
            color: #e55466;
            margin-bottom: 10px;
        }
        .add-to-cart {
            background-color: #f0748b;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .add-to-cart:hover {
            background-color: #e55466;
            transform: scale(1.1);
        }

        /* Footer Styling */
        footer {
            background-color: #f8b1c4;
            text-align: center;
            padding: 10px 0;
            color: white;
            font-size: 1rem;
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
        <section class="flower-category">
            <h1>Rose Bouquets</h1>
            <p class="quote">"Make your day special, flowers bring happiness!"</p>

            <div class="bouquet-list">
                <div class="bouquet">
                    <img src="assets/images/20roses.jpg" alt="20 Roses">
                    <div class="bouquet-info">
                        <h3>20 Roses</h3>
                        <p class="description">A charming bouquet of 20 fresh roses. Perfect for a romantic gesture.</p>
                        <p class="price">Starting from $20.00</p>
                        <button class="add-to-cart" onclick="addToCart('20 Roses', 20.00, 1)">Add to Cart</button>
                    </div>
                </div>
                <div class="bouquet">
                    <img src="assets/images/50roses.jpg" alt="50 Roses">
                    <div class="bouquet-info">
                        <h3>50 Roses</h3>
                        <p class="description">A luxurious bouquet of 50 roses for a grand occasion.</p>
                        <p class="price">Starting from $50.00</p>
                        <button class="add-to-cart" onclick="addToCart('50 Roses', 50.00, 2)">Add to Cart</button>
                    </div>
                </div>
                <div class="bouquet">
                    <img src="assets/images/100roses.jpg" alt="100 Roses">
                    <div class="bouquet-info">
                        <h3>100 Roses</h3>
                        <p class="description">A grand bouquet of 100 roses to make an unforgettable impression.</p>
                        <p class="price">Starting from $100.00</p>
                        <button class="add-to-cart" onclick="addToCart('100 Roses', 100.00, 3)">Add to Cart</button>
                    </div>
                </div>
                <div class="bouquet">
                    <img src="assets/images/10roses.jpg" alt="10 Roses">
                    <div class="bouquet-info">
                        <h3>10 Roses</h3>
                        <p class="description">A sweet and simple bouquet of 10 roses. Great for small gifts.</p>
                        <p class="price">Starting from $15.00</p>
                        <button class="add-to-cart" onclick="addToCart('10 Roses', 15.00, 4)">Add to Cart</button>
                    </div>
                </div>
                <div class="bouquet">
                    <img src="assets/images/30oses.jpg" alt="30 Roses">
                    <div class="bouquet-info">
                        <h3>30 Roses</h3>
                        <p class="description">A stunning bouquet of 30 roses. Perfect for celebrating love and friendship.</p>
                        <p class="price">Starting from $35.00</p>
                        <button class="add-to-cart" onclick="addToCart('30 Roses', 35.00, 5)">Add to Cart</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Flower Shop. All rights reserved.</p>
    </footer>

    <script>
        function addToCart(name, price, id) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            alert(`${name} added to cart!`);
        }
    </script>
</body>
</html>