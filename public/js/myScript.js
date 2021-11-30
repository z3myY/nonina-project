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

// Likes

function darLike(idUsuario, idComentario) {
    fetch('https://127.0.0.1:8000/darLike/' + idUsuario + '/' + idComentario).then((respuesta) => {
        console.log('OK');
    });
    contarLikes(idComentario);
}

function quitarLike(idUsuario, idComentario) {
    fetch('https://127.0.0.1:8000/quitarLike/' + idUsuario + '/' + idComentario).then((respuesta) => {
        console.log('OK');
    });
    contarLikes(idComentario);
}



function contarLikes(idComentario) {

    fetch('https://127.0.0.1:8000/contarLikes/' + idComentario).then(respuesta => {
        respuesta.text().then(contador => {
            document.getElementById("nlikes" + idComentario).innerHTML = contador;
        })
    });
}

function pintarLikes() {
    comentarios = $('.nlikes');

    comentarios.each(function (posicion, comentario) {
        idComentario = comentario.id.replace("nlikes", "");
        contarLikes(idComentario);
    })
}

// Funcion para llamar funciones al final
function inicializar() {
    pintarLikes();
}

window.onload = inicializar();