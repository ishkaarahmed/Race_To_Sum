<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Views/Login.php"); // Redirect to login if the user is not logged in
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Dashboard</title>
    <link rel="stylesheet" href="../Assets/css/Dashboard.css">
</head>
<body style="background: url('../Assets/images/imagei.jpg') no-repeat center center fixed; background-size: cover;">

    <!-- Display Logged-In Username -->
    <div class="user-info">
        <p>Let's Race to Sum, <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span> !</p>
    </div>

    <!-- Dashboard Content -->
    <div class="dashboard-container">
        <h1 class="dashboard-title">Race to Sum</h1>

        <a href="../Views/Play.php" class="dashboard-button start-game">Start Game</a>
        
        <a href="../Views/Leaderboard.php" class="dashboard-button leaderboard">View Leaderboard</a>

        <a href="../Views/settings.php" class="dashboard-button settings">Settings</a>
    </div>

<!-- Logout Button -->
<a href="javascript:void(0);" class="logout-button" onclick="confirmLogout()">
    <img src="../Assets/images/logout.png" alt="Log Out" class="logout-icon">
</a>

<!-- JavaScript for Logout Confirmation -->
<script>
    function confirmLogout() {
        const userConfirmed = confirm("Are you sure you want to logout?");
        if (userConfirmed) {
            // Redirect to logout.php to destroy session and log out
            window.location.href = "../Controllers/logout.php";
        }
    }
</script>

</body>
</html>
