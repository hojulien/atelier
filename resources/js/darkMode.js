let darkMode = document.getElementById("dark");
let lightMode = document.getElementById("light");
let lightIcons = document.querySelectorAll(".iconLight");
let darkIcons = document.querySelectorAll(".iconDark");
let body = document.querySelector("body");

// affiche une icône et "cache" l'autre

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

// applique les changements du site selon la valeur de localStorage, puis affiche le site
// cela permet d'être sûr que les changements de style soient effectifs avant d'afficher le contenu du site

document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
        displayLightIcon();
    } else {
        displayDarkIcon();
    }
});

// passage au mode sombre/clair

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