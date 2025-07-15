const devMode = document.getElementById("admin-actions");
const edits = document.querySelectorAll(".edit");
const dels = document.querySelectorAll(".delete");

// toggles edit/delete buttons for admin dev mode

function toggleButtons() {
    if(devMode.checked === true) {
        edits.forEach((edit) => edit.classList.remove("invisible"));
        dels.forEach((del) => del.classList.remove("invisible"));
    } else {
        edits.forEach((edit) => edit.classList.add("invisible"));
        dels.forEach((del) => del.classList.add("invisible"));
    }
}

devMode.addEventListener("change", toggleButtons);
toggleButtons(); // executes once to ensure consistency between refreshs
