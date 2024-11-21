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
    <title>Leaderboard</title>
    <link rel="stylesheet" href="../Assets/css/Leaderboard.css">
</head>
<body>
    <h1 class="page-title">Leaderboard</h1>
    <div class="leaderboard-container">
        <a href="../Views/Dashboard.php" class="back-button">
            <img src="../Assets/images/back.png" alt="Back to Home" class="back-icon">
        </a>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Player Name</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" style="text-align:center;">No data available yet.</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
