<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Logged-in user menu
    echo '
        <li><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="about-us.html"><i class="fas fa-info-circle"></i> About Us</a></li>
        <li><a href="contact-us.html"><i class="fas fa-envelope"></i> Contact Us</a></li>
        <li><a href="profile.html"><i class="fas fa-user-edit"></i> Profile</a></li>
       <li><a href="cart.html"><i class="fas fa-shopping-cart"></i> Cart</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        ';
} else {
    // Guest menu
    echo '
        <li><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="about-us.html"><i class="fas fa-info-circle"></i> About Us</a></li>
        <li><a href="contact-us.html"><i class="fas fa-envelope"></i> Contact Us</a></li>
        <li><a href="sign-in.html"><i class="fas fa-sign-in-alt"></i> Sign In</a></li>
        <li><a href="sign-up.html"><i class="fas fa-user-plus"></i> Sign Up</a></li>
        <li><a href="cart.html"><i class="fas fa-shopping-cart"></i> Cart</a></li>
    ';
}
?>