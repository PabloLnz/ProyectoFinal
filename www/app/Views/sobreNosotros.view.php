<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galician Motors</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
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
    <link rel="stylesheet" href="assets/css/sobreNosotros.css">
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


    <main class="main">

        <section class="portada">
            <div class="portada-fondo"></div>
            <div class="portada-caja">
                <h1>Galician Motors: Pasión por BMW en Galicia</h1>
            </div>
        </section>

        <section class="seccion">
            <h2 class="titulo">Nuestra Historia</h2>
            <div class="texto">
                <p>
                    Galician Motors no es solo un taller. Es el resultado de años currando con BMW y pillándole cariño a la marca. Empezamos porque aquí en Galicia no encontrábamos un sitio donde trataran estos coches como se merecen.
                </p>
                <p>
                    Desde el principio hemos tenido claro lo que queríamos: ser el sitio de confianza para tu BMW. Todo el equipo está formado en lo último de la marca, usamos herramientas oficiales y siempre recambios originales. Queremos que tu coche vaya fino como el primer día.
                </p>
            </div>
        </section>

        <section class="seccion">
            <h2 class="titulo">Nuestros Valores</h2>
            <div class="cards-contenedor">

                <article class="card">
                    <i class="fas fa-certificate icono"></i>
                    <h3 class="card-titulo">Piezas Oficiales</h3>
                    <p>Solo trabajamos con piezas y procesos oficiales BMW. Más garantía, más vida para tu coche.</p>
                </article>

                <article class="card">
                    <i class="fas fa-chart-line icono"></i>
                    <h3 class="card-titulo">Transparencia</h3>
                    <p>Sin sorpresas. Te explicamos lo que hay que hacer, el porqué, y te damos presupuesto antes de tocar nada.</p>
                </article>

                <article class="card">
                    <i class="fas fa-microchip icono"></i>
                    <h3 class="card-titulo">Tecnología Actual</h3>
                    <p>Tenemos las herramientas y el software más moderno para cualquier BMW, desde mantenimiento a electrónica.</p>
                </article>

            </div>
        </section>

        <section class="cita">
            <div class="contenedor-cita">
                <h2 class="titulo titulo-cita">¿Quieres un servicio como toca?</h2>
                <p>
                    Si buscas cercanía, piezas originales y un equipo que conoce BMW al detalle, este es tu sitio.
                </p>
                <a href="/reservaCliente" class="boton-cita">
                    PEDIR CITA
                </a>
            </div>
        </section>

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
</body>
</html>












