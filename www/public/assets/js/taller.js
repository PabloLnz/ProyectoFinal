
(function () {
  'use strict';

  async function init() {
    try {
      const seleccion = document.querySelector('#id_pais');
      if (!seleccion) return;

      const url = 'https://restcountries.com/v2/all?fields=name,alpha2Code';
      const respuesta = await fetch(url);
      if (!respuesta.ok) {
        console.error('taller.js: fallo al obtener países, status=', respuesta.status);
        return;
      }
      const data = await respuesta.json();
      if (!Array.isArray(data)) {
        console.error('taller.js: respuesta de países no es un array');
        return;
      }


      for (const item of data) {
        const nombre = item && (item.name || '');
        if (!nombre) continue;
        const opt = document.createElement('option');
      
        opt.value = nombre;
        opt.textContent = nombre;
        seleccion.appendChild(opt);
      }

		} catch (e) {
			console.warn('No se pudieron cargar los países:', e);
		}
	}

    const elementoFecha = document.getElementById('fecha-actual');

    if (elementoFecha) {
      const hoy = new Date();
      const opciones = {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      };
      const fechaFormateada = hoy.toLocaleDateString('es-ES', opciones);

      elementoFecha.textContent = fechaFormateada;
    }

	document.addEventListener('DOMContentLoaded', init);
})();

