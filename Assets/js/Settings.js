document.addEventListener("DOMContentLoaded", () => {
    const musicToggle = document.getElementById("music-toggle");
    const gameMusic = document.getElementById("game-music");
    const gameBG = document.getElementById("game-bg");

    // Restore music toggle state
    const isMusicEnabled = localStorage.getItem("musicEnabled") === "true";
    musicToggle.checked = isMusicEnabled;

    // Enable or disable music based on toggle
    function toggleMusic() {
        const isEnabled = musicToggle.checked;
        localStorage.setItem("musicEnabled", isEnabled);

        if (isEnabled) {
            if (gameBG.paused) gameBG.play();
            if (gameMusic.paused) gameMusic.play();
        } else {
            gameMusic.pause();
            gameBG.pause();
        }
    }

    // Listen to the toggle event
    musicToggle.addEventListener("change", toggleMusic);
});
