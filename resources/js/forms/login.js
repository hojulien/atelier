import { setTo, resetText } from "../utils.js";

let form = document.getElementById("login");

form.addEventListener("submit", (e) => {
    // prevents default behavior (refreshing page)
    e.preventDefault();
    let isValid = true;

    // USERNAME
    // upon error, sets isValid to false so the form cannot submit
    if (document.getElementById("username").value.length == 0) {
        document.getElementById("error_username").textContent = "please enter an username."
        isValid = setTo(isValid, false);
    } else {
        resetText("error_username",isValid);
    }

    if (document.getElementById("password").value.length == 0) {
        document.getElementById("error_password").textContent = "please enter a password."
        isValid = setTo(isValid, false);
    } else {
        resetText("error_username",isValid);
    }

    if (isValid) {
        form.submit();
    }
});