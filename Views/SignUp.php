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
        <form id="signup-form" action="../Controllers/register.php" method="POST" onsubmit="return validateForm()">
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

    <script src="../Assets/js/SignUp.js"></script>
</body>
</html>
