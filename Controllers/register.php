<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'race_to_sum');

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    // Validate input fields
    if (empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: ../Views/SignUp.php");
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: ../Views/SignUp.php");
        exit;
    }

    // Validate password length
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters long.";
        header("Location: ../Views/SignUp.php");
        exit;
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../Views/SignUp.php");
        exit;
    }

    // Check if email is already registered
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $_SESSION['error'] = "Email already registered.";
        header("Location: ../Views/SignUp.php");
        exit;
    }

    $stmt->close();

    // Hash password and insert into the database
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $username, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Account created successfully! Please log in.";
        header("Location: ../Views/Login.php");
        exit;
    } else {
        $_SESSION['error'] = "Failed to create account. Try again.";
        header("Location: ../Views/SignUp.php");
        exit;
    }
}

$conn->close();
?>
