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
        <p>
            Let's Race to Sum, 
            <span class="username" onclick="toggleProfilePopup()">
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </span>!
        </p>
    </div>

    <!-- Dashboard Content -->
    <div class="dashboard-container">
        <h1 class="dashboard-title">Race to Sum</h1>

        <a href="../Views/Play.php" id="start-game-button" class="dashboard-button start-game">Start Game</a>
        
        <a href="../Views/Leaderboard.php" class="dashboard-button leaderboard">View Leaderboard</a>

        <a href="../Views/Settings.php" class="dashboard-button settings">Settings</a>
    </div>

    <!-- Logout Button -->
    <a href="javascript:void(0);" class="logout-button" onclick="confirmLogout()">
        <img src="../Assets/images/logout.png" alt="Log Out" class="logout-icon">
    </a>

    <div id="profile-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <!-- Quit Button -->
        <button class="popup-quit" onclick="toggleProfilePopup()">
            <img src="../Assets/images/quit.png" alt="Close" class="quit-icon">
        </button>
        <h2>Update Profile</h2>
        <div id="message"></div> <!-- Placeholder for success/error messages -->
        <form id="profile-form">
            <label for="old-password">Current Password</label>
            <input type="password" id="old-password" name="old_password" required placeholder="Enter current password">

            <label for="username">New Username</label>
            <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($_SESSION['username']); ?>">

            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required placeholder="Enter new password">

            <label for="confirm-password">Confirm New Password</label>
            <input type="password" id="confirm-password" name="confirm_password" required placeholder="Confirm new password">

            <button type="button" class="update-button" id="update-profile">Update Profile</button>
        </form>
    </div>
</div>
<audio id="dashboard-music" loop>
    <source src="../Assets/sounds/game_music.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<audio id="play-music" loop>
    <source src="../Assets/sounds/play_bg.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<script src="../Assets/js/GameSounds.js" defer></script>


<script src="../Assets/js/Dashboard.js"></script>
</body>
</html>
