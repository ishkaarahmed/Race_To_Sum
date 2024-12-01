<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Views/Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Banana Game - Race to Sum</title>
  <link rel="stylesheet" href="../Assets/css/Play.css">
</head>
<body>
  <div id="game-container">
    <h1>RACE TO SUM</h1>
    <div id="level-info">
      <span id="level">Level: 1</span>
      <span id="score">Score: 0</span>
      <span id="timer">Time: <span id="time-left">30</span>s</span>
    </div>
    <div id="question-container">
      <p id="question-text">Loading question...</p>
      <input type="text" id="answer-input" placeholder="Type your answer" />
      <button id="submit-answer">Submit Answer</button>
    </div>
    <button id="next-level" style="display: none;">Next Level</button>
    <button id="quit-game">
      <img src="../Assets/images/quit.png" alt="Quit" class="quit-icon">
    </button>
  </div>
  <div id="balloon-animation" style="display: none;">
    🎈🎈🎈🎈🎈
  </div>
  <audio id="play-music" loop>
    <source src="../Assets/sounds/play_bg.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<script src="../Assets/js/GameSounds.js" defer></script>


  <script src="../Assets/js/Play.js"></script>
</body>
</html>
