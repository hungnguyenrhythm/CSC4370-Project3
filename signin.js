function checkUser() {
    let text = document.getElementById("User").value;
    let pattern = /[^ ]+/;
    let warning = document.getElementById("warning");
    if (pattern.test(text)) {
        warning.innerHTML = "";
    } else {
        warning.innerHTML = "Invalid username. Needs character";
        warning.style.color = "red";
    }
}

function checkEmail() {
    let text = document.getElementById("Email").value;
    let pattern = /.+@.+\..+/;
    let warning = document.getElementById("warnEmail");
    if (pattern.test(text)) {
        warning.innerHTML = "";
    } else {
        warning.innerHTML = "Invalid email.";
        warning.style.color = "red";
    }
}

function checkPassword() {
    let text = document.getElementById("Password").value;
    let pattern = /[^ ]+/;
    let warning = document.getElementById("warnPassword");
    if (pattern.test(text)) {
        warning.innerHTML = "";
    } else {
        warning.innerHTML = "Invalid password. Can't have spaces.";
        warning.style.color = "red";
    }
}