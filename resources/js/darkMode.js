let darkMode = document.getElementById("dark");
let lightMode = document.getElementById("light");
let lightIcons = document.querySelectorAll(".iconLight");
let darkIcons = document.querySelectorAll(".iconDark");
let body = document.querySelector("body");

// displays an icon and "hides" the other

function displayDarkIcon(){
    lightMode.style.display = "none";
    darkMode.style.display = "block";
    lightIcons.forEach(icon => icon.style.display = "block");
    darkIcons.forEach(icon => icon.style.display = "none");
}

function displayLightIcon(){
    darkMode.style.display = "none";
    lightMode.style.display = "block";
    darkIcons.forEach(icon => icon.style.display = "block");
    lightIcons.forEach(icon => icon.style.display = "none");
}

// applies changes depending on localStorage value, then display website
// ensures style changes are effective BEFORE attempting to display the page content

document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
        displayLightIcon();
    } else {
        displayDarkIcon();
    }
});

// toggling dark/light mode

darkMode.addEventListener("click", () => {
    body.classList.add("dark-mode");
    localStorage.setItem("theme", "dark"); 
    displayLightIcon();
});

lightMode.addEventListener("click", () => {
    body.classList.remove("dark-mode");
    localStorage.setItem("theme", "light");
    displayDarkIcon();
});