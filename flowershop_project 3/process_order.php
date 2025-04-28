<?php
// Start session
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Leave empty if no password is set for MySQL
$dbname = "flowershop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $country = $conn->real_escape_string($_POST['country']);
    $notes = $conn->real_escape_string($_POST['notes']);

    // SQL query to insert order into 'orders' table
    $sql = "INSERT INTO orders (name, email, phone, address, country, notes) 
            VALUES ('$name', '$email', '$phone', '$address', '$country', '$notes')";

    // Execute query and check for success
    if ($conn->query($sql) === TRUE) {
        // Redirect to checkout page with success message
        header("Location: checkout.php?message=" . urlencode("Your order has been successfully placed!"));
        exit();
    } else {
        // Redirect with error message if query fails
        header("Location: checkout.php?message=" . urlencode("Failed to place your order. Please try again."));
        exit();
    }
}

// Close the database connection
$conn->close();
?>