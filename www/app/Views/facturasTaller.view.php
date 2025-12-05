<main class="content-wrapper" role="main">

    <div class="content-header">
        <?php
        include $_ENV['folder.views'] . '/templates/flash-messages.php';
        ?>

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="fas fa-file-invoice-dollar mr-2 text-primary"></i> Listado de Facturas
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/indexTaller">Inicio</a></li>
                        <li class="breadcrumb-item active">Facturas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-filter mr-1"></i> Opciones de Filtrado</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <form method="get">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="selectEstado">Estado:</label>
                                <select class="form-control <?php echo isset($errors['selectEstado']) ? 'is-invalid' : ''; ?>" id="selectEstado" name="selectEstado">
                                    <option value="">-- Todos --</option>
                                    <?php
                                    foreach ($estadosFactura as $estado):
                                        $selected = ($input['selectEstado'] ?? '') === $estado['id_estado'] ? 'SELECTED' : '';
                                        ?>
                                        <option value="<?php echo $estado['id_estado']; ?>" <?php echo $selected; ?>>
                                            <?php echo $estado['nombre_estado']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['selectEstado'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['selectEstado']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="inputCliente">Cliente (Nombre o ID)</label>
                                <input type="text" name="inputCliente" class="form-control <?php echo isset($errors['inputCliente']) ? 'is-invalid' : ''; ?>"
                                       id="inputCliente"
                                       value="<?php echo htmlspecialchars($input['inputCliente'] ?? '') ?>"
                                       placeholder="ID o nombre del cliente">
                                <?php if (isset($errors['inputCliente'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['inputCliente']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="inputFechaDesde">Fecha Desde:</label>
                                <input type="date" name="inputFechaDesde" class="form-control <?php echo isset($errors['inputFechaDesde']) ? 'is-invalid' : ''; ?>"
                                       id="inputFechaDesde"
                                       value="<?php echo htmlspecialchars($input['inputFechaDesde'] ?? '') ?>">
                                <?php if (isset($errors['inputFechaDesde'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['inputFechaDesde']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="inputFechaHasta">Fecha Hasta:</label>
                                <input type="date" name="inputFechaHasta" class="form-control <?php echo isset($errors['inputFechaHasta']) ? 'is-invalid' : ''; ?>"
                                       id="inputFechaHasta"
                                       value="<?php echo htmlspecialchars($input['inputFechaHasta'] ?? '') ?>">
                                <?php if (isset($errors['inputFechaHasta'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['inputFechaHasta']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="inputTotalMax">Total Máx. (€):</label>
                                <input type="number" name="inputTotalMax" step="0.01" min="0" class="form-control <?php echo isset($errors['inputTotalMax']) ? 'is-invalid' : ''; ?>"
                                       id="inputTotalMax"
                                       value="<?php echo htmlspecialchars($input['inputTotalMax'] ?? '') ?>"
                                       placeholder="Máx.">
                                <?php if (isset($errors['inputTotalMax'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['inputTotalMax']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="/facturacion" class="btn btn-default mr-2">
                                    <i class="fas fa-sync-alt mr-1"></i> Limpiar Filtros
                                </a>
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-search mr-1"></i> Aplicar Filtros
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Resultados de Facturas</h3>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">

                        <?php
                        if (!empty($facturas)): ?>
                            <table class="table table-hover table-striped" id="tablaFacturas">
                                <thead>
                                <tr>
                                    <th># ID</th>
                                    <th>Fecha Emisión</th>
                                    <th>Cliente</th>
                                    <th class="text-right">Total</th>
                                    <th class="text-center">Estado</th>
                                    <th>Metodo Pago</th>
                                    <th>Comentarios</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($facturas as $factura):?>
                                    <tr data-id-factura="<?php echo htmlspecialchars($factura['id_factura']); ?>">
                                        <td><?php echo htmlspecialchars($factura['id_factura']); ?></td>
                                        <td><?php echo $factura['fechaFormateada']; ?></td>
                                        <td><?php echo htmlspecialchars($factura['nombre_cliente']); ?> (ID: <?php echo htmlspecialchars($factura['id_cliente']); ?>)</td>

                                        <td class="font-weight-bold text-right"><?php echo $factura['totalFormateado']; ?></td>

                                        <td class="text-center">
                                        <span class="badge badge-estado <?php echo ($factura['estado'] === 'pagada') ? 'bg-success' : (($factura['estado'] === 'pendiente') ? 'bg-warning text-dark' : (($factura['estado'] === 'cancelada') ? 'bg-danger' : 'bg-secondary')); ?>">
                                            <?php echo ucfirst($factura['estado']); ?>
                                        </span>
                                        </td>

                                        <td>
                                            <?php if ($factura['estado'] === 'pendiente'): ?>
                                                <span class="text-muted">Pendiente</span>
                                            <?php else: ?>
                                                <?php echo htmlspecialchars($factura['metodo_pago'] ?? 'N/A'); ?>
                                            <?php endif; ?>
                                        </td>

                                        <td><?php echo htmlspecialchars(substr($factura['comentarios'] ?? '', 0, 30)) . (strlen($factura['comentarios'] ?? '') > 30 ? '...' : ''); ?></td>

                                        <td class="text-center">
                                            <?php if ($factura['estado'] === 'pendiente'): ?>
                                                <form action="/facturacion/pagar/<?php echo $factura['id_factura']; ?>" method="post" class="form d-flex justify-content-center align-items-center">

                                                    <select name="metodo_pago" class="form-control form-control-sm mr-2" style="width: 120px;" required>
                                                        <option value="">Método...</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                    </select>

                                                    <button type="submit" class="btn btn-sm btn-success" title="Confirmar Pago">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-success" title="Pagada"><i class="fas fa-check-circle fa-lg"></i></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="p-5 text-center bg-light">
                                <i class="fas fa-info-circle fa-2x text-info mb-3"></i>
                                <h4 class="mb-1">
                                    <?php
                                    if (isset($mensaje)) {
                                        echo $mensaje;
                                    } else {
                                        echo 'No se encontraron facturas para mostrar.';
                                    }
                                    ?>
                                </h4>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>