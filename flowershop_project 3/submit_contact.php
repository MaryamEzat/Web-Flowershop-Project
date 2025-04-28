<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Add MySQL password if necessary
$dbname = "flowershop";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log error and show user-friendly message
    error_log("Database connection failed: " . $conn->connect_error);
    die("We are experiencing technical difficulties. Please try again later.");
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($message)) {
        // Redirect with a validation error message
        header("Location: contact-us.php?message=" . urlencode("All fields are required."));
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirect with an invalid email message
        header("Location: contact-us.php?message=" . urlencode("Invalid email address."));
        exit();
    }

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Redirect with a success message
        header("Location: contact-us.php?message=" . urlencode("Your message has been sent successfully!") . "&status=success");
        exit();
    } else {
        // Log error and redirect with an error message
        error_log("Database insert error: " . $stmt->error);
        header("Location: contact-us.php?message=" . urlencode("An error occurred. Please try again.") . "&status=error");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>