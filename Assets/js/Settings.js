document.addEventListener("DOMContentLoaded", () => {
    const musicToggle = document.getElementById("music-toggle");

    // Retrieve the current music state from localStorage
    const isMusicEnabled = localStorage.getItem("musicEnabled") === "true";

    // Set the initial state of the toggle
    if (musicToggle) {
        musicToggle.checked = isMusicEnabled;

        // Add event listener to update localStorage when toggled
        musicToggle.addEventListener("change", () => {
            localStorage.setItem("musicEnabled", musicToggle.checked);
        });
    }
});
