<main class="content-wrapper p-4">
    <?php include $_ENV['folder.views'] . '/templates/flash-messages.php'; ?>

    <div class="container-fluid">

        <h2 class="mb-4 text-dark font-weight-bold d-flex align-items-center flex-nowrap h5 h2-sm">
            <i class="fas fa-car-side text-info mr-2 mr-sm-3 fa-lg fa-2x"></i>
            <span class="d-none d-sm-inline">Gestión del Vehículo:</span>
            <span class="d-sm-none">Vehículo:</span>
            <span class="ml-2 text-primary text-truncate font-weight-bolder" style="max-width: 50%;">
            <?php echo htmlspecialchars($vehiculo['matricula']); ?>
        </span>
        </h2>
        <p class="text-muted">Detalles y registro de actividad para el vehículo.</p>

        <div class="row">

            <div class="col-lg-8">

                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title font-weight-bold">Detalles Principales</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="matricula">Matrícula</label>
                                <input type="text" class="form-control font-weight-bold" 
                                       value="<?php echo htmlspecialchars($vehiculo['matricula']); ?>" 
                                       readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cliente_nombre"><i class="fas fa-user mr-1"></i> Cliente Asociado</label>
                                <input type="text" class="form-control" 
                                       value="<?php echo htmlspecialchars($vehiculo['cliente_nombre']); ?>" 
                                       readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label>Marca</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($vehiculo['marca']); ?>" readonly>
                            </div>
                            <div class="form-group col-md-5">
                                <label>Modelo</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($vehiculo['modelo']); ?>" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Año</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($vehiculo['anyo']); ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-lg card-info mt-4">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold"><i class="fas fa-tools mr-1"></i> Piezas Utilizadas</h3>
                    </div>
                    <div class="card-body">

                        <?php if($vehiculo['estado_vehiculo'] !== 'finalizado'): ?>
                            <h5 class="font-weight-bold text-info mb-3">Añadir Pieza</h5>
                            <form action="/vehiculos/gestionVehiculo/agregar-pieza/<?php echo $vehiculo['id_vehiculo']; ?>" method="post" class="form-inline mb-3">
                                <div class="form-group mr-2 mb-2">
                                    <select name="id_pieza" class="form-control" required>
                                        <option value="">Buscar o seleccionar...</option>
                                        <?php foreach ($piezas as $pieza) { ?>
                                            <option value="<?php echo $pieza['id_pieza']; ?>">
                                                <?php echo htmlspecialchars($pieza['nombre']) . ' (Stock: ' . htmlspecialchars($pieza['stock']) . ')'; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mr-2 mb-2">
                                    <input type="number" name="cantidad" class="form-control" value="1" min="1" required>
                                </div>
                                <button type="submit" class="btn btn-success mb-2"><i class="fas fa-plus mr-1"></i> Añadir</button>
                            </form>
                        <?php endif; ?>

                        <hr class="my-4">
                        <h5 class="font-weight-bold text-info mb-3">Listado de Piezas</h5>

                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                <tr>
                                    <th class="d-none d-sm-table-cell">#</th>
                                    <th class="text-nowrap">Nombre / Código</th>
                                    <th class="text-center">Cant.</th>
                                    <th class="text-right d-none d-sm-table-cell">Precio U.</th>
                                    <th class="text-right">Subtotal</th>
                                    <th class="d-none d-sm-table-cell"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $totalPiezas = 0;
                                foreach ($piezasUsadas as $index => $p) {
                                    $subtotal = $p['cantidad'] * $p['precio_pieza_reparacion'];
                                    $totalPiezas += $subtotal;
                                    ?>
                                    <tr>
                                        <td class="d-none d-sm-table-cell"><?php echo $index + 1; ?></td>

                                        <td><?php echo htmlspecialchars($p['nombre']); ?><br><small class="text-muted"><?php echo htmlspecialchars($p['codigo']); ?></small></td>

                                        <td class="text-center"><?php echo htmlspecialchars($p['cantidad']); ?></td>

                                        <td class="text-right d-none d-sm-table-cell"><?php echo number_format($p['precio_pieza_reparacion'], 2, ',', '.'); ?> €</td>

                                        <td class="text-right"><?php echo number_format($subtotal, 2, ',', '.'); ?> €</td>

                                        <td class="text-center d-none d-sm-table-cell">
                                            <?php if($vehiculo['estado_vehiculo'] !== 'finalizado'): ?>
                                                <form action="/vehiculos/gestionVehiculo/eliminar-pieza/<?php echo $p['id_reparacion_pieza']; ?>/<?php echo $vehiculo['id_vehiculo']; ?>" method="post">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-muted">Finalizado</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="text-right font-weight-bold d-sm-none">Total:</td>
                                    <td colspan="4" class="text-right font-weight-bold d-none d-sm-table-cell">Total Piezas:</td>

                                    <td class="text-right font-weight-bolder text-lg text-primary"><?php echo number_format($totalPiezas, 2, ',', '.'); ?> €</td>
                                    <td class="d-none d-sm-table-cell"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-lg card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">Estado del Vehículo</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <span class="badge <?php echo $vehiculo['estado_vehiculo'] === 'pendiente' ? 'badge-warning text-dark' : 'badge-success'; ?> font-weight-bold p-3 text-lg rounded-pill shadow">
                                <i class="fas <?php echo $vehiculo['estado_vehiculo'] === 'pendiente' ? 'fa-exclamation-triangle' : 'fa-check-circle'; ?> mr-2"></i>
                                <?php echo strtoupper($vehiculo['estado_vehiculo']); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <?php if(!empty($comentario)): ?>
                    <div class="card shadow-lg card-secondary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Comentario de la Reparación</h3>
                        </div>
                        <div class="card-body">
                            <p><?php echo nl2br(htmlspecialchars($comentario)); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($vehiculo['estado_vehiculo'] !== 'finalizado'): ?>
                    <div class="card card-secondary shadow-lg card-outline mt-4">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Acciones Rápidas</h3>
                        </div>
                        <div class="card-body">
                            <form action="/vehiculos/gestionVehiculo/factura/<?php echo $vehiculo['id_vehiculo']; ?>" method="post">
                                <div class="form-group">
                                    <label for="comentario">Comentario para la factura</label>
                                    <textarea name="comentario" id="comentario" class="form-control" rows="3" placeholder="Ej: Se cambiaron las ruedas, aceite y filtros"></textarea>
                                </div>
                                <button type="submit" class="btn btn-info btn-block mb-2">
                                    <i class="fas fa-file-invoice mr-1"></i> Generar Factura
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</main>
