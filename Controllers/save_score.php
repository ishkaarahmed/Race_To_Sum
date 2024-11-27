<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(["error" => "User not logged in."]);
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'race_to_sum');

// Check connection
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Handle score saving (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = isset($_POST['score']) ? (int)$_POST['score'] : null;

    if ($score === null || $score < 0) {
        echo json_encode(["error" => "Invalid score."]);
        exit;
    }

    $username = $_SESSION['username']; // Username from session

    // Insert the score into the leaderboard table
    $stmt = $conn->prepare("INSERT INTO leaderboard (username, score) VALUES (?, ?)");
    if (!$stmt) {
        echo json_encode(["error" => "Failed to prepare statement: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("si", $username, $score);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Score saved successfully."]);
    } else {
        echo json_encode(["error" => "Failed to save score: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    exit;
}

// Fetch leaderboard data (GET request)
if (isset($_GET['fetch_leaderboard']) && $_GET['fetch_leaderboard'] === "true") {
    $query = "SELECT username, score FROM leaderboard ORDER BY score DESC, created_at ASC LIMIT 10";
    $result = $conn->query($query);

    $leaderboardData = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $leaderboardData[] = $row;
        }
    }

    echo json_encode($leaderboardData);
    $conn->close();
    exit;
}

// Default response for unsupported requests
echo json_encode(["error" => "Invalid request."]);
$conn->close();
?>
