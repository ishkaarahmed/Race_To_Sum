<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "User not logged in."]);
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'race_to_sum');

// Check for database connection errors
if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch the latest score for the logged-in user
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

if (!$username) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Username not found in session."]);
    exit;
}

$sql = "SELECT score FROM leaderboard WHERE username = ? ORDER BY created_at DESC LIMIT 1";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Database query preparation failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($score);
$stmt->fetch();
$stmt->close();
$conn->close();

// Return the score or default to 0 if no score is found
$score = $score ?? 0; 
header('Content-Type: application/json');
echo json_encode(['score' => $score]);
exit;
