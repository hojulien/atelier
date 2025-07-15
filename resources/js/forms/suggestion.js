import { setTo, resetText } from "../utils.js";

let form = document.getElementById("suggestionForm");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let desc = document.getElementById("suggestion_description");
    let descErr = document.getElementById("error_suggestion_description");
    let isValid = true;

    // DESCRIPTION
    if (desc.value.length === 0) {
        descErr.textContent = "please give a context to your suggestion.";
        isValid = setTo(isValid, false);
    } else {
        resetText("error_suggestion_description",isValid);
    }

    // evolution: add a regex pattern for trusted music websites (youtube/spotify/etc.)

    if (isValid) {
        form.submit();
    }
});