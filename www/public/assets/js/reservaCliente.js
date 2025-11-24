function seleccionarCita(card) {
    document.querySelectorAll('.card-cita').forEach(c => c.classList.remove('seleccionada'));
    card.classList.add('seleccionada');

    document.getElementById('estado').textContent = card.dataset.estado;
    document.getElementById('vehiculo').textContent = card.dataset.vehiculo;
    document.getElementById('matricula').textContent = card.dataset.matricula;
    document.getElementById('fecha-hora').textContent = card.dataset.fecha + ' a las ' + card.dataset.hora;
    document.getElementById('comentarios').textContent = card.dataset.comentarios || 'Sin comentarios';
}