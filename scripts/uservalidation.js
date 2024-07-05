// Function to validate username
function validateUsername(username) {
    const regex = /^[a-zA-Z0-9_]+$/;

    if (username.length < 6) {
        return 'Username must be at least 6 characters';
    }

    if (!regex.test(username)) {
        return 'Username can only contain letters, numbers, and underscores';
    }

    return ''; // Empty string indicates no error
}

// Function to validate password
function validatePassword(password) {
    let errorMessage = '';

    if (password.length < 8) {
        errorMessage += 'Password must be at least 8 characters\n';
    }

    if (!/[A-Z]/.test(password) || !/[a-z]/.test(password)) {
        errorMessage += 'Password must include both upper and lower case characters\n';
    }

    if (!/\d/.test(password)) {
        errorMessage += 'Password must include at least one digit\n';
    }

    if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        errorMessage += 'Password must include at least one special character\n';
    }

    return errorMessage.trim(); // Return trimmed error message or empty string
}

// Function to update form state based on validation
function updateFormState() {
    const usernameInput = document.getElementById('username').value.trim();
    const passwordInput = document.getElementById('userpass').value.trim();
    const userFirstname = document.getElementById('userfirstname').value.trim();
    const signUpBtn = document.getElementById('signUpBtn');

    const usernameCond1 = document.getElementById('usernameCond1');
    const usernameCond2 = document.getElementById('usernameCond2');
    const passwordCond1 = document.getElementById('passwordCond1');
    const passwordCond2 = document.getElementById('passwordCond2');
    const passwordCond3 = document.getElementById('passwordCond3');
    const passwordCond4 = document.getElementById('passwordCond4');

    // Validate Username
    if (usernameInput.length === 0) {
        usernameCond1.textContent = '';
        usernameCond2.textContent = '';
    } else {
        const usernameError1 = usernameInput.length < 6 ? 'Username must be at least 6 characters' : '';
        const usernameError2 = !/^[a-zA-Z0-9_]+$/.test(usernameInput) ? 'Username can only contain letters, numbers, and underscores' : '';

        usernameCond1.textContent = usernameError1;
        usernameCond2.textContent = usernameError2;
    }

    // Validate Password
    if (passwordInput.length === 0) {
        passwordCond1.textContent = '';
        passwordCond2.textContent = '';
        passwordCond3.textContent = '';
        passwordCond4.textContent = '';
    } else {
        // Check each condition individually
        passwordCond1.textContent = passwordInput.length < 8 ? 'Password must be at least 8 characters' : '';
        passwordCond2.textContent = !/[A-Z]/.test(passwordInput) || !/[a-z]/.test(passwordInput) ? 'Password must include both upper and lower case characters' : '';
        passwordCond3.textContent = !/\d/.test(passwordInput) ? 'Password must include at least one digit' : '';
        passwordCond4.textContent = !/[!@#$%^&*(),.?":{}|<>]/.test(passwordInput) ? 'Password must include at least one special character' : '';
    }

    // Clear error messages if conditions are fulfilled
    if (passwordInput.length >= 8) {
        passwordCond1.textContent = '';
    }
    if (/[A-Z]/.test(passwordInput) && /[a-z]/.test(passwordInput)) {
        passwordCond2.textContent = '';
    }
    if (/\d/.test(passwordInput)) {
        passwordCond3.textContent = '';
    }
    if (/[!@#$%^&*(),.?":{}|<>]/.test(passwordInput)) {
        passwordCond4.textContent = '';
    }

    // Enable or disable the submit button based on all conditions
    const isUsernameValid = usernameInput.length >= 6 && /^[a-zA-Z0-9_]+$/.test(usernameInput);
    const isPasswordValid = validatePassword(passwordInput) === '';

    if (isUsernameValid && isPasswordValid && userFirstname !== '') {
        signUpBtn.style.display = 'block'; // Show the button if all conditions are met
    } else {
        signUpBtn.style.display = 'none'; // Hide the button otherwise
    }
}

// Event listeners for input fields
document.getElementById('username').addEventListener('input', updateFormState);
document.getElementById('userpass').addEventListener('input', updateFormState);
document.getElementById('userfirstname').addEventListener('input', updateFormState);

// Initial form validation on page load
updateFormState();
