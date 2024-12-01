// Function to validate the login form before submission
function validateLoginForm(event) {
    event.preventDefault(); // Prevent form submission for validation

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    // Basic email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
        showError("Email is required.");
        return false;
    } else if (!emailPattern.test(email)) {
        showError("Please enter a valid email address.");
        return false;
    }

    // Password validation
    if (!password) {
        showError("Password is required.");
        return false;
    }

    // If validation passes, submit the form
    clearErrorMessage();
    document.getElementById("login-form").submit();
}

// Function to display error messages dynamically
function showError(message) {
    const errorMessage = document.getElementById("error-message");
    errorMessage.textContent = message;
    errorMessage.style.color = "red";
    errorMessage.style.marginBottom = "10px";
    errorMessage.style.fontSize = "1em";
}

function clearErrorMessage() {
    const errorMessage = document.getElementById("error-message");
    if (errorMessage) {
        errorMessage.textContent = "";
    }
}

