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
                <?php if (!empty($trabajadores)): ?>
                    <?php foreach ($trabajadores as $trabajador): ?>
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                            <div class="card cards-empleados h-100 border-primary">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-primary"><?php echo htmlspecialchars($trabajador['nombre']); ?></h5>
                                    <div class="mx-auto my-4">
                                        <i class="fas fa-user-circle fa-4x text-secondary"></i>
                                    </div>
                                    <p class="card-text text-muted"><?php echo htmlspecialchars($trabajador['nombre_rol']); ?></p>
                                    
                                    <span class="badge 
                                        <?php if ($trabajador['disponibilidad'] === 'disponible'): ?>bg-success 
                                        <?php elseif ($trabajador['disponibilidad'] === 'en servicio'): ?>bg-warning text-dark 
                                        <?php elseif ($trabajador['disponibilidad'] === 'indispuesto'): ?>bg-danger 
                                        <?php else: ?>bg-secondary<?php endif; ?>">
                                        
                                        <?php if ($trabajador['disponibilidad'] === 'disponible'): ?>
                                            <i class="fas fa-check-circle mr-1"></i> Disponible
                                        <?php elseif ($trabajador['disponibilidad'] === 'en servicio'): ?>
                                            <i class="fas fa-clock mr-1"></i> En servicio
                                        <?php elseif ($trabajador['disponibilidad'] === 'indispuesto'): ?>
                                            <i class="fas fa-ban mr-1"></i> Indispuesto
                                        <?php else: ?>
                                            <i class="fas fa-question-circle mr-1"></i> Desconocido
                                        <?php endif; ?>
                                    </span>

                                    <form method="get" action="/indexTaller/cambiar-disponibilidad/<?php echo $trabajador['id_usuario']?>" class="mt-3">
                                        <select name="disponibilidad" class="form-control form-control-sm mb-2">
                                            <option value="disponible" <?php if ($trabajador['disponibilidad'] === 'disponible') echo 'selected'; ?>>Disponible</option>
                                            <option value="en servicio" <?php if ($trabajador['disponibilidad'] === 'en servicio') echo 'selected'; ?>>En servicio</option>
                                            <option value="indispuesto" <?php if ($trabajador['disponibilidad'] === 'indispuesto') echo 'selected'; ?>>Indispuesto</option>
                                        </select>

                                        <button type="submit" class="btn btn-primary btn-sm btn-block">
                                            <i class="fas fa-sync-alt mr-1"></i> Actualizar
                                        </button>
                                    </form>

                                </div>

                                <div class="card-footer bg-light">
                                    <small class="text-muted">
                                        <i class="fas fa-envelope mr-1"></i> <?php echo htmlspecialchars($trabajador['email']); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info">
                            No hay trabajadores activos registrados en este momento.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

</div>

</body>
</html>
