<?php
declare(strict_types=1);
?>

<main class="content-wrapper" role="main">
    <!-- Título y Breadcrumb -->
    <div class="content-header">
            	          <?php
          include $_ENV['folder.views'] . '/templates/flash-messages.php';
          ?>

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="fas fa-users-cog mr-2 text-primary"></i> Gestión de Personal
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Empleados</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- filtro y tabla -->
    <section class="content">
        <div class="container-fluid">

            <!-- FILTROS -->
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
                    <form method="get" id="filtroEmpleados">
                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger"><?php echo $mensaje ?></div>
                        <?php } ?>

                        <div class="row">

                            <!-- Nombre -->
                            <div class="col-md-4 mb-3">
                                <label for="inputNombre">Buscar por Nombre</label>
                                <input type="text" name="inputNombre" class="form-control"
                                       id="inputNombre"
                                       value="<?php echo $input['inputNombre'] ?? '' ?>"
                                       placeholder="Ej: Juan Perez">
                                <?php if (isset($errors['inputNombre'])) { ?>
                                    <p class="text-danger"><?php echo $errors['inputNombre'] ?></p>
                                <?php } ?>
                            </div>

                            <!-- Puesto -->
                            <div class="col-md-4 mb-3">
                                <label for="selectPuesto">Puesto de Trabajo</label>
                                <select class="form-control" id="selectPuesto" name="selectPuesto">
                                    <option value="">-- Ver todos --</option>

                                    <?php if (isset($roles)) { ?>
                                        <?php foreach ($roles as $rol) { ?>
                                            <option value="<?php echo $rol['id_rol'] ?>"
                                                <?php if (isset($_GET['selectPuesto']) && $_GET['selectPuesto'] == $rol['id_rol']) echo 'SELECTED'; ?>>
                                                <?php echo $rol['nombre_rol'] ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>

                                <?php if (isset($errors['selectPuesto'])) { ?>
                                    <p class="text-danger"><?php echo $errors['selectPuesto'] ?></p>
                                <?php } ?>
                            </div>

                            <!-- Estado -->
                            <div class="col-md-4 mb-3">
                                <label for="selectEstado">Estado</label>
                                <select class="form-control" id="selectEstado" name="selectEstado">
                                    <option value="">-- Ver todos --</option>
                                    <option value="1" <?php if (($_GET['selectEstado'] ?? '') == "1") echo "SELECTED" ?>>Activo</option>
                                    <option value="0" <?php if (($_GET['selectEstado'] ?? '') == "0") echo "SELECTED" ?>>Inactivo</option>
                                </select>

                                <?php if (isset($errors['selectEstado'])) { ?>
                                    <p class="text-danger"><?php echo $errors['selectEstado'] ?></p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="/empleadosTaller" class="btn btn-default mr-2">
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
                <div class="card-header">
                    <h3 class="card-title">Listado Completo de Empleados</h3>
                    <div class="card-tools">
                        <a href="/altaEmpleado" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-plus mr-1"></i> Añadir Empleado
                        </a>
                    </div>
                </div>

             
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <?php if (isset($empleados) && !empty($empleados)){ ?>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><a href="/empleadosTaller?<?php echo $url?>&order=1&dir=<?php echo ($order == 1 && $dir == 'ASC') ? 'DESC' : 'ASC'; ?>">ID</a></th>
                                    <th><a href="/empleadosTaller?<?php echo $url?>&order=2&dir=<?php echo ($order == 2 && $dir == 'ASC') ? 'DESC' : 'ASC'; ?>">Nombre Completo</a></th>
                                    <th><a href="/empleadosTaller?<?php echo $url?>&order=3&dir=<?php echo ($order == 3 && $dir == 'ASC') ? 'DESC' : 'ASC'; ?>">Puesto</th>
                                    <th><a href="/empleadosTaller?<?php echo $url?>&order=4&dir=<?php echo ($order == 4 && $dir == 'ASC') ? 'DESC' : 'ASC'; ?>">Email</th>
                                    <th><a href="/empleadosTaller?<?php echo $url?>&order=5&dir=<?php echo ($order == 5 && $dir == 'ASC') ? 'DESC' : 'ASC'; ?>">Estado</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if (isset($empleados) && !empty($empleados)) { ?>
                                <?php foreach ($empleados as $emp) { ?>
                                    <tr>
                                        <td><?php echo $emp['id_usuario'] ?></td>
                                        <td><?php echo $emp['nombre'] ?></td>
                                        <td><?php echo $emp['nombre_rol'] ?></td>
                                        <td><?php echo $emp['email'] ?></td>
                                        <td>
                                            <?php if ($emp['activo'] == 1) { ?>
                                                <span class="badge bg-success">Activo</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Inactivo</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="/empleadosTaller/edit/<?php echo $emp['id_usuario'] ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <a href="/empleadosTaller/baja/<?php echo $emp['id_usuario'] ?>" class="btn btn-sm btn-warning text-dark"><i class="fas fa-minus-circle"></i></a>
                                            <a href="/empleadosTaller/delete/<?php echo $emp['id_usuario'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr><td colspan="6" class="text-center text-muted">No hay resultados.</td></tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php } else { ?>
                        <div class="p-5 text-center bg-light">
                            <i class="fas fa-info-circle fa-2x text-info mb-3"></i>
                            <h4 class="mb-1">No se encontraron resultados.</h4>
                        </div>
                    <?php } ?>
                    </div>
                </div>


                <?php if ($lastPage > 1) { ?>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">

                        <li class="page-item <?php if ($page == 1) echo 'd-none' ?>">
                            <a class="page-link" href="/empleadosTaller?<?php echo $url ?>">
                                << 
                            </a>
                        </li>

                        <li class="page-item <?php if ($page == 1) echo 'd-none' ?>">
                            <a class="page-link" href="/empleadosTaller?<?php echo $url ?>&page=<?php echo $page - 1 ?>">
                                <
                            </a>
                        </li>

                        <li class="page-item active"><span class="page-link"><?php echo $page ?></span></li>

                        <li class="page-item <?php if ($page == $lastPage) echo 'd-none' ?>">
                            <a class="page-link" href="/empleadosTaller?<?php echo $url ?>&page=<?php echo $page + 1 ?>">
                                >
                            </a>
                        </li>

                        <li class="page-item <?php if ($page == $lastPage) echo 'd-none' ?>">
                            <a class="page-link" href="/empleadosTaller?<?php echo $url ?>&page=<?php echo $lastPage ?>">
                                >>
                            </a>
                        </li>

                    </ul>
                </div>
                <?php } ?>
            </div>

        </div>
    </section>
</main>
