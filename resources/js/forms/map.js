import { resetText } from "../utils.js";

let form = document.getElementById("mapForm");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let isValid = true;

    // ARTIST
    if (document.getElementById("artist").value.length === 0) {
        document.getElementById("error_artist").textContent = "please enter an artist name.";
        document.getElementById("error_artist").classList.remove("hidden");
        isValid = false;
    } else if (document.getElementById("artist").value.length > 40) {
        document.getElementById("error_artist").textContent = "artist name must not exceed 40 characters.";
        document.getElementById("error_artist").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_artist", isValid);
    }
    
    // TITLE
    if (document.getElementById("title").value.length === 0) {
        document.getElementById("error_title").textContent = "please enter a song title.";
        document.getElementById("error_title").classList.remove("hidden");
        isValid = false;
    } else if (document.getElementById("title").value.length > 80) {
        document.getElementById("error_title").textContent = "song title must not exceed 80 characters.";
        document.getElementById("error_title").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_title", isValid);
    }

    // ARTIST UNICODE
    if (document.getElementById("artistUnicode").value.length > 25) {
        document.getElementById("error_artistUnicode").textContent = "original artist name must not exceed 25 characters.";
        document.getElementById("error_artistUnicode").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_artistUnicode", isValid);
    }
    
    // TITLE UNICODE
    if (document.getElementById("titleUnicode").value.length > 50) {
        document.getElementById("error_titleUnicode").textContent = "original song title must not exceed 50 characters.";
        document.getElementById("error_titleUnicode").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_titleUnicode", isValid);
    }

    // CREATOR
    if (document.getElementById("creator").value.length === 0) {
        document.getElementById("error_creator").textContent = "please enter a creator name.";
        document.getElementById("error_creator").classList.remove("hidden");
        isValid = false;
    } else if (document.getElementById("creator").value.length > 20) {
        document.getElementById("error_creator").textContent = "creator name must not exceed 20 characters.";
        document.getElementById("error_creator").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_creator", isValid);
    }

    // SR
    if (document.getElementById("srForm").value === "") {
        document.getElementById("error_sr").textContent = "please enter a valid star rating."
        document.getElementById("error_sr").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_sr", isValid);
    }

    // LENGTH
    if (document.getElementById("lengthForm").value === "") {
        document.getElementById("error_length").textContent = "please enter a length (in seconds)."
        document.getElementById("error_length").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_length", isValid);
    }

    // SETTINGS
    // 1 error message for 4 fields
    if (
        document.getElementById("csForm").value.trim() === "" ||
        document.getElementById("hpForm").value.trim() === "" ||
        document.getElementById("arForm").value.trim() === "" ||
        document.getElementById("odForm").value.trim() === ""
    ) {
        document.getElementById("error_settings").textContent = "please fill all map settings.";
        document.getElementById("error_settings").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_settings", isValid);
    }

    // SET ID, MAP ID
    if (document.getElementById("setId").value.trim() === "") {
        document.getElementById("error_setId").textContent = "please enter a valid osu! set ID."
        document.getElementById("error_setId").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_setId", isValid);
    }

    if (document.getElementById("mapId").value.trim() === "") {
        document.getElementById("error_mapId").textContent = "please enter a valid osu! map ID."
        document.getElementById("error_mapId").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_mapId", isValid);
    }
    
    // SUBMIT DATE, LAST UPDATED
    if (document.getElementById("submitDate").value.trim() === "") {
        document.getElementById("error_submitDate").textContent = "please enter a valid date."
        document.getElementById("error_submitDate").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_submitDate", isValid);
    }

    if (document.getElementById("lastUpdated").value.trim() === "") {
        document.getElementById("error_lastUpdated").textContent = "please enter a valid date."
        document.getElementById("error_lastUpdated").classList.remove("hidden");
        isValid = false;
    } else {
        resetText("error_lastUpdated", isValid);
    }

    if (isValid) {
        form.submit();
    }
});