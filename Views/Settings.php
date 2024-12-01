<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../Assets/css/Settings.css">
</head>
<body>
    <?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: Login.php"); // Redirect if not logged in
        exit;
    }
    ?>
    <h1 class="page-title">Settings</h1>
    <div class="settings-container">
    <div class="toggle-section">
    <label for="music-toggle" class="toggle-label">Music</label>
    <div class="toggle-switch">
        <input type="checkbox" id="music-toggle" class="toggle-input">
        <span class="slider"></span>
    </div>
</div>
<audio id="dashboard-music" loop>
    <source src="../Assets/sounds/game_music.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<script src="../Assets/js/GameSounds.js" defer></script>


        <!-- Back Button -->
        <a href="Dashboard.php" class="back-button">
            <img src="../Assets/images/back.png" alt="Back to Home" class="back-icon">
        </a>
    </div>

    <script src="../Assets/js/Settings.js" defer></script>
</body>
</html>
