import { setTo, resetText } from "../utils.js";

let form = document.getElementById("register");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let username = document.getElementById("username");
    let usernameErr = document.getElementById("error_username");
    let password = document.getElementById("password");
    let passwordErr = document.getElementById("error_password");
    let email = document.getElementById("email");
    let emailErr = document.getElementById("error_email");
    
    let emailPattern = /^[^@]+@[^@.]+\.[^@]+$/;
    // at least 1 lowercase, 1 uppercase, 1 special character, 1 number, 8 characters+
    let pwPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z\d]).{8,}$/;
    let isValid = true;

    // USERNAME
    if (username.value.length == 0) {
        usernameErr.textContent = "please enter an username."
        isValid = setTo(isValid, false);
    } else if (username.value.length < 3) {
        usernameErr.textContent = "username must be at least 4 characters."
        isValid = setTo(isValid, false);
    } else if (username.value.length > 20) {
        usernameErr.textContent = "username must not exceed 20 characters."
        isValid = setTo(isValid, false);
    } else {
        resetText("error_username", isValid);
    }
    
    // EMAIL
    if (email.value.length == 0) {
        emailErr.textContent = "please enter an email address."
        isValid = setTo(isValid, false);
    } else if (!emailPattern.test(email.value)) {
        emailErr.textContent = "email address must be a valid format."
        isValid = setTo(isValid, false);
    } else {
        resetText("error_email", isValid);
    }

    // PASSWORD
    if (password.value.length == 0) {
        passwordErr.textContent = "please enter a password."
        isValid = setTo(isValid, false);
    } else if (!pwPattern.test(password.value)) {
        passwordErr.textContent = "password must be at least 8 characters and contain: 1 lowercase letter, 1 uppercase letter, 1 number and 1 special character."
        isValid = setTo(isValid, false);
    } else {
        resetText("error_password", isValid);
    }
    
    // PASSWORD CONFIRM
    if (document.getElementById("password_confirmation").value !== password.value) {
        document.getElementById("error_password_confirmation").textContent = "password must match."
        isValid = setTo(isValid, false);
    } else {
        resetText("error_password_confirmation", isValid);
    }

    if (isValid) {
        form.submit();
    }
});