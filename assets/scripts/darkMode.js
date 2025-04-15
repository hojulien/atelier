let darkMode = document.getElementById("dark");
let lightMode = document.getElementById("light");
let header = document.querySelector("header");

darkMode.addEventListener("click", () => {
    darkMode.style.display = "none";
    lightMode.style.display = "block";
    header.classList.toggle("darkToggle");
});

lightMode.addEventListener("click", () => {
    lightMode.style.display = "none";
    darkMode.style.display = "block";
    header.classList.remove("darkToggle");
});