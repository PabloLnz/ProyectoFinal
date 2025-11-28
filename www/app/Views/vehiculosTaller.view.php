<main class="content-wrapper p-4">
    <?php include $_ENV['folder.views'] . '/templates/flash-messages.php'; ?>

    <div class="container-fluid">
        <h2 class="mb-4 text-dark font-weight-bold">
            <i class="fas fa-car-side text-info mr-2"></i> Gestión de Vehículos
        </h2>

        <div class="row">
            <?php if (!empty($vehiculos)) { ?>
                <?php foreach ($vehiculos as $vehiculo) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card card-outline shadow-lg" style="border-left: 5px solid 
                            <?php 
                                if ($vehiculo['estado_vehiculo'] === 'pendiente') { echo '#ffc107'; } 
                                elseif ($vehiculo['estado_vehiculo'] === 'finalizado') { echo '#28a745'; } 
                                else { echo '#6c757d'; } 
                            ?>;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="mb-0 text-dark font-weight-bolder"><?php echo htmlspecialchars($vehiculo['matricula']); ?></h4>
                                    <span class="badge font-weight-bold p-2 
                                        <?php if ($vehiculo['estado_vehiculo'] === 'pendiente') { echo 'badge-warning text-dark'; } 
                                        elseif ($vehiculo['estado_vehiculo'] === 'finalizado') { echo 'badge-success'; } 
                                        else { echo 'badge-secondary'; } ?>">
                                        <i class="fas 
                                            <?php if ($vehiculo['estado_vehiculo'] === 'pendiente') { echo 'fa-exclamation-triangle'; } 
                                            elseif ($vehiculo['estado_vehiculo'] === 'finalizado') { echo 'fa-check-circle'; } 
                                            else { echo 'fa-question-circle'; } ?> mr-1"></i>
                                        <?php echo strtoupper($vehiculo['estado_vehiculo']); ?>
                                    </span>
                                </div>

                                <hr class="mt-0 mb-3">

                                <div class="text-sm">
                                    <p class="mb-2 font-weight-bold">
                                        <i class="fas fa-user mr-2 text-secondary"></i>
                                        Cliente: <span class="font-weight-normal"><?php echo htmlspecialchars($vehiculo['cliente_nombre']); ?></span>
                                    </p>
                                    <p class="mb-2 font-weight-bold">
                                        <i class="fas fa-phone mr-2 text-secondary"></i>
                                        Tel: <span class="font-weight-normal"><?php echo htmlspecialchars($vehiculo['cliente_telefono']); ?></span>
                                    </p>
                                    <p class="mb-2 font-weight-bold">
                                        <i class="fas fa-envelope mr-2 text-secondary"></i>
                                        Email: <span class="font-weight-normal"><?php echo htmlspecialchars($vehiculo['cliente_email']); ?></span>
                                    </p>
                                    <p class="mb-2 font-weight-bold">
                                        <i class="fas fa-map-marker-alt mr-2 text-secondary"></i>
                                        Dirección: <span class="font-weight-normal"><?php echo htmlspecialchars($vehiculo['cliente_direccion']); ?></span>
                                    </p>

                                    <p class="mb-2 font-weight-bold">
                                        <i class="far fa-calendar-alt mr-2 text-secondary"></i>
                                        Entrada: 
                                        <span class="font-weight-normal">
                                            <?php echo !empty($vehiculo['reparacion_inicio']) ? htmlspecialchars($vehiculo['reparacion_inicio']) : htmlspecialchars($vehiculo['fecha_reserva']); ?>
                                        </span>
                                    </p>
                                    <p class="mb-2 font-weight-bold">
                                        <i class="fas fa-shipping-fast mr-2 text-secondary"></i>
                                        Salida: 
                                        <span class="font-weight-normal">
                                            <?php echo !empty($vehiculo['reparacion_fin']) ? htmlspecialchars($vehiculo['reparacion_fin']) : '---'; ?>
                                        </span>
                                    </p>

                                    <p class="mt-3 mb-3 text-lg font-weight-bolder text-primary">
                                        <i class="fas fa-euro-sign mr-2"></i>
                                        Coste: 
                                        <span class="font-weight-bolder">
                                            <?php echo !empty($vehiculo['coste_reparacion']) ? number_format($vehiculo['coste_reparacion'], 2, ',', '.') . ' €' : '---'; ?>
                                        </span>
                                    </p>

                                    <p class="text-muted mt-3 mb-0 font-weight-bold">
                                        <i class="fas fa-wrench mr-2 text-secondary"></i>
                                        Reparación: <span class="font-weight-normal">
                                            <?php echo !empty($vehiculo['reparacion_fin']) ? $vehiculo['comentariosReserva'] : 'Sin comentarios / Revision general'; ?>
                                        </span>
                                    </p>
                                </div>

                                <div class="mt-4 pt-3 border-top">
                                    <a href="/vehiculos/gestionVehiculo/<?php echo $vehiculo['id_vehiculo']; ?>" class="btn btn-sm btn-outline-<?php echo $vehiculo['estado_vehiculo'] === 'finalizado' ? 'success' : ($vehiculo['estado_vehiculo'] === 'pendiente' ? 'warning text-dark' : 'info'); ?> btn-block font-weight-bold shadow-sm">
                                        <i class="fas <?php echo $vehiculo['estado_vehiculo'] === 'finalizado' ? 'fa-eye' : 'fa-edit'; ?> mr-1"></i>
                                        <?php echo $vehiculo['estado_vehiculo'] === 'finalizado' ? 'Ver Historial' : 'Gestionar Vehículo'; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        No hay vehículos registrados en este momento.
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
