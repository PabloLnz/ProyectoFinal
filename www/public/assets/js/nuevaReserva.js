const hoy = new Date();
hoy.setDate(hoy.getDate() + 1);
const anyo = hoy.getFullYear();
const mes = String(hoy.getMonth() + 1).padStart(2, '0');
const dia = String(hoy.getDate()).padStart(2, '0');

document.getElementById("fecha_reserva").min = `${anyo}-${mes}-${dia}`;