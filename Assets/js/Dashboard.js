// Function to toggle profile popup visibility
function toggleProfilePopup() {
    const popup = document.getElementById("profile-popup");
    popup.style.display = popup.style.display === "flex" ? "none" : "flex";
}


        function confirmLogout() {
            const userConfirmed = confirm("Are you sure you want to logout?");
            if (userConfirmed) {
                window.location.href = "../Controllers/logout.php";
            }
        }
        document.getElementById("update-profile").addEventListener("click", function () {
    const form = document.getElementById("profile-form");
    const formData = new FormData(form);

    // Send the form data via AJAX
    fetch("../Controllers/update_profile.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json()) // Parse JSON response
        .then((data) => {
            const messageDiv = document.getElementById("message");

            if (data.success) {
                messageDiv.innerHTML = `<div class="success-message">${data.message}</div>`;

                // Wait a moment before redirecting to the dashboard
                setTimeout(() => {
                    window.location.href = "../Views/Dashboard.php";
                }, 1500); // 1.5-second delay to show the message
            } else {
                messageDiv.innerHTML = `<div class="error-message">${data.message}</div>`;
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            const messageDiv = document.getElementById("message");
            messageDiv.innerHTML = `<div class="error-message">An unexpected error occurred.</div>`;
        });
});

