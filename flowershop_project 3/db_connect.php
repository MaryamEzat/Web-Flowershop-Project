<?php
// Database credentials
$servername = "localhost"; // Change if your database is hosted elsewhere
$username = "root"; // Your database username
$password = ""; // Your database password (leave blank if none)
$dbname = "flowershop"; // The name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    // Log the error for debugging and display a generic error message to the user
    error_log("Database connection failed: " . $conn->connect_error);
    die("Connection to the database failed. Please try again later.");
}

// Set the character set to UTF-8 for compatibility
if (!$conn->set_charset("utf8")) {
    error_log("Error loading character set utf8: " . $conn->error);
    die("Error setting up database connection. Please try again later.");
}
?>