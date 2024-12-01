document.addEventListener("DOMContentLoaded", () => {
    const dashboardMusic = document.getElementById("dashboard-music");
    const gameMusic = document.getElementById("play-music");
    const musicToggle = document.getElementById("music-toggle");

    // Retrieve music state from localStorage
    const isMusicEnabled = localStorage.getItem("musicEnabled") === "true";

    // Play or pause music based on state
    function toggleMusic(audioElement, shouldPlay) {
        if (audioElement) {
            if (shouldPlay) {
                audioElement.play();
                audioElement.loop = true; // Ensure music loops
            } else {
                audioElement.pause();
            }
        }
    }

    // Initialize music state
    function initializeMusic() {
        if (dashboardMusic) {
            toggleMusic(dashboardMusic, isMusicEnabled);
        }
    }

    // Handle settings toggle
    if (musicToggle) {
        // Set toggle to reflect current state
        musicToggle.checked = isMusicEnabled;

        // Add event listener for toggle
        musicToggle.addEventListener("change", () => {
            const enabled = musicToggle.checked;
            localStorage.setItem("musicEnabled", enabled);

            if (dashboardMusic) toggleMusic(dashboardMusic, enabled && !gameMusic?.playing);
            if (gameMusic) toggleMusic(gameMusic, enabled && gameMusic?.playing);
        });
    }

    // Start game music when "Start Game" is clicked
    const startGameButton = document.querySelector(".start-game");
    if (startGameButton) {
        startGameButton.addEventListener("click", () => {
            toggleMusic(dashboardMusic, false); // Stop dashboard music
            if (gameMusic && isMusicEnabled) toggleMusic(gameMusic, true); // Play game music
        });
    }

    // Stop music when leaving the page
    window.addEventListener("beforeunload", () => {
        if (dashboardMusic) dashboardMusic.pause();
        if (gameMusic) gameMusic.pause();
    });

    // Initialize on load
    initializeMusic();
});
