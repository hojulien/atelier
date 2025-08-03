import { resetText } from "../utils.js";

let form = document.getElementById("suggestionForm");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let desc = document.getElementById("suggestion_description");
    let descErr = document.getElementById("error_suggestion_description");
    let selectedType = document.getElementById("select-media");
    let mediaUrl = document.getElementById("music-field");
    let mediaUrlErr = document.getElementById("error_music_field");

    let ytPattern = /^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w\-]{11}$/;
    let isValid = true;

    // DESCRIPTION
    if (desc.value.length === 0) {
        descErr.textContent = "please give a context to your suggestion.";
        descErr.classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_suggestion_description",isValid);
    }

    // URL
    if (selectedType.value === "music") {
        if (mediaUrl.value.length === 0) {
            mediaUrlErr.textContent = "please fill an url.";
            mediaUrlErr.classList.remove("hidden");
            isValid = false;
        } else if (!ytPattern.test(mediaUrl.value)) {
            mediaUrlErr.textContent = "must be a youtube url."
            mediaUrlErr.classList.remove("hidden");
            isValid = false;
        } else {
            resetText("error_music_field",isValid);
        }
    }

    if (isValid) {
        form.submit();
    }
});