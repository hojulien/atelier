import { setTo, resetText } from "../utils.js";

let form = document.getElementById("playlistForm");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let name = document.getElementById("playlist_name");
    let nameErr = document.getElementById("error_playlist_name");
    let isValid = true;

    if (name.value.length == 0) {
        nameErr.textContent = "playlist must have a name.";
        isValid = setTo(isValid, false);
    } else if (name.value.length < 5 || name.value.length > 50) {
        nameErr.textContent = "playlist name must be between 5 and 60 characters.";
        isValid = setTo(isValid, false);
    } else {
        resetText("error_playlist_name",isValid);
    }

    if (isValid) {
        form.submit();
    }
});