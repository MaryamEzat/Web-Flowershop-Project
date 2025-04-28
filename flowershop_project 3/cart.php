<?php
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_id']); // Ensure this variable is explicitly defined

if (!$is_logged_in) {
    header("Location: sign-in.html"); // Redirect to the login page if not logged in
    exit();
}

// Get user name from the session for personalization
$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Flower Shop</title>
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
        header, footer {
            text-align: center;
            padding: 10px 0;
            background-color: #f8b1c4;
            color: white;
        }
        main {
            flex: 1;
        }
        .cart-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #f0748b;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .cart-item h3 {
            margin: 0;
            flex: 1;
        }
        .cart-item div {
            display: flex;
            align-items: center;
        }
        .quantity {
            width: 50px;
            text-align: center;
            margin: 0 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
            color: #f0748b;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #f0748b;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #e55466;
        }
        footer {
            background-color: #f8b1c4;
            color: white;
            text-align: center;
            padding: 10px;
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
    <div class="cart-container">
        <h2>Your Cart</h2>
        <div id="cart-items">
            <!-- Cart items will be dynamically added here -->
        </div>
        <p class="total">Total: $<span id="total-price">0.00</span></p>
        <button class="btn" id="checkout-btn">Proceed to Checkout</button>
    </div>
</main>

<footer>
    <p>&copy; 2024 Flower Shop. All rights reserved.</p>
</footer>

<script>
    function renderCart() {
        const cartItemsContainer = document.getElementById('cart-items');
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        let total = 0;

        cartItemsContainer.innerHTML = ""; // Clear current items

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
            document.getElementById('total-price').textContent = '0.00'; // Set total to 0 if cart is empty
        } else {
            cart.forEach((item, index) => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <h3>${item.name}</h3>
                    <div>
                        <button onclick="changeQuantity(${index}, -1)">-</button>
                        <input type="number" class="quantity" value="${item.quantity}" readonly>
                        <button onclick="changeQuantity(${index}, 1)">+</button>
                        <span>$${(item.price * item.quantity).toFixed(2)}</span>
                    </div>
                `;
                cartItemsContainer.appendChild(cartItem);
                total += item.price * item.quantity;
            });
            document.getElementById('total-price').textContent = total.toFixed(2);
        }
    }

    function changeQuantity(index, delta) {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart[index]) {
            cart[index].quantity += delta;

            if (cart[index].quantity < 1) {
                cart.splice(index, 1); // Remove item from cart if quantity is zero
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
        }
    }

    document.getElementById('checkout-btn').addEventListener('click', function() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart.length > 0) {
            window.location.href = 'checkout.php'; // Redirect to checkout page
        } else {
            alert('Your cart is empty. Please add some items before checking out.');
        }
    });

    document.addEventListener('DOMContentLoaded', renderCart);
</script>
</body>
</html>