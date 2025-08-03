import { resetText } from "../utils.js";

// similar to register.js but removes password check

let form = document.getElementById("userEditForm");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let username = document.getElementById("username");
    let usernameErr = document.getElementById("error_username");
    let password = document.getElementById("password");
    let passwordErr = document.getElementById("error_password");
    let email = document.getElementById("email");
    let emailErr = document.getElementById("error_email");
    
    let emailPattern = /^[^@]+@[^@.]+\.[^@]+$/;
    let pwPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z\d]).{8,}$/;
    let isValid = true;

    // USERNAME
    if (username.value.length == 0) {
        usernameErr.textContent = "please enter an username.";
        usernameErr.classList.remove("hidden");
        isValid = false;
    } else if (username.value.length < 3) {
        usernameErr.textContent = "username must be at least 4 characters.";
        usernameErr.classList.remove("hidden");
        isValid = false;
    } else if (username.value.length > 20) {
        usernameErr.textContent = "username must not exceed 20 characters.";
        usernameErr.classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_username", isValid);
    }
    
    // EMAIL
    if (email.value.length == 0) {
        emailErr.textContent = "please enter an email address.";
        emailErr.classList.remove("hidden");
        isValid = false;
    } else if (!emailPattern.test(email.value)) {
        emailErr.textContent = "email address must be a valid format.";
        emailErr.classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_email", isValid);
    }

    // PASSWORD
    console.log(password.value.length);
    if (password.value.length != 0 && !pwPattern.test(password.value)) {
        passwordErr.textContent = "password must be at least 8 characters and contain: 1 lowercase letter, 1 uppercase letter, 1 number and 1 special character.";
        passwordErr.classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_password", isValid);
    }
    
    // PASSWORD CONFIRM
    if (document.getElementById("password_confirmation").value !== password.value) {
        document.getElementById("error_password_confirmation").textContent = "password must match.";
        document.getElementById("error_password_confirmation").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_password_confirmation", isValid);
    }

    if (isValid) {
        form.submit();
    }
});