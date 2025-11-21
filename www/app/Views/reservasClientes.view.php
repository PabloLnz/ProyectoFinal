<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galician Motors</title>

    <!-- Fuente principal -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Iconos -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Bootstrap + AdminLTE -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Date/Time pickers -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- css -->
      <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/reservasClientes.css">
</head>
<body class="hold-transition">
<div class="wrapper">
    <!-- Header con Navbar -->
    <header id="mainHeader">
        <div class="container-fluid">
            <nav class="navbar">
                <a class="navbar-brand" href="#">
                    <img src="assets/img/logo.png" alt="Logo" class="logoIndex">
                </a>
                <ul class="d-flex list-unstyled justify-content-lg-end justify-content-md-center mb-0">
                    <li><a href="#" class="navLi">HORARIOS</a></li>
                    <li><a href="#" class="navLi">UBICACION</a></li>
                    <li><a href="#" class="navLi">TALLER</a></li>
                    <li><a href="#" class="navLi">SOBRE NOSOTROS</a></li>
                    <li><a href="#" class="navLi">HISTORIAL</a></li>
                    <li><a href="/reservaCliente" class="navLi">RESERVAS</a></li>
                    <li><a href="/login" class="linkLogin">LOGIN</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <!-- MAIN -->

<main class="contenedor-reservas">
    <div class="row">
        <div class="col-12">
            
            <div class="textoCitasBoton">

                <h1 class="titulo">
                    <i class="far fa-calendar-alt"></i> Mis Citas y Reservas
                </h1>
                
                <button class="boton-cita boton-principal" style="width: auto;">
                    <i class="fas fa-calendar-plus"></i> Solicitar Nueva Cita
                </button>
 </div>
            <p class="subtitulo">Aquí puedes revisar el estado y los detalles de tus citas</p>
            
            <div class="grid-citas">

                <section class="panel-lista-citas">
                    <h4>Próximas y Recientes</h4>
                    
                    <div class="card-cita seleccionada" onclick="seleccionarCita('cita1');">
                        <div class="info-cita">
                            <div class="fecha-hora-cita">
                                <i class="far fa-clock"></i> Lunes, 15 de Octubre - 10:00 AM
                            </div>
                            <div class="detalle-servicio-cita">
                                Revisión de Frenos y Neumáticos | Vehículo: <span>4567-XYZ (BMW)</span>
                            </div>
                        </div>
                        <span class="etiqueta-estado estado-confirmada">Confirmada</span>
                    </div>

                    <div class="card-cita" onclick="seleccionarCita('cita2');">
                        <div class="info-cita">
                            <div class="fecha-hora-cita">
                                <i class="far fa-clock"></i> Viernes, 19 de Enero - 03:30 PM
                            </div>
                            <div class="detalle-servicio-cita">
                                Servicio de Mantenimiento General (Filtros y Aceite) | Vehículo: <span>1234-ABC (BMW)</span>
                            </div>
                        </div>
                        <span class="etiqueta-estado estado-pendiente">Pendiente</span>
                    </div>
                    
                    <div class="card-cita" onclick="seleccionarCita('cita3');">
                        <div class="info-cita">
                            <div class="fecha-hora-cita">
                                <i class="far fa-clock"></i> Martes, 5 de Septiembre - 09:00 AM
                            </div>
                            <div class="detalle-servicio-cita">
                                Diagnóstico de motor | Vehículo: <span>4567-XYZ (BMW)</span>
                            </div>
                        </div>
                        <span class="etiqueta-estado estado-cancelada">Cancelada</span>
                    </div>

                </section>
                
                <section class="panel-detalles">
                    <h4><i class="fas fa-info-circle"></i> Detalles de la Cita</h4>
                    
                    <div class="secciones-panel">
                        <span class="etiqueta-detalle"><i class="fas fa-calendar-check"></i> Estado Actual</span>
                        <span class="valor-detalle confirmada">Confirmada</span>
                    </div>
                    
                    <div class="secciones-panel">
                        <span class="etiqueta-detalle"><i class="fas fa-car"></i> Vehículo</span>
                        <span class="valor-detalle">BMW Serie 3</span>
                    </div>

                     <div class="secciones-panel">
                        <span class="etiqueta-detalle"><i class="fas fa-car"></i> Matricula</span>
                        <span class="valor-detalle"> 4567-XYZ</span>
                    </div>
                    

                    <div class="secciones-panel">
                        <span class="etiqueta-detalle"><i class="fas fa-tools"></i> Servicio Solicitado</span>
                        <span class="valor-detalle">Revisión de Frenos y Neumáticos</span>
                    </div>

                    <div class="secciones-panel">
                        <span class="etiqueta-detalle"><i class="fas fa-map-marker-alt"></i> Ubicación del Taller</span>
                        <span class="valor-detalle">Salceda de Caselas</span>
                    </div>
                    
                    <h5 class="notas-comentarios">Notas y Comentarios</h5>
                    <p class="texto-comentarios">
                        "Se escucha un sonido agudo al frenar"
                    </p>
                    
                    <div class="acciones-rapidas-bloque">
                        <h5>Acciones Rápidas</h5>
                        
                        <button class="boton-cita boton-peligro-outline">
                            <i class="fas fa-times-circle"></i> Cancelar Cita
                        </button>
                        
                        <small class="aviso-cancelacion">Las cancelaciones deben hacerse con 24h de antelación.</small>
                    </div>

                </section>
            </div>
            
        </div>
    </div>
</main>





    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-container">

            <div class="footer-col footer-info">
                <h3 class="footer-logo">Galician Motors</h3>
                <p>Especialistas en la marca. Servicio de calidad garantizado en .</p>
                <p>
                    📞 <a href=""> XX XXX XX XX</a><br>
                    ✉️ <a href="">gMotors@galicianmotors.com</a>
                </p>
            </div>

            <div class="footer-col">
                <h4>Navegación</h4>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#galeria">Galería</a></li>
                    <li><a href="#citas">Pedir Cita</a></li>
                    <li><a href="#blog">Blog</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Servicios Top</h4>
                <ul>
                    <li><a href="#">Mantenimiento Oficial</a></li>
                    <li><a href="#">Diagnóstico Electrónico</a></li>
                    <li><a href="#">Reparación de Motores</a></li>
                    <li><a href="#">Chapa y Pintura</a></li>
                    <li><a href="#">Neumáticos y Frenos</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Visítanos</h4>
                <p>
                    Pontevedra<br>
                    Salceda de Caselas
                </p>
                <div class="social-links">
                    <a href="#" target="_blank" title="Facebook">FB</a>
                    <a href="#" target="_blank" title="Instagram">IG</a>
                    <a href="#" target="_blank" title="Twitter/X">TW</a>
                </div>
            </div>

        </div>

        <div class="footer-bot">
            <p>2025 Galician Motors. Todos los derechos reservados.</p>
            <p>
                <a href="#">Aviso Legal</a> |
                <a href="#">Política de Privacidad</a> |
                <a href="#">Cookies</a>
            </p>
        </div>
    </footer>
</div>
<!-- script index -->
<script src="assets/js/index.js"></script>
<!-- Scripts necesarios -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="assets/js/adminlte.min.js"></script>
<script src="assets/js/pages/main.js"></script>
<script src="assets/js/reservaCliente.js"></script>
</body>
</html>
