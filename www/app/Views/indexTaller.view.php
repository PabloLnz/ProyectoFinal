
    <!-- MAIN -->
    <main class="content-wrapper" role="main">
        	          <?php
          include $_ENV['folder.views'] . '/templates/flash-messages.php';
          ?>

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


    
</div>

</body>
</html>
