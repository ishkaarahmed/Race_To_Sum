document.addEventListener("DOMContentLoaded", () => {
    console.log("JavaScript loaded successfully!"); // Debugging message

    // Form and input elements
    const signupForm = document.getElementById("signup-form");
    const emailInput = document.getElementById("email");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm-password");
    const signupButton = document.getElementById("signup-button");

    // Error message containers
    const emailError = document.getElementById("email-error");
    const usernameError = document.getElementById("username-error");
    const passwordError = document.getElementById("password-error");
    const confirmPasswordError = document.getElementById("confirm-password-error");

    signupButton.addEventListener("click", (event) => {
        // Prevent default form submission
        event.preventDefault();

        // Clear previous error messages
        clearErrorMessages();

        // Validate inputs
        const isValid = validateSignUpForm();

        if (isValid) {
            console.log("Validation passed. Submitting form.");
            signupForm.submit(); // Submit the form if all validations pass
        } else {
            console.log("Validation failed. Fix errors.");
        }
    });

    function validateSignUpForm() {
        let isValid = true;

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value.trim())) {
            emailError.textContent = "Please enter a valid email address.";
            emailError.style.color = "red";
            isValid = false;
        }

        // Username validation
        if (usernameInput.value.trim().length < 3) {
            usernameError.textContent = "Username must be at least 3 characters long.";
            usernameError.style.color = "red";
            isValid = false;
        }

        // Password length validation
        if (passwordInput.value.trim().length < 6) {
            passwordError.textContent = "Password must be at least 6 characters long.";
            passwordError.style.color = "red";
            isValid = false;
        }

        // Confirm Password validation
        if (passwordInput.value.trim() !== confirmPasswordInput.value.trim()) {
            confirmPasswordError.textContent = "Passwords do not match.";
            confirmPasswordError.style.color = "red";
            isValid = false;
        }

        return isValid;
    }

    function clearErrorMessages() {
        emailError.textContent = "";
        usernameError.textContent = "";
        passwordError.textContent = "";
        confirmPasswordError.textContent = "";
    }

    // Real-time error clearing
    emailInput.addEventListener("input", () => (emailError.textContent = ""));
    usernameInput.addEventListener("input", () => (usernameError.textContent = ""));
    passwordInput.addEventListener("input", () => (passwordError.textContent = ""));
    confirmPasswordInput.addEventListener("input", () => (confirmPasswordError.textContent = ""));
});
// Attach validation function to form submit event
document.getElementById("login-form").addEventListener("submit", validateLoginForm);
inputs.forEach(input => {
    input.addEventListener("input", () => {
        const message = document.querySelector("#error-message, #success-message");
        if (message) {
            message.classList.add("hidden");
            setTimeout(() => message.remove(), 300); // Remove after animation
        }
    });
});

