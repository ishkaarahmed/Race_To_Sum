<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'race_to_sum');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $oldPassword = trim($_POST['old_password']);
    $newUsername = trim($_POST['username']);
    $newPassword = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Validate fields
    if (empty($oldPassword) || empty($newUsername) || empty($newPassword) || empty($confirmPassword)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Validate new passwords match
    if ($newPassword !== $confirmPassword) {
        echo json_encode(['success' => false, 'message' => 'New passwords do not match.']);
        exit;
    }

    // Fetch current password from DB
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($currentPasswordHash);
    $stmt->fetch();
    $stmt->close();

    // Verify old password
    if (!password_verify($oldPassword, $currentPasswordHash)) {
        echo json_encode(['success' => false, 'message' => 'Current password is incorrect.']);
        exit;
    }

    // Update user data in the database
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $newUsername, $hashedNewPassword, $userId);

    if ($stmt->execute()) {
        $_SESSION['username'] = $newUsername; // Update session with the new username
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update profile. Please try again.']);
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>
