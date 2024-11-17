let level = 1;
let score = 0;
let timerDuration = 30;
let timerInterval;
const apiEndpoint = "http://localhost/SE_Game/Controllers/banana_api.php";

document.addEventListener("DOMContentLoaded", () => {
  loadLevel(level);

  document.getElementById("next-level").addEventListener("click", () => {
    level++;
    loadLevel(level);
  });

  document.getElementById("submit-answer").addEventListener("click", () => {
    const userAnswer = document.getElementById("answer-input").value;
    checkAnswer(userAnswer);
  });

  // Fetch the first question when the page loads
  fetchQuestion();
});

function loadLevel(currentLevel) {
  document.getElementById("level").innerText = `Level: ${currentLevel}`;
  document.getElementById("score").innerText = `Score: ${score}`;
  document.getElementById("answer-input").value = '';
  document.getElementById("next-level").style.display = "none";
  timerDuration = 30 - (currentLevel - 1) * 5;
  startTimer();
  fetchQuestion();
}

function startTimer() {
  clearInterval(timerInterval);
  let timeLeft = timerDuration;
  document.getElementById("time-left").innerText = timeLeft;

  timerInterval = setInterval(() => {
    timeLeft--;
    document.getElementById("time-left").innerText = timeLeft;
    if (timeLeft <= 0) {
      clearInterval(timerInterval);
      alert("Time's up! Try again.");
      resetGame();
    }
  }, 1000);
}

function checkAnswer(userAnswer) {
  const correctAnswer = document.getElementById("submit-answer").dataset.correctAnswer;
  if (userAnswer.trim() === correctAnswer.trim()) {
    score += 10;
    document.getElementById("score").innerText = `Score: ${score}`;
    showBalloonAnimation();
    document.getElementById("next-level").style.display = "block";
  } else {
    alert("Incorrect answer. Try again!");
  }
}

function displayQuestion(questionData) {
  const questionText = document.getElementById("question-text");
  const questionType = questionData.question.startsWith("http") ? "image" : "text";

  // Display question
  if (questionType === "image") {
    questionText.innerHTML = `<img src="${questionData.question}" alt="Question Image" style="max-width: 100%; height: auto;">`;
  } else {
    questionText.innerText = questionData.question;
  }

  // Store the correct answer
  document.getElementById("submit-answer").dataset.correctAnswer = questionData.solution.toString();
}


function showBalloonAnimation() {
  const animation = document.getElementById("balloon-animation");
  animation.style.display = "block";
  setTimeout(() => {
    animation.style.display = "none";
  }, 1000);
}

function resetGame() {
  score = 0;
  level = 1;
  loadLevel(level);
}

function quitGame() {
  const confirmQuit = confirm("Are you sure you want to quit?");
  if (confirmQuit) {
    window.location.href = "dashboard.html";
  }
}

function fetchQuestion() {
  fetch(apiEndpoint)
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      console.log("API Response:", data); // Debugging log
      if (data.question) {
        displayQuestion(data);
      } else {
        document.getElementById("question-text").innerText = "Invalid API response.";
      }
    })
    .catch(error => {
      console.error("Error fetching question:", error);
      document.getElementById("question-text").innerText = "Error loading question. Please try again.";
    });
}

