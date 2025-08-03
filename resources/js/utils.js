// resetText empties error message and sets validation boolean to true
export function resetText(id, bool) {
    document.getElementById(id).textContent = "";
    document.getElementById(id).classList.add("hidden");
    bool = true;
}