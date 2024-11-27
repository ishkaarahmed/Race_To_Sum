document.addEventListener("DOMContentLoaded", () => {
    const gameMusic = document.getElementById("game-music");
    const gameBG = document.getElementById("game-bg");
    const wrongAnswer = document.getElementById("wrong-answer");
    const gameOver = document.getElementById("game-over");

    // Play login background music
    function playGameMusic() {
        gameMusic.play();
    }

    // Play game background music
    function playGameBG() {
        gameBG.play();
    }

    // Play wrong answer sound
    function playWrongAnswer() {
        wrongAnswer.play();
    }

    // Play game over sound
    function playGameOver() {
        gameOver.play();
    }

    // Stop all sounds
    function stopAllSounds() {
        gameMusic.pause();
        gameMusic.currentTime = 0;

        gameBG.pause();
        gameBG.currentTime = 0;

        wrongAnswer.pause();
        wrongAnswer.currentTime = 0;

        gameOver.pause();
        gameOver.currentTime = 0;
    }

    // Bind sounds to specific game events
    // Example: Call `playGameMusic()` after login
    document.addEventListener("loginSuccess", () => {
        playGameMusic();
    });

    // Example: Start background music when gameplay begins
    document.addEventListener("gameStart", () => {
        stopAllSounds();
        playGameBG();
    });

    // Example: Trigger wrong answer sound
    document.addEventListener("wrongAnswer", () => {
        playWrongAnswer();
    });

    // Example: Trigger game over sound
    document.addEventListener("gameOver", () => {
        stopAllSounds();
        playGameOver();
    });

    // Utility to stop all sounds when needed
    document.addEventListener("stopSounds", () => {
        stopAllSounds();
    });
});
