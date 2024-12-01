<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../Assets/css/SignUp.css">
</head>
<body>
    <h1 class="page-title">Create Your Account</h1>

    <div class="signup-container">
        <!-- Display error or success messages -->
        <div id="message-container">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message" id="error-message">
                    <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                </div>
            <?php elseif (isset($_SESSION['success'])): ?>
                <div class="success-message" id="success-message">
                    <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
        </div>

        <form id="signup-form" action="../Controllers/register.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirmPassword" required>

            <button type="submit" class="signup-button">Sign Up</button>
            <p class="login-link">Already have an account? <a href="../Views/Login.php">Log in</a></p>
        </form>
    </div>

    <script src="../Assets/js/SignUp.js" defer></script>
</body>
</html>
