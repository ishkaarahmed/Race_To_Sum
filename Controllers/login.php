<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'race_to_sum');

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($email) || empty($password)) {
        header("Location: ../Views/Login.php?error=Please fill in all fields!");
        exit;
    }

    // Prepare SQL statement to check if the user exists
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User exists, now validate the password
        $stmt->bind_result($id, $username, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            // Set session variables and redirect to dashboard
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: ../Views/Dashboard.php");
            exit;
        } else {
            // Password is incorrect
            header("Location: ../Views/Login.php?error=Invalid password!");
            exit;
        }
    } else {
        // User not found
        header("Location: ../Views/Login.php?error=User not found!");
        exit;
    }

    $stmt->close();
}

$conn->close();
?>
