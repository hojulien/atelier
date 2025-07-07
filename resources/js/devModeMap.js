const devMode = document.getElementById("admin-actions");
const views = document.querySelectorAll(".view");
const edits = document.querySelectorAll(".edit");
const dels = document.querySelectorAll(".delete");

function toggleButtons() {
    if(devMode.checked === true) {
        views.forEach((view) => view.classList.remove("invisible"));
        edits.forEach((edit) => edit.classList.remove("invisible"));
        dels.forEach((del) => del.classList.remove("invisible"));
    } else {
        views.forEach((view) => view.classList.add("invisible"));
        edits.forEach((edit) => edit.classList.add("invisible"));
        dels.forEach((del) => del.classList.add("invisible"));
    }
}

devMode.addEventListener("change", toggleButtons);
toggleButtons();
