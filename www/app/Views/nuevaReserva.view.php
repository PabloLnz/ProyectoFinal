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
    <link rel="stylesheet" href="assets/css/nuevaReserva.css">
     <link rel="stylesheet" href="assets/css/global.css">
</head>
<body class="hold-transition">
<div class="wrapper">
    <!-- Header con Navbar -->
    <header id="mainHeader">
        <div class="container-fluid">
            <nav class="navbar">
                <a class="navbar-brand" href="/">
                    <img src="assets/img/logo.png" alt="Logo" class="logoIndex">
                </a>
                <ul class="d-flex list-unstyled justify-content-lg-end justify-content-md-center mb-0">
                    <li><a href="/horarios" class="navLi">HORARIOS</a></li>
                    <li><a href="/#ubicacion" class="navLi">UBICACION</a></li>
                    <li><a href="/sobreNosotros" class="navLi">SOBRE NOSOTROS</a></li>
                    <li><a href="/facturasCliente" class="navLi">FACTURAS</a></li>
                    <li><a href="/reservaCliente" class="navLi">RESERVAS</a></li>
                    <?php
                    if (isset($_SESSION['datosUsuario'])):
                        ?>
                        <li>
                            <a href="/logout" class="navLi linkLogout" title="Cerrar Sesión">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                    <?php else: ?>
                        <li><a href="/login" class="linkLogin">LOGIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- MAIN -->
    <main>
        	          <?php
          include $_ENV['folder.views'] . '/templates/flash-messages.php';
          ?>

        <div class="contenedor-card">
            <h1 class="titulo-principal">Solicitud de Cita</h1>
            <p class="descripcion-principal">Gestione la reserva de su próxima visita al taller de forma rapida y sencilla.</p>
            <form method="post">

                <div class="contenedor-columnas">

                    <div>
                        <h2 class="subtitulo-seccion">Datos del Vehiculo y Servicio</h2>

                        <div class="grupo-formulario">
                            <label for="matricula" class="etiqueta-formulario">Matricula</label>
                            <input type="text" name="matricula" placeholder="Ej: 1234 ABC" required class="inputEntrada inputMatricula"">
                        </div>

                        <div class="grupo-formulario">
                            <label for="marca" class="etiqueta-formulario">Marca</label>
                            <input type="text" name="marca" value="BMW" readonly class="inputEntrada">
                        </div>

                        <div class="grupo-formulario">
                            <label for="modelo" class="etiqueta-formulario">Modelo</label>
                            <input type="text" name="modelo" placeholder="Ej: Serie 5, X3, M4" class="inputEntrada">
                        </div>

                        <div class="grupo-formulario">
                            <label for="anyo" class="etiqueta-formulario">Año de Fabricación</label>
                            <input type="number" name="anyo" min="1950" max="2028" placeholder="Ej: 2018" class="inputEntrada">
                        </div>

                    </div>

                    <div>
                        <h2 class="subtitulo-seccion">Detalles de la Cita</h2>

                        <div class="grid-2columnas">
                            <div class="grupo-formulario">
                                <label for="fecha_reserva" class="etiqueta-formulario" id="fehca_reserva">Fecha Preferida</label>
                                <input type="date" id="fecha_reserva" name="fecha_reserva" required class="inputEntrada">
                            </div>
                            <div class="grupo-formulario">
                                <label for="hora_reserva" class="etiqueta-formulario">Hora Preferida</label>
                                <input type="time" name="hora_reserva" required class="inputEntrada"  min="10:00" max="20:00">
                            </div>
                        </div>

                        <div class="grupo-formulario">
                            <label for="comentariosReserva" class="etiqueta-formulario">Detalles de la Avería / Razón de la Visita</label>
                            <textarea name="comentariosReserva" rows="12" placeholder="Por favor, sea lo más específico posible." required class="area-texto"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="botonEnviar">
                        Confirmar Solicitud de Cita
                    </button>

                </div>
            </form>

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
<script src="assets/js/nuevaReserva.js"></script>
</body>
</html>
