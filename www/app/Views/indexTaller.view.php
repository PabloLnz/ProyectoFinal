<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galician Motors | Gestión de Empleados</title>

    <!-- ADMINLTE Y FONT AWESOME (CDN) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- ESTILOS PERSONALIZADOS -->
    <style>
        html, body {
            height: 100%;
        }
        
        .ajuste-logo {
            margin-right: 8px; 
        }
        
        .main-sidebar .brand-link {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        /* footer respecto al aside */
        .footer-IndexTaller {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 250px; 
            height: 60px;
            width: calc(100% - 250px);
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: .5rem 1rem;
            box-shadow: 0 -1px 0 rgba(0,0,0,0.03);
            transition: left 300ms ease, width 300ms ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .content-wrapper {
            padding-bottom: calc(60px + 1rem) !important;
            transition: margin-left 300ms ease;
        }

        /* Cambia footer segun aside */
        @media (min-width: 992px) {
            body.sidebar-collapse .footer-IndexTaller {
                left: 74px; 
                width: calc(100% - 74px);
            }
        }

        /* footer al 100%*/
        @media (max-width: 991.98px) {
            .footer-IndexTaller {
                left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-footer-fixed">
<!--WRRAPER-->
<div class="wrapper">

    <header class="main-header-wrapper">
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark" role="navigation">
        <ul class="navbar-nav">
            <li class="nav-item">
                <!-- Boton aside -->
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <span class="navbar-brand">
                    <i class="fas fa-wrench brand-icon ajuste-logo"></i> Galician Motors
                </span>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Nombre y cerrar sesion -->
            <li class="nav-item">
                <span class="nav-link">Bienvenido sdfsdf</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" title="Cerrar Sesión">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    </header>

    <!-- ASIDE -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <i class="fas fa-car-alt brand-image img-circle elevation-3" style="opacity: 0.8"></i>
            <span class="brand-text font-weight-light">Galician Motors</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Empleados</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-car-side"></i>
                            <p>Vehhiculos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>Reservas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>Facturacion</p>
                        </a>
                    </li>
                    <li class="nav-header">OPCIONES</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                            <p>Cerrar Sesion</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="content-wrapper" role="main">
        <!-- Título y Breadcrumb -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><i class="fas fa-users-cog mr-2 text-primary"></i> Trabajadores Activos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista empl temp-->
        <section class="content">
            <div class="container-fluid">
                <p class="lead text-secondary">Listado del personal de taller actualmente operativo.</p>

                <div class="row">
                    <!--EMPLEADO 1-->
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card cards-empleados h-100 border-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">Juan Perez</h5>
                                <div class="mx-auto my-4">
                                    <i class="fas fa-user-circle fa-4x text-secondary"></i>
                                </div>
                                <p class="card-text text-muted">Gerente</p>
                                <span class="badge bg-success"><i class="fas fa-check-circle mr-1"></i> Disponible</span>
                            </div>
                            <div class="card-footer bg-light">
                                <small class="text-muted"><i class="fas fa-envelope mr-1"></i> juan.perez@galicianmotors.es</small>
                            </div>
                        </div>
                    </div>

                    <!--EMPLEADO 1-->
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card cards-empleados h-100 border-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">Maria Lopez</h5>
                                <div class="mx-auto my-4">
                                    <i class="fas fa-user-circle fa-4x text-secondary"></i>
                                </div>
                                <p class="card-text text-muted">Empleado</p>
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock mr-1"></i> En servicio</span>
                            </div>
                            <div class="card-footer bg-light">
                                <small class="text-muted"><i class="fas fa-envelope mr-1"></i> maria.lopez@galicianmotors.es</small>
                            </div>
                        </div>
                    </div>
                    
                    <!--EMPLEADO 3-->
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card cards-empleados h-100 border-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">ASDAS AFdsf</h5>
                                <div class="mx-auto my-4">
                                    <i class="fas fa-user-circle fa-4x text-secondary"></i>
                                </div>
                                <p class="card-text text-muted">Especialista en Analisis</p>
                                <span class="badge bg-success"><i class="fas fa-check-circle mr-1"></i> Disponible</span>
                            </div>
                            <div class="card-footer bg-light">
                                <small class="text-muted"><i class="fas fa-envelope mr-1"></i> asda.asd@galicianmotors.es</small>
                            </div>
                        </div>
                    </div>

                    <!--EMPLEADO 4-->
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card cards-empleados h-100 border-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">dsdfwsfsdf Asfdasdf</h5>
                                <div class="mx-auto my-4">
                                    <i class="fas fa-user-circle fa-4x text-secondary"></i>
                                </div>
                                <p class="card-text text-muted">Empleado</p>
                            <span class="badge bg-danger text-dark"><i class="fas fa-ban mr-1"></i> Ocupaod</span> 
                            </div>
                            <div class="card-footer bg-light">
                                <small class="text-muted"><i class="fas fa-envelope mr-1"></i> sdfsdfsfsdf.sdfsdfsdf@galicianmotors.es</small>
                            </div>
                        </div>
                    </div>
                     <!--EMPLEADO 5-->
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card cards-empleados h-100 border-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">dsdfwsfewrwersdf Asfdasdf</h5>
                                <div class="mx-auto my-4">
                                    <i class="fas fa-user-circle fa-4x text-secondary"></i>
                                </div>
                                <p class="card-text text-muted">Empleado</p>
                            <span class="badge bg-danger text-dark"><i class="fas fa-ban mr-1"></i> Ocupaod</span> 
                            </div>
                            <div class="card-footer bg-light">
                                <small class="text-muted"><i class="fas fa-envelope mr-1"></i> sdfsdfsfsdf.sdfsdfsdf@galicianmotors.es</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="footer-IndexTaller" role="contentinfo">
        <div>
            <strong>Copyright &copy; 2024 Galician Motors.</strong>
            <span class="ml-2">Todos los derechos reservados.</span>
        </div>

        <div class="d-none d-sm-inline-block">
            <b>Fecha:</b>34234234
        </div>
    </footer>

</div>


<!--SCRIPTS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
