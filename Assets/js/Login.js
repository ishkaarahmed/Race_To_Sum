// Function to validate the login form before submission
function validateLoginForm() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Basic email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        showError("Please enter a valid email address.");
        return false;
    }

    // Check if the password field is empty
    if (password.trim() === "") {
        showError("Please enter your password.");
        return false;
    }

    return true;
}

// Function to display error messages dynamically
function showError(message) {
    const errorMessage = document.getElementById("error-message");
    errorMessage.textContent = message;
    errorMessage.style.color = "red";
}

function clearErrorMessage() {
    const errorMessage = document.getElementById("error-message");
    if (errorMessage) {
        console.log("Clearing error message..."); // Debugging log
        errorMessage.textContent = ""; // Clear the error message
    }
}
