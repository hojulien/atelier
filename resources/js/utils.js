// setTo changes a boolean to the passed value
export function setTo(bool, val){
    bool = val;
    return bool;
}

// resetText empties error message and calls setTo to true
export function resetText(id, bool) {
    document.getElementById(id).textContent = "";
    bool = setTo(bool, true);
}