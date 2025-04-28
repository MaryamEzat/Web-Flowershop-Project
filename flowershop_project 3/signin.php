<?php
// Enable error reporting
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
    die(json_encode(["success" => false, "error" => "Database connection failed: " . $conn->connect_error]));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Debugging outputs
    error_log("Email received: $email");
    error_log("Password received: $password");

    if (empty($email) || empty($password)) {
        echo json_encode(["success" => false, "error" => "Email or password is missing."]);
        exit();
    }

    // Query to retrieve user by email
    $query = "SELECT id, password, full_name FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        error_log("Failed to prepare statement: " . $conn->error);
        echo json_encode(["success" => false, "error" => "Failed to prepare database query."]);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            echo json_encode(["success" => true, "message" => "Login successful!", "name" => $user['full_name']]);
        } else {
            error_log("Invalid password for email: $email");
            echo json_encode(["success" => false, "error" => "Invalid password."]);
        }
    } else {
        error_log("Email not found: $email");
        echo json_encode(["success" => false, "error" => "Email not found."]);
    }

    $stmt->close();
}

$conn->close();
?>