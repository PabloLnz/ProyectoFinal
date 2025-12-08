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
    <link rel="stylesheet" href="assets/css/horarios.css">
</head>
<body class="hold-transition">
<div class="wrapper">
    <!-- Header con Navbar -->
    <header id="mainHeader">
        <div class="container-fluid">
            <nav class="navbar">
                <a class="navbar-brand d-block mx-auto mx-md-0" href="/">
                    <img src="assets/img/logo.png" alt="Logo" class="logoIndex">
                </a>
                <ul class="d-flex list-unstyled justify-content-lg-end justify-content-md-center justify-content-center flex-wrap mb-0">
                    <li class="mx-2 my-1"><a href="/horarios" class="navLi">HORARIOS</a></li>
                    <li class="mx-2 my-1"><a href="/#ubicacion" class="navLi">UBICACION</a></li>
                    <li class="mx-2 my-1"><a href="/sobreNosotros" class="navLi">SOBRE NOSOTROS</a></li>
                    <li class="mx-2 my-1"><a href="/facturasCliente" class="navLi">FACTURAS</a></li>
                    <li class="mx-2 my-1"><a href="/reservaCliente" class="navLi">RESERVAS</a></li>
                    <?php
                    if (isset($_SESSION['datosUsuario'])):
                        ?>
                        <li class="mx-2 my-1">
                            <a href="/logout" class="navLi linkLogout" title="Cerrar Sesión">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="mx-2 my-1"><a href="/login" class="linkLogin">LOGIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>


    <!-- MAIN -->


    <main class="horarios-main">
        <div class="horarios-background"></div>

        <div class="horarios-container">
            <h2>Horario de Servicio Técnico</h2>

            <p class="info-texto">Le rogamos que pida cita previa para garantizar la mejor atencion.</p>

            <table class="horarios-table">
                <thead>
                <tr>
                    <th>Día</th>
                    <th>Horario de Taller</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Lunes</td>
                    <td>10:00 - 20:00</td>
                </tr>
                <tr>
                    <td>Martes</td>
                    <td>10:00 - 20:00</td>
                </tr>
                <tr>
                    <td>Miércoles</td>
                    <td>10:00 - 20:00</td>
                </tr>
                <tr>
                    <td>Jueves</td>
                    <td>10:00 - 20:00</td>
                </tr>
                <tr>
                    <td>Viernes</td>
                    <td>10:00 - 20:00</td>
                </tr>
                <tr>
                    <td>Sábado</td>
                    <td>10:00 - 20:00</td>
                </tr>
                <tr>
                    <td>Domingo</td>
                    <td>10:00 - 20:00</td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>




    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-container">

            <div class="footer-col footer-info">
                <h3 class="footer-logo">Galician Motors</h3>
                <p>Especialistas en la marca. Servicio de calidad garantizado en Salceda de Caselas.</p>
                <p>
                    📞 <a href=""> XX XXX XX XX</a><br>
                    ✉️ <a href="">gMotors@galicianmotors.com</a>
                </p>
            </div>

            <div class="footer-col">
                <h4>Visítanos</h4>
                <p>
                    Pontevedra<br>
                    Salceda de Caselas
                </p>
                <div class="social-links">
                    <a href="#" target="_blank" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" target="_blank" title="Twitter/X">
                        <i class="fab fa-twitter"></i>
                    </a>
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
<!-- Scripts necesarios -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="assets/js/adminlte.min.js"></script>
<script src="assets/js/pages/main.js"></script>
<script src="assets/js/index.js"></script>
<script
</body>
</html>
