let form = document.getElementById("login");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let isValid = true;

    // NOM
    if (document.getElementById("name").value.length == 0) {
        document.getElementById("error-name").textContent = "Please enter an username."
        isValid = setTo(isValid, false);
    } else {
        resetText("error-name",isValid);
    }

    if (isValid) {
        form.submit();
    }
});

// setTo change un booléen en une valeur donnée
function setTo(bool, val){
    bool = val;
    return bool;
}

// resetText vide le message d'erreur et appelle setTo à true
function resetText(id, bool) {
    document.getElementById(id).textContent = "";
    bool = setTo(bool, true);
}