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
  <title>Game Over</title>
  <link rel="stylesheet" href="../Assets/css/Score.css">
</head>
<body>
  <div id="score-container">
    <h1 class="score-title">Game Over</h1>
    <div class="score-box">
      <p class="final-score">Your Score: <span id="score">Loading...</span></p>
    </div>
    <div class="button-container">
      <a href="Play.php" class="score-button play-again-button">Play Again</a>
    </div>
    <a href="Dashboard.php" class="back-home-icon">
      <img src="../Assets/images/back.png" alt="Back to Home">
    </a>
  </div>

  <script>
document.addEventListener("DOMContentLoaded", () => {
    const scoreElement = document.getElementById("score");

    fetch("../Controllers/scorehandler.php")
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error("Error from backend:", data.error);
                scoreElement.textContent = "Error loading score.";
            } else {
                scoreElement.textContent = data.score; // Display the score
            }
        })
        .catch(error => {
            console.error("Error fetching score:", error);
            scoreElement.textContent = "Error loading score.";
        });
});

</script>

</body>
</html>

