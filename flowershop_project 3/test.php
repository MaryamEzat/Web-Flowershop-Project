<?php
// Enable error display
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Leave empty if no password is set
$dbname = "flowershop";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

echo "Database connected successfully!";

// Test query
$query = "SELECT * FROM users";
$result = $conn->query($query);

if ($result) {
    echo "<pre>";
    print_r($result->fetch_all(MYSQLI_ASSOC));
    echo "</pre>";
} else {
    echo "Error in query: " . $conn->error;
}

$conn->close();
?>