<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Leave empty if no password is set for MySQL
$dbname = "flowershop";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve POST data
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);

    // SQL query to insert data into the users table
    $sql = "INSERT INTO users (full_name, email, password, phone_number, address) 
            VALUES ('$full_name', '$email', '$password', '$phone', '$address')";

    // Execute query and check for success
    if ($conn->query($sql) === TRUE) {
        // Redirect to a "thank you" page or the sign-in page
        header("Location: sign-in.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>