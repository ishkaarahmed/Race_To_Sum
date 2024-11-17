function validateLoginForm() {
    // Get the values from the input fields
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    // Basic email validation (checks for presence of "@" and ".")
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Check if the password field is empty
    if (password.trim() === "") {
        alert("Please enter your password.");
        return false;
    }

    // If validation passes, return true to allow form submission
    return true;
}
