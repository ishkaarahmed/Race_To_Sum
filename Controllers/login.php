<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'race_to_sum');

// Check connection
if ($conn->connect_error) {
    // Redirect back with a connection error message
    header("Location: ../Views/Login.php?error=Database connection failed.");
    exit;
}

// Process the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim input values
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($email) || empty($password)) {
        header("Location: ../Views/Login.php?error=Please fill in all fields.");
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../Views/Login.php?error=Invalid email format.");
        exit;
    }

    // Prepare SQL statement to check if the user exists
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    if (!$stmt) {
        header("Location: ../Views/Login.php?error=Database error: Unable to prepare statement.");
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        // User exists, fetch details
        $stmt->bind_result($id, $username, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            // Redirect to the dashboard
            header("Location: ../Views/Dashboard.php?success=Welcome, $username!");
            exit;
        } else {
            // Incorrect password
            header("Location: ../Views/Login.php?error=Invalid password.");
            exit;
        }
    } else {
        // User not found
        header("Location: ../Views/Login.php?error=User not found.");
        exit;
    }

    // Close statement
    $stmt->close();
} else {
    // Invalid request method
    header("Location: ../Views/Login.php?error=Invalid request method.");
    exit;
}

// Close the database connection
$conn->close();
?>
