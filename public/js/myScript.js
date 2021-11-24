$('.carousel').carousel({
    interval: 3000
})


// Script para mostrar contraseña con un checkboss
function mostrarPassword() {
    var x = document.getElementById("inputPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function mostrarPasswordEditarUsuario() {
    var x = document.getElementById("form_password_first");
    var y = document.getElementById("form_password_second");
    if (x.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}

// Script para deslogear en la misma página en la que estemos
function cerrarSesion() {

    var request = new XMLHttpRequest();

    request.open("GET", "/logout");

    request.onreadystatechange = function () {
        if (this.readyState === 4) {
            window.location = "";
        }
    };
    request.send();
}

function setPlaceholderPassword() {
    var x = document.getElementById("form_password_first");
    var y = document.getElementById("form_password_second");

    x.placeholder = "p4ssWord_";
    y.placeholder = "Repetir cotraseña";
}
window.onload = setPlaceholderPassword();