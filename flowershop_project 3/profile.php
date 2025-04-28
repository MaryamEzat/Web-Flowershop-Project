<?php
session_start();
require 'db_connect.php'; // Include the database connection

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle profile updates (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Sanitize input
    $full_name = $conn->real_escape_string(trim($_POST['full_name'] ?? ''));
    $phone_number = $conn->real_escape_string(trim($_POST['phone_number'] ?? ''));
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate inputs
    if (empty($full_name)) {
        echo json_encode(['success' => false, 'message' => 'Full name cannot be empty.']);
        exit();
    }

    if (empty($phone_number)) {
        echo json_encode(['success' => false, 'message' => 'Phone number cannot be empty.']);
        exit();
    }

    // Fetch current user details
    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Validate password changes
    if (!empty($current_password) && !password_verify($current_password, $user['password'])) {
        echo json_encode(['success' => false, 'message' => 'Current password is incorrect.']);
        exit();
    }

    if (!empty($new_password) && $new_password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'New passwords do not match.']);
        exit();
    }

    // Update user details
    $update_query = "UPDATE users SET full_name = ?, phone_number = ?";
    $update_params = [$full_name, $phone_number];
    $types = "ss";

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query .= ", password = ?";
        $update_params[] = $hashed_password;
        $types .= "s";
    }

    $update_query .= " WHERE id = ?";
    $update_params[] = $user_id;
    $types .= "i";

    $stmt = $conn->prepare($update_query);
    $stmt->bind_param($types, ...$update_params);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'An error occurred while updating the profile.']);
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Fetch user details (GET request)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');

    $query = "SELECT full_name, email, phone_number FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        echo json_encode($user);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'User details not found.']);
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Default response for unsupported methods
http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Method not allowed.']);