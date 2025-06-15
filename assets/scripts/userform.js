let form = document.getElementById("formUser");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let isValid = true;

    // username
    if (document.getElementById("name").value.length == 0) {
        document.getElementById("error-name").textContent = "please enter an username."
        isValid = setTo(isValid, false);
    } else if (document.getElementById("name").value.length < 3) {
        document.getElementById("error-name").textContent = "username must be at least 3 characters."
        isValid = setTo(isValid, false);
    } else {
        resetText("error-name",isValid);
    }

    // password (ONLY IF IT EXISTS)
    if (document.getElementById("pw")) {
        if (document.getElementById("pw").value.length == 0) {
            document.getElementById("error-pw").textContent = "please enter a valid password."
            isValid = setTo(isValid, false);
        } else if (document.getElementById("pw").value.length < 4) {
            document.getElementById("error-pw").textContent = "password must be at least 4 characters."
            isValid = setTo(isValid, false);
        } else {
            resetText("error-pw",isValid);
        }
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