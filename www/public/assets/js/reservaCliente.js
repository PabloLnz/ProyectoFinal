    function seleccionarCita(citaId) {
        document.querySelectorAll('.card-cita').forEach(card => card.classList.remove('seleccionada'));
        document.querySelector('.card-cita[onclick*="' + citaId + '"]').classList.add('seleccionada');
        console.log('Cita seleccionada:', citaId);
    }