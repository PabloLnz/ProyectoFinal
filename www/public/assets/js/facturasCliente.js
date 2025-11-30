function abrirComentarios(texto) {
    document.getElementById('textoComentario').textContent = texto;
    document.getElementById('contenedorComentarios').classList.add('activo');
}

function cerrarComentarios() {
    document.getElementById('contenedorComentarios').classList.remove('activo');
}