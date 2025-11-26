<main class="content-wrapper p-4">
    <?php include $_ENV['folder.views'] . '/templates/flash-messages.php'; ?>

    <div class="container-fluid">

        <h2 class="mb-4 text-dark font-weight-bold d-flex align-items-center">
            <i class="fas fa-car-side text-info mr-3 fa-2x"></i>
            Gestión del Vehículo: 
            <span class="ml-2 text-primary"><?php echo htmlspecialchars($vehiculo['matricula']); ?></span>
        </h2>
        <p class="text-muted">Detalles y registro de actividad para el vehículo.</p>

        <form action="/vehiculos/actualizar" method="POST">
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
                                    <input type="text" class="form-control font-weight-bold" id="matricula" name="matricula" 
                                           value="<?php echo htmlspecialchars($vehiculo['matricula']); ?>" 
                                           readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cliente_nombre"><i class="fas fa-user mr-1"></i> Cliente Asociado</label>
                                    <input type="text" class="form-control" id="cliente_nombre" 
                                           value="<?php echo htmlspecialchars($vehiculo['cliente_nombre']); ?>" 
                                           readonly>
                                    <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($vehiculo['id_cliente']); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="marca">Marca</label>
                                    <input type="text" class="form-control" id="marca" name="marca" 
                                           value="<?php echo htmlspecialchars($vehiculo['marca']); ?>" readonly>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" 
                                           value="<?php echo htmlspecialchars($vehiculo['modelo']); ?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="anyo">Año</label>
                                    <input type="text" class="form-control" id="anyo" name="anyo" 
                                           value="<?php echo htmlspecialchars($vehiculo['anyo']); ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Guardar (General)
                            </button>
                        </div>
                    </div>

                    <div class="card shadow-lg card-info">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold"><i class="fas fa-tools mr-1"></i> Piezas Utilizadas en la Reparación</h3>
                        </div>
                        <div class="card-body">
                            
                            <h5 class="font-weight-bold text-info mb-3">Añadir Pieza</h5>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="pieza_seleccionada">Seleccionar Pieza</label>
                                    <select class="form-control" id="pieza_seleccionada" name="id_pieza">
                                        <option value="">Buscar o seleccionar...</option>
                                        <?php foreach ($piezas as $pieza) { ?>
                                            <option value="<?php echo $pieza['id_pieza']; ?>">
                                                <?php echo htmlspecialchars($pieza['id_pieza']) . '. ' . htmlspecialchars($pieza['nombre']) . ' (Stock: ' . htmlspecialchars($pieza['stock']) . ')'; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cantidad_pieza">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad_pieza" name="cantidad" value="1" min="1" required>
                                </div>
                                <div class="form-group col-md-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-success btn-block">
                                        <i class="fas fa-plus mr-1"></i> Añadir
                                    </button>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="font-weight-bold text-info mb-3">Listado de Piezas (Reparación Actual)</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre / Código</th>
                                            <th class="text-center">Cant.</th>
                                            <th class="text-right">Precio U.</th>
                                            <th class="text-right">Subtotal</th>
                                            <th></th>
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
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo htmlspecialchars($p['nombre']) . ' <br><small class="text-muted">' . htmlspecialchars($p['codigo']) . '</small>'; ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($p['cantidad']); ?></td>
                                                <td class="text-right"><?php echo number_format($p['precio_pieza_reparacion'], 2, ',', '.'); ?> €</td>
                                                <td class="text-right"><?php echo number_format($subtotal, 2, ',', '.'); ?> €</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="4" class="text-right font-weight-bold">Total Piezas:</td>
                                            <td class="text-right font-weight-bolder text-lg text-primary"><?php echo number_format($totalPiezas, 2, ',', '.'); ?> €</td>
                                            <td></td>
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
                                <span class="badge 
                                    <?php 
                                        if ($vehiculo['estado_vehiculo'] === 'pendiente') { 
                                            echo 'badge-warning text-dark'; 
                                        } elseif ($vehiculo['estado_vehiculo'] === 'finalizado') { 
                                            echo 'badge-success'; 
                                        } else { 
                                            echo 'badge-secondary'; 
                                        } 
                                    ?> font-weight-bold p-3 text-lg rounded-pill shadow">
                                    <i class="fas 
                                        <?php 
                                            if ($vehiculo['estado_vehiculo'] === 'pendiente') { 
                                                echo 'fa-exclamation-triangle'; 
                                            } elseif ($vehiculo['estado_vehiculo'] === 'finalizado') { 
                                                echo 'fa-check-circle'; 
                                            } else { 
                                                echo 'fa-question-circle'; 
                                            } 
                                        ?> mr-2"></i> 
                                    <?php echo strtoupper($vehiculo['estado_vehiculo']); ?>
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <label for="estado">Cambiar Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="pendiente" <?php if ($vehiculo['estado_vehiculo'] === 'pendiente') echo 'selected'; ?>>Pendiente</option>
                                    <option value="finalizado" <?php if ($vehiculo['estado_vehiculo'] === 'finalizado') echo 'selected'; ?>>Finalizado</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="card card-secondary shadow-lg card-outline">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Acciones Rápidas</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-info btn-block mb-2">
                                <i class="fas fa-file-invoice mr-1"></i> Generar Factura
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-block mt-3" data-toggle="modal" data-target="#modal-eliminar">
                                <i class="fas fa-trash-alt mr-1"></i> Eliminar Vehículo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</main>
