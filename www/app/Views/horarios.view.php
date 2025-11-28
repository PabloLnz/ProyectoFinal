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

    <style>
        .horarios-main {
            position: relative;
            min-height: calc(100vh - 85px - 340px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
            overflow: hidden;
            background-color: #0d1a29;
        }

        .horarios-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url();
            background-size: cover;
            background-position: center;
            opacity: 0.25;
            z-index: 1;
        }

        .horarios-container {
            position: relative;
            z-index: 2;
            background-color: rgba(0, 28, 63, 0.7);
            padding: 30px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
            max-width: 800px;
            width: 90%;
            text-align: center;
            border: 1px solid rgba(0, 123, 255, 0.3);
            animation: tablaInicio 0.8s ease-out;
        }

        @keyframes tablaInicio {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .horarios-container h2 {
            font-size: 1.8rem;
            color: #ffffff;
            margin-bottom: 8px;
            font-weight: 700;
            border-bottom: 3px solid #007bff;
            display: inline-block;
            padding-bottom: 5px;
        }

        .horarios-container .info-texto {
            color: #cccccc;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .horarios-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 1.1rem;
        }

        .horarios-table th,
        .horarios-table td {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .horarios-table th {
            background-color: rgba(0, 123, 255, 0.1);
            color: #007bff;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .horarios-table td {
            color: #f4f4f4;
            background-color: rgba(255, 255, 255, 0.01);
        }

        .horarios-table tr:nth-child(even) td {
            background-color: rgba(255, 255, 255, 0.03);
        }

        .horarios-table tr:hover td {
            background-color: rgba(0, 123, 255, 0.25);
            transition: background-color 0.3s ease;
        }

        .horarios-table td:first-child {
            color: #ffffff;
            font-weight: 700;
        }


        @media (max-width: 600px) {
            .horarios-container {
                padding: 30px 20px;
            }
            .horarios-table th,
            .horarios-table td {
                padding: 12px 15px;
                font-size: 0.9rem;
            }
            .horarios-table th {
                font-size: 0.8rem;
            }
            .info-texto {
                display: none;
            }
        }
    </style>
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
                    <li><a href="/horarios" class="navLi">HORARIOS</a></li>
                    <li><a href="#" class="navLi">UBICACION</a></li>
                    <li><a href="#" class="navLi">TALLER</a></li>
                    <li><a href="#" class="navLi">SOBRE NOSOTROS</a></li>
                    <li><a href="#" class="navLi">HISTORIAL</a></li>
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
