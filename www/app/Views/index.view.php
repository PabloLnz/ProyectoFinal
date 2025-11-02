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
    <link rel="stylesheet" href="assets/css/index.css">
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
                    <li><a href="#" class="navLi">RESERVAS</a></li>
                    <li><a href="/login" class="linkLogin">LOGIN</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <!-- MAIN -->

    <main>
        <!-- IMAGEN PRINCIPAL Y CONTENIDO -->
        <section>
            <img src="assets/img/imagenPrincipal3.png" alt="Imagen principal" style="width: 100%; height: auto;">

            <article class="texto-superpuesto">
                <h1 style="font-size:2vw; font-weight:bolder">Servicio BMW</h1>
                <div>
                    <span>SERVICIO OFICIAL BMW</span>
                    <span>SITUADO EN GALICIA</span>
                    <span>CALIDAD Y CONFIANZA</span>
                    <a href="#" class="btn btn-primary mt-3">Pedir cita</a>
                </div>
            </article>
        </section>
        <!-- IMAGENES CUADRUPLES -->
        <section class="gridIndex">
            <!-- ARTICULO 1 -->
            <article>
                <img src="assets/img/mantenimientoReparacion.png" alt="Mantenimiento y reparación" class="imgDetalles">
                <h3>MANTENIMIENTO Y REPARACIÓN</h3>
                <p>Confía en nuestro equipo especializado para realizar el mantenimiento completo y las reparaciones necesarias de tu BMW, siempre con la máxima calidad y garantía oficial.</p>
            </article>

            <!-- ARTICULO 2 -->
            <article>
                <img src="assets/img/diagnosticoAvanzado.png" alt="Diagnóstico avanzado" class="imgDetalles">
                <h3>DIAGNÓSTICO AVANZADO</h3>
                <p>Con la última tecnología de diagnóstico, detectamos cualquier incidencia en tu vehículo BMW antes de que se convierta en un problema mayor, garantizando siempre seguridad y fiabilidad.</p>
            </article>

            <!-- ARTICULO 3 -->
            <article>
                <img src="assets/img/recambiosOriginales.png" alt="Piezas originales BMW" class="imgDetalles">
                <h3>PIEZAS ORIGINALES BMW</h3>
                <p>Utilizamos exclusivamente piezas originales BMW, asegurando la máxima calidad, durabilidad y el perfecto ajuste para que tu vehículo conserve siempre su valor y rendimiento.</p>
            </article>

            <!-- ARTICULO 4 -->
            <article>
                <img src="assets/img/servicioPersonalizado.png" alt="Servicio personalizado" class="imgDetalles">
                <h3>SERVICIO PERSONALIZADO</h3>
                <p>Ofrece>os un trato cercano y adaptado a cada cliente, con asesores especializados que te acompañarán en cada paso para que disfrutes de una experiencia única al cuidar de tu BMW.</p>
            </article>
        </section>

        <section id="ubicacion">
            <article class="contenido-mapa">

                <h2 class="titulo-mapa">
                    📍 ¡Encuéntranos en el Mapa!
                </h2>

                <div class="map-container">
                    <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.644585318283!2d-3.703790584604726!3d40.41677597936568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42288cf274b4b3%3A0x1f5d91bfbabf9a6!2sMadrid!5e0!3m2!1ses!2ses!4v1696614581593!5m2!1ses!2ses"
                            width="100%"
                            height="450"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>

                <p class="map-info-text">
                    Haz clic en el mapa para explorar y obtener indicaciones.
                </p>

            </article>
        </section>
        <!--VALORES E IMAGEN BMW TRANSPARENTE -->
        <section class="descripcion">
            <img src="assets/img/descripcion4.png" alt="Imagen principal" class="imagen-descripcion">
            <article class="texto-superpuesto-descripcion">
                <div>
                    <p>En nuestro taller BMW ofrecemos un servicio integral que abarca desde el mantenimiento preventivo hasta las reparaciones más avanzadas, garantizando siempre la máxima calidad y precisión.</p>
                    <p>Contamos con un equipo de profesionales altamente cualificados y formados por BMW, que utilizan herramientas de última generación y recambios originales para asegurar que tu vehículo reciba el cuidado que merece.</p>
                </div>
            </article>
        </section>
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
</body>
</html>
