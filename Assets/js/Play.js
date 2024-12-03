let level = 1;
let score = 0;
let questionCount = 0;
let timerDuration = 60; // Default for level 1
let timerInterval;
const totalQuestionsPerLevel = 3;
const apiEndpoint = "http://localhost/SE_Game/Controllers/banana_api.php";
const saveScoreEndpoint = "http://localhost/SE_Game/Controllers/save_score.php";

// Level configuration
const levelConfig = {
    1: { timer: 60, scorePerQuestion: 10 },
    2: { timer: 45, scorePerQuestion: 15 },
    3: { timer: 30, scorePerQuestion: 20 },
    4: { timer: 15, scorePerQuestion: 25 },
};

// Initialize game
document.addEventListener("DOMContentLoaded", () => {
    loadLevel(level);

    // Add event listeners
    document.getElementById("submit-answer").addEventListener("click", handleSubmitAnswer);
    document.getElementById("quit-game").addEventListener("click", quitGame);
});

// Load level data
function loadLevel(currentLevel) {
    const config = levelConfig[currentLevel];
    questionCount = 0;
    timerDuration = config.timer;

    document.getElementById("level").innerText = `Level: ${currentLevel}`;
    document.getElementById("score").innerText = `Score: ${score}`;
    document.getElementById("answer-input").value = ""; // Clear input field

    startTimer();
    fetchQuestion();
}

// Timer functionality
function startTimer() {
    clearInterval(timerInterval);
    let timeLeft = timerDuration;
    document.getElementById("time-left").innerText = timeLeft;

    timerInterval = setInterval(() => {
        timeLeft--;
        document.getElementById("time-left").innerText = timeLeft;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            endGame();
        }
    }, 1000);
}

// Handle answer submission
function handleSubmitAnswer() {
    const userAnswer = document.getElementById("answer-input").value.trim();
    if (userAnswer === "") {
        alert("Please enter an answer before submitting.");
        return;
    }
    checkAnswer(userAnswer);
}

// Check user's answer
function checkAnswer(userAnswer) {
    const correctAnswer = document.getElementById("submit-answer").dataset.correctAnswer;

    if (userAnswer === correctAnswer) {
        const config = levelConfig[level];
        score += config.scorePerQuestion;
        document.getElementById("score").innerText = `Score: ${score}`;
        questionCount++;
        document.getElementById("answer-input").value = ""; // Clear input

        if (questionCount < totalQuestionsPerLevel) {
            loadNextQuestion();
        } else if (level < 4) {
            level++;
            loadLevel(level);
        } else {
            showFinalScore();
        }
    } else {
        playWrongAnswerSound();
        alert("Incorrect answer. Try again!");
    }
}

// Fetch question from the API
function fetchQuestion() {
    fetch(apiEndpoint)
        .then(response => response.json())
        .then(data => {
            if (data.question) {
                displayQuestion(data);
            } else {
                document.getElementById("question-text").innerText = "Invalid API response.";
            }
        })
        .catch(error => {
            console.error("Error fetching question:", error);
            document.getElementById("question-text").innerText = "Error loading question.";
        });
}

// Display the question
function displayQuestion(data) {
    const questionText = document.getElementById("question-text");

    if (data.question.startsWith("http")) {
        questionText.innerHTML = `<img src="${data.question}" alt="Question Image" style="max-width: 100%; height: auto;">`;
    } else {
        questionText.innerText = data.question;
    }
    document.getElementById("submit-answer").dataset.correctAnswer = data.solution.toString();
}

// Load the next question
function loadNextQuestion() {
    clearInterval(timerInterval);
    document.getElementById("answer-input").value = ""; // Clear input
    startTimer();
    fetchQuestion();
}

// End game logic
function endGame() {
    playGameOverSound();
    alert("Time's up! Game over.");
    saveScore();
    window.location.href = "score.php";
}

// Quit game functionality
function quitGame() {
    if (confirm("Are you sure you want to quit?")) {
        saveScore();
        window.location.href = "score.php";
    }
}

// Save the user's score
function saveScore() {
    fetch(saveScoreEndpoint, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `score=${score}`,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Score saved:", data.message);
            } else {
                console.error("Error saving score:", data.error);
            }
        })
        .catch(error => console.error("Error saving score:", error));
}

function showFinalScore() {
  playGameOverSound();
  alert(`Congratulations! You completed the game.`);
  saveScore();
  window.location.href = "score.php";
}
playGameOverSound();
// Play wrong answer sound
function playWrongAnswerSound() {
    const wrongAnswerSound = document.getElementById("wrong-answer-sound");
    if (wrongAnswerSound) {
        wrongAnswerSound.currentTime = 0; // Reset to start
        wrongAnswerSound.play().catch(error => console.warn("Unable to play sound:", error));
    }
}

// Play game-over sound
function playGameOverSound() {
    const gameOverSound = document.getElementById("game-over-sound");
    if (gameOverSound) {
        gameOverSound.currentTime = 0; // Reset to start
        gameOverSound.play().catch(error => console.warn("Unable to play sound:", error));
    }
}
