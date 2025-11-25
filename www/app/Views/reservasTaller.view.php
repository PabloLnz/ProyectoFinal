<main class="content-wrapper p-4">
    <div class="container-fluid">

        <h2 class="mb-4 text-dark font-weight-bold">
            <i class="far fa-calendar-check text-info mr-2"></i> Gestión de Reservas
        </h2>

        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-list-ul mr-1 text-primary"></i> Lista Completa de Reservas
                        </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="text-secondary mb-3">Todas las citas registradas</h5>

                        <?php foreach ($reservas as $r) {
                            $estado = strtolower($r['estado']);
                        ?>
                            <div class="card card-widget shadow-sm mb-3 
                                <?php if ($estado === 'pendiente') { echo 'border-left border-danger'; } elseif ($estado === 'confirmada') { echo 'border-left border-warning'; } elseif ($estado === 'finalizada') { echo 'border-left border-success'; } elseif ($estado === 'rechazada') { echo 'border-left border-dark'; } elseif ($estado === 'no_asistida') { echo 'border-left border-info'; } else { echo 'border-left border-secondary'; } ?>">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">

                                        <?php if ($estado === 'pendiente' || $estado === 'confirmada') { ?>
                                            <div class="col-5">
                                                <p class="mb-0 text-dark font-weight-bold">
                                                    <i class="fas fa-user mr-2 text-info"></i> Cliente: <?php echo $r['nombre_cliente']; ?>
                                                </p>
                                                <p class="mb-0 text-sm text-muted">
                                                    <i class="fas fa-car mr-2"></i> Matricula: <?php echo $r['matricula']; ?>
                                                </p>
                                            </div>

                                            <div class="col-3 text-center">
                                                <span class="badge 
                                                    <?php if ($estado === 'pendiente') { echo 'badge-danger'; } elseif ($estado === 'confirmada') { echo 'badge-warning'; } elseif ($estado === 'finalizada') { echo 'badge-success'; } elseif ($estado === 'rechazada') { echo 'badge-dark'; } elseif ($estado === 'no_asistida') { echo 'badge-info'; } else { echo 'badge-secondary'; } ?> font-weight-bold p-2">
                                                    <?php echo strtoupper($r['estado']); ?>
                                                </span>
                                                <p class="mb-0 mt-1 text-xs"><?php echo $r['fecha_reserva']; ?>, <?php echo $r['hora_reserva']; ?></p>
                                            </div>

                                            <div class="col-4 text-right">
                                                <a href="/reservas/gestionar/<?php echo $r['id_reserva']; ?>" class="btn btn-sm btn-info btn-block">
                                                    <i class="fas fa-edit mr-1"></i> Gestionar
                                                </a>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-7">
                                                <p class="mb-0 text-dark font-weight-bold">
                                                    <i class="fas fa-user mr-2 text-info"></i> Cliente: <?php echo $r['nombre_cliente']; ?>
                                                </p>
                                                <p class="mb-0 text-sm text-muted">
                                                    <i class="fas fa-car mr-2"></i> Matricula: <?php echo $r['matricula']; ?>
                                                </p>
                                            </div>

                                            <div class="col-5 text-right">
                                                <span class="badge 
                                                    <?php if ($estado === 'pendiente') { echo 'badge-danger'; } elseif ($estado === 'confirmada') { echo 'badge-warning'; } elseif ($estado === 'finalizada') { echo 'badge-success'; } elseif ($estado === 'rechazada') { echo 'badge-dark'; } elseif ($estado === 'no_asistida') { echo 'badge-info'; } else { echo 'badge-secondary'; } ?> font-weight-bold p-2">
                                                    <?php echo strtoupper($r['estado']); ?>
                                                </span>
                                                <p class="mb-0 mt-1 text-xs text-muted"><?php echo $r['fecha_reserva']; ?></p>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-secondary shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-info-circle mr-1"></i> Detalles y Acciones
                        </h3>
                    </div>

                    <div class="card-body">
                        <?php if (isset($reserva) && $reserva) { ?>
                            <h4 class="text-primary font-weight-bold mb-3">
                                Reserva (<?php echo $reserva['nombre_cliente']; ?>)
                            </h4>

                            <dl class="row">
                                <dt class="col-sm-4">Matricula:</dt>
                                <dd class="col-sm-8"><?php echo $reserva['matricula']; ?></dd>

                                <dt class="col-sm-4">Descripcion del cliente:</dt>
                                <dd class="col-sm-8"><?php echo $reserva['comentariosReserva'];?></dd>

                                <dt class="col-sm-4">Fecha/Hora:</dt>
                                <dd class="col-sm-8 text-danger font-weight-bold"><?php echo $reserva['fecha_reserva']; ?> a las <?php echo $reserva['hora_reserva']; ?></dd>

                                <dt class="col-sm-4">Teléfono:</dt>
                                <dd class="col-sm-8"><?php echo $reserva['telefono'] ?? ''; ?></dd>

                                
                                <dt class="col-sm-4">Email:</dt>
                                <dd class="col-sm-8"><?php echo $reserva['email'] ?? ''; ?></dd>


                                <dt class="col-sm-4">Estado Actual:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge 
                                        <?php if (strtolower($reserva['estado']) === 'pendiente') { echo 'badge-danger'; } elseif (strtolower($reserva['estado']) === 'confirmada') { echo 'badge-warning'; } elseif (strtolower($reserva['estado']) === 'finalizada') { echo 'badge-success'; } elseif (strtolower($reserva['estado']) === 'rechazada') { echo 'badge-dark'; } elseif (strtolower($reserva['estado']) === 'no_asistida') { echo 'badge-info'; } else { echo 'badge-secondary'; } ?> font-weight-bold p-2">
                                        <?php echo strtoupper($reserva['estado']); ?>
                                    </span>
                                </dd>
                            </dl>

                            <hr class="mt-4">

                            <h5 class="font-weight-bold text-dark">Cambiar Estado de la Reserva</h5>

                            <div class="d-grid gap-2">
                                <a href="/reservas/gestionar/confirmar/<?php echo $reserva['id_reserva']; ?>" class="btn btn-block btn-warning mt-2 font-weight-bold">
                                    <i class="fas fa-check-circle mr-1"></i> ACEPTAR: Pasar a CONFIRMADA
                                </a>

                                <a href="/reservas/gestionar/finalizar/<?php echo $reserva['id_reserva']; ?>" class="btn btn-block btn-success mt-2 font-weight-bold">
                                    <i class="fas fa-sign-out-alt mr-1"></i> MARCAR: FINALIZADA
                                </a>

                                <a href="/reservas/gestionar/no-asistida/<?php echo $reserva['id_reserva']; ?>" class="btn btn-block btn-info mt-2 font-weight-bold">
                                    <i class="fas fa-user-slash mr-1"></i> MARCAR: NO ASISTIDA
                                </a>

                                <a href="/reservas/gestionar/rechazar/<?php echo $reserva['id_reserva']; ?>" class="btn btn-block btn-dark mt-2 font-weight-bold">
                                    <i class="fas fa-times-circle mr-1"></i> RECHAZAR
                                </a>
                            </div>
                        <?php } else { ?>
                            <p class="text-center text-secondary font-weight-bold">
                                Seleccione una reserva para gestionar
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
