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
                <a class="navbar-brand d-block mx-auto mx-md-0" href="/">
                    <img src="assets/img/logo.png" alt="Logo" class="logoIndex">
                </a>
                <ul class="d-flex list-unstyled justify-content-lg-end justify-content-md-center justify-content-center flex-wrap mb-0">
                    <li class="mx-2 my-1"><a href="/horarios" class="navLi">HORARIOS</a></li>
                    <li class="mx-2 my-1"><a href="#ubicacion" class="navLi">UBICACION</a></li>
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
<main class="contenedor-reservas">
    	          <?php
          include $_ENV['folder.views'] . '/templates/flash-messages.php';
          ?>

    <div class="row">
        <div class="col-12">
            
            <div class="textoCitasBoton">

                <h1 class="titulo">
                    <i class="far fa-calendar-alt"></i> Mis Citas y Reservas
                </h1>
                
                <a href="/nuevaReserva" class="boton-cita boton-principal" style="width: auto;">
                    <i class="fas fa-calendar-plus"></i> Solicitar Nueva Cita
                </a>

            </div>

            <p class="subtitulo">Aqui puedes revisar el estado y los detalles de tus citas</p>
            
            <div class="grid-citas">

               <section class="panel-lista-citas">
                    <h4>Próximas y Recientes</h4>

                    <?php if (empty($reservas)): ?>
                        <p class="text-center mt-3">No tienes reservas registradas.</p>
                    <?php else: ?>

                <?php $primera = true; ?>
               <?php foreach ($reservas as $reserva): ?>
                    <div class="card-cita"
                        id="cita<?php echo $reserva['id_reserva']; ?>"
                        onclick="seleccionarCita(this);"
                        data-estado="<?php echo $reserva['estado']; ?>"
                        data-vehiculo="<?php echo $reserva['marca'].' '.$reserva['modelo']; ?>"
                        data-matricula="<?php echo $reserva['matricula']; ?>"
                        data-fecha="<?php echo date('d/m/Y', strtotime($reserva['fecha_reserva'])); ?>"
                        data-hora="<?php echo date('H:i', strtotime($reserva['hora_reserva'])); ?>"
                        data-comentarios="<?php echo $reserva['comentariosReserva']; ?>">

                        <div class="info-cita">
                            <div class="fecha-hora-cita">
                                <i class="far fa-clock"></i>
                                <?php echo date("l, d F", strtotime($reserva['fecha_reserva'])); ?> — 
                                <?php echo date("H:i", strtotime($reserva['hora_reserva'])); ?>
                            </div>

                            <div class="detalle-servicio-cita">
                                Reserva programada | Vehículo:
                                <span>
                                    <?php echo htmlspecialchars($reserva['matricula']); ?> 
                                    (<?php echo htmlspecialchars($reserva['marca']); ?>)
                                </span>
                            </div>
                        </div>

                        <span class="etiqueta-estado <?php if ($reserva['estado'] === 'pendiente') {echo 'estado-pendiente';} elseif ($reserva['estado'] === 'confirmada') {echo 'estado-confirmada';
                                } elseif ($reserva['estado'] === 'rechazada') {echo 'estado-rechazada';} elseif ($reserva['estado'] === 'no_asistida') {echo 'estado-no_asistida';
                                } elseif ($reserva['estado'] === 'finalizada') {echo 'estado-finalizada';}
                            ?>">
                            <?php echo $reserva['estado']; ?>
                        </span>

                    </div>
                <?php endforeach; ?>



                <?php endif; ?>

            </section>


                <section class="panel-detalles">
                    <h4><i class="fas fa-info-circle"></i> Detalles de la Cita</h4>

                    <?php if (!empty($reservas)): ?>
                        <div class="secciones-panel">
                            <span class="etiqueta-detalle"><i class="fas fa-calendar-check"></i> Estado Actual</span>
                            <span class="valor-detalle" id="estado"><?php echo $reserva['estado']; ?></span>
                        </div>

                        <div class="secciones-panel">
                            <span class="etiqueta-detalle"><i class="fas fa-car"></i> Vehículo</span>
                            <span class="valor-detalle" id="vehiculo"><?php echo $reserva['marca'] . ' ' . $reserva['modelo']; ?></span>
                        </div>

                        <div class="secciones-panel">
                            <span class="etiqueta-detalle"><i class="fas fa-car"></i> Matrícula</span>
                            <span class="valor-detalle" id="matricula"><?php echo $reserva['matricula']; ?></span>
                        </div>

                        <div class="secciones-panel">
                            <span class="etiqueta-detalle"><i class="far fa-calendar-alt"></i> Día y Hora</span>
                            <span class="valor-detalle" id="fecha-hora">
                                <?php echo date("d/m/Y", strtotime($reserva['fecha_reserva'])); ?> a las <?php echo date("H:i", strtotime($reserva['hora_reserva'])); ?>
                            </span>
                        </div>

                        <div class="secciones-panel">
                            <span class="etiqueta-detalle"><i class="fas fa-map-marker-alt"></i> Ubicacion del Taller</span>
                            <span class="valor-detalle" id="localizacion">Salceda de Caselas</span>
                        </div>

                        <h5 class="notas-comentarios">Notas y Comentarios</h5>
                        <p class="texto-comentarios" id="comentarios"><?php echo $reserva['comentariosReserva'] ?: "Sin comentarios"; ?></p>

                        <div class="acciones-rapidas-bloque">
                            <h5>Acciones Rapidas</h5>
                            <form method="get">
                                <input type="hidden" name="id_reserva" value="<?php echo $reserva['id_reserva']; ?>">
                                <a href="/reservaCliente/delete/<?php echo $reserva['id_reserva']?>" class="boton-cita boton-peligro-outline">
                                    <i class="fas fa-times-circle"></i> Cancelar Cita
                                </a>
                            </form>
                            <small class="aviso-cancelacion">
                                Las cancelaciones deben hacerse con 24h de antelación.
                            </small>
                        </div>

                    <?php else: ?>
                        <p>No hay detalles disponibles.</p>
                    <?php endif; ?>

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
<script src="assets/js/reservaCliente.js"></script>
</body>
</html>
