$(document).ready(function(){
    $('#birth-date').mask('00/00/0000');
    $('#phone-number').mask('0000-0000');
   })

function checkUsername() {
    const usernameInput = document.getElementById('username');
    const condition1 = document.getElementById('cond1');
    const condition2 = document.getElementById('cond2');
    const regex = /^[a-zA-Z0-9_]+$/;

    let usernameValid = true;

    if (usernameInput.value.length >= 6) {
        condition1.style.color = 'green';
    } else {
        condition1.style.color = 'red';
        usernameValid = false;
    }

    if (!regex.test(usernameInput.value)) {
        usernameValid = false;
    } else {
        condition2.style.color = 'green';
    }

    return usernameValid;
}

function checkPassword() {
    const userPassword = document.getElementById('userpass');
    const condition3 = document.getElementById('cond3');
    const condition4 = document.getElementById('cond4');
    const condition5 = document.getElementById('cond5');
    const condition6 = document.getElementById('cond6');

    let passwordValid = true;

    const lengthCondition = userPassword.value.length >= 8;
    const upperCase = /[A-Z]/.test(userPassword.value);
    const lowerCase = /[a-z]/.test(userPassword.value);
    const digit = /[0-9]/.test(userPassword.value);
    const specialChar = /[!@#$%^&*(),.?":{}|<>]/.test(userPassword.value);

    condition3.style.color = lengthCondition ? 'green' : 'red';
    condition4.style.color = (upperCase && lowerCase) ? 'green' : 'red';
    condition5.style.color = digit ? 'green' : 'red';
    condition6.style.color = specialChar ? 'green' : 'red';

    if (!lengthCondition || !(upperCase && lowerCase) || !digit || !specialChar) {
        passwordValid = false;
    }

    return passwordValid;
}

function validateForm() {
    const usernameValid = checkUsername();
    const passwordValid = checkPassword();
    const submitContainer = document.getElementById('submitContainerSignup'); // Updated container ID

    // Remove any existing submit button
    while (submitContainer.firstChild) {
        submitContainer.removeChild(submitContainer.firstChild);
    }

    if (usernameValid && passwordValid) {
        // Create the submit button
        const submitBtn = document.createElement('button');
        submitBtn.textContent = 'Submit';
        submitBtn.className = 'btn mt-4';
        submitBtn.type = 'submit'; // Change type to 'submit' if it's inside a form

        // Append the submit button to the container
        submitContainer.appendChild(submitBtn);
    }
}


document.getElementById('username').addEventListener('input', validateForm);
document.getElementById('userpass').addEventListener('input', validateForm);

// Initially validate form on page load
validateForm();

