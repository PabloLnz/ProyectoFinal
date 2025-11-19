<main class="content-wrapper" role="main">
        <!-- Título y Breadcrumb -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><i class="fas fa-users-cog mr-2 text-primary"></i> Gestión de Personal</h1>
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
                
                <!--Filtrar y buscar-->
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
                        <form id="filtroEmpleados">
                            <div class="row">
                                <!-- Nombre -->
                                <div class="col-md-4 mb-3">
                                    <label for="inputNombre">Buscar por Nombre</label>
                                    <input type="text" class="form-control" id="inputNombre" placeholder="Ej: Juan Perez">
                                </div>
                                <!-- Puesto -->
                                <div class="col-md-4 mb-3">
                                    <label for="selectPuesto">Puesto de Trabajo</label>
                                    <select class="form-control" id="selectPuesto">
                                        <option value="">-- Ver todos --</option>
                                    </select>
                                </div>
                                <!-- Estado -->
                                <div class="col-md-4 mb-3">
                                    <label for="selectEstado">Estado</label>
                                    <select class="form-control" id="selectEstado">
                                        <option value="">-- Ver todos --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                  <!-- boton filtros -->
                                <div class="col-12 text-right">
                                    <button type="reset" class="btn btn-default mr-2"><i class="fas fa-sync-alt mr-1"></i> Limpiar Filtros</button>
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search mr-1"></i> Aplicar Filtros</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Empleados -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado Completo de Empleados</h3>
                        <div class="card-tools">
                            <a href="/altaEmpleado" class="btn btn-primary btn-sm" title="Nuevo Empleado">
                                <i class="fas fa-user-plus mr-1"></i> Añadir Empleado
                            </a>
                        </div>
                    </div>
                    <!-- Tabla -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Completo</th>
                                        <th>Puesto</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
   
                                    <tr>
                                        <td>43535344</td>
                                        <td>Juan sfsdfsf sdgsg</td>
                                        <td>Gerente</td>
                                        <td>juan.dsffsdf@galicianmotors.es</td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-info" title="Modificar"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-warning text-dark" title="Baja"><i class="fas fa-minus-circle"></i></button>
                                            <button class="btn btn-sm btn-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>111111111</td>
                                        <td>Maria dfasdf fasf</td>
                                        <td>Mecanico</td>
                                        <td>maria.sdfsdf@galicianmotors.es</td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-info" title="Modificar"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-warning text-dark" title="Baja"><i class="fas fa-minus-circle"></i></button>
                                            <button class="btn btn-sm btn-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--paginacion-->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#"><<</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">>></a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </section>
    </main>