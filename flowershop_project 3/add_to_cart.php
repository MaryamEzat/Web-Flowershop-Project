<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flowershop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO carts (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>