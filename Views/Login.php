<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/css/Login.css">
</head>
<body>
    <h1 class="page-title">Log In</h1>

    <div class="login-container">
        <!-- Display error message dynamically -->
        <div id="error-message" class="error-message">
            <?php
            if (isset($_GET['error'])) {
                echo htmlspecialchars($_GET['error']);
            }
            ?>
        </div>

        <!-- Login Form -->
        <form id="login-form" action="../Controllers/login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required oninput="clearErrorMessage()">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required oninput="clearErrorMessage()">

            <button type="submit" class="login-button">Log In</button>
            <p class="signup-link">Don't have an account? <a href="SignUp.php">Sign up</a></p>
        </form>
    </div>

    <script src="../Assets/js/Login.js" defer></script>
</body>
</html>
