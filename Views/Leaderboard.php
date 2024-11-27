<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="../Assets/css/Leaderboard.css">
</head>
<body>
    <?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: Login.php"); // Redirect if not logged in
        exit;
    }
    ?>
    <h1 class="page-title">Leaderboard</h1>
    <p style="text-align: center; font-size: 1.5em; color: #fff;">
        Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!
    </p>
    <div class="leaderboard-container">
        <a href="Dashboard.php" class="back-button">
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
            <tbody id="leaderboard-body">
                <tr>
                    <td colspan="3" style="text-align:center;" id="loading-message">Loading leaderboard...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        // Fetch leaderboard data
        fetch("../Controllers/save_score.php?fetch_leaderboard=true")
            .then(response => response.json())
            .then(data => {
                const leaderboardBody = document.getElementById("leaderboard-body");
                leaderboardBody.innerHTML = ""; // Clear existing rows

                if (Array.isArray(data) && data.length > 0) {
                    data.forEach((row, index) => {
                        leaderboardBody.innerHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${row.username}</td>
                                <td>${row.score}</td>
                            </tr>
                        `;
                    });
                } else {
                    leaderboardBody.innerHTML = `
                        <tr>
                            <td colspan="3" style="text-align:center;">No data available yet.</td>
                        </tr>
                    `;
                }
            })
            .catch(error => {
                console.error("Error fetching leaderboard:", error);
                const leaderboardBody = document.getElementById("leaderboard-body");
                leaderboardBody.innerHTML = `
                    <tr>
                        <td colspan="3" style="text-align:center;">Error loading leaderboard. Please try again later.</td>
                    </tr>
                `;
            });
    </script>
</body>
</html>
