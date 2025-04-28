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
    <title>Sunflower Bouquets - Flower Shop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* General Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        main {
            flex: 1;
        }

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
            <h1>Sunflower Bouquets</h1>
            <p class="quote">"Sunflowers bring warmth and joy!"</p>

            <div class="bouquet-list">
                <div class="bouquet">
                    <img src="assets/images/sunflower20.jpg" alt="20 Sunflowers">
                    <div class="bouquet-info">
                        <h3>20 Sunflowers</h3>
                        <p class="description">A vibrant bouquet of 20 sunflowers, perfect for brightening up your space.</p>
                        <p class="price">Starting from $25.00</p>
                        <button class="add-to-cart" onclick="addToCart('20 Sunflowers', 25.00, 1)">Add to Cart</button>
                    </div>
                </div>
                <div class="bouquet">
                    <img src="assets/images/sunflower50.jpg" alt="50 Sunflowers">
                    <div class="bouquet-info">
                        <h3>50 Sunflowers</h3>
                        <p class="description">A stunning bouquet of 50 sunflowers, guaranteed to bring a smile.</p>
                        <p class="price">Starting from $60.00</p>
                        <button class="add-to-cart" onclick="addToCart('50 Sunflowers', 60.00, 2)">Add to Cart</button>
                    </div>
                </div>
                <div class="bouquet">
                    <img src="assets/images/sunflower100.jpg" alt="100 Sunflowers">
                    <div class="bouquet-info">
                        <h3>100 Sunflowers</h3>
                        <p class="description">A grand bouquet of 100 sunflowers to make any occasion extraordinary.</p>
                        <p class="price">Starting from $120.00</p>
                        <button class="add-to-cart" onclick="addToCart('100 Sunflowers', 120.00, 3)">Add to Cart</button>
                    </div>
                </div>
                <div class="bouquet">
                    <img src="assets/images/sunflower10.jpg" alt="10 Sunflowers">
                    <div class="bouquet-info">
                        <h3>10 Sunflowers</h3>
                        <p class="description">A cheerful bouquet of 10 sunflowers, perfect for small gifts.</p>
                        <p class="price">Starting from $15.00</p>
                        <button class="add-to-cart" onclick="addToCart('10 Sunflowers', 15.00, 4)">Add to Cart</button>
                    </div>
                </div>
                <div class="bouquet">
                    <img src="assets/images/sunflower30.jpg" alt="30 Sunflowers">
                    <div class="bouquet-info">
                        <h3>30 Sunflowers</h3>
                        <p class="description">A beautiful bouquet of 30 sunflowers. Great for celebrations.</p>
                        <p class="price">Starting from $40.00</p>
                        <button class="add-to-cart" onclick="addToCart('30 Sunflowers', 40.00, 5)">Add to Cart</button>
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