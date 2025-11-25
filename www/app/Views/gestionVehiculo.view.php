<main class="content-wrapper p-4">
    	          <?php
          include $_ENV['folder.views'] . '/templates/flash-messages.php';
          ?>

    <div class="container-fluid">

        <h2 class="mb-4 text-dark font-weight-bold d-flex align-items-center">
            <i class="fas fa-car-side text-info mr-3 fa-2x"></i>
            Gestión del Vehículo: 
            <span class="ml-2 text-primary">4567-XYZ</span>
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
                                           value="4567-XYZ" 
                                           readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cliente_nombre"><i class="fas fa-user mr-1"></i> Cliente Asociado</label>
                                    <input type="text" class="form-control" id="cliente_nombre" 
                                           value="Andrés González" 
                                           readonly>
                                    <input type="hidden" name="id_cliente" value="101">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="marca">Marca</label>
                                    <input type="text" class="form-control" id="marca" name="marca" 
                                           value="BMW" readonly>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" 
                                           value="Serie 3 (F30)" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="anyo">Año</label>
                                    <input type="text" class="form-control" id="anyo" name="anyo" 
                                           value="2015" readonly>
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
                                        <option value="1">1. Filtro de aceite (Stock: 15)</option>
                                        <option value="2">2. Pastillas de freno delanteras (Stock: 10)</option>
                                        <option value="4">4. Aceite sintético 5W30 4L (Stock: 20)</option>
                                        <option value="12">12. Bombilla LED faro delantero (Stock: 20)</option>
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
                                        <tr>
                                            <td>1</td>
                                            <td>Filtro de aceite <br><small class="text-muted">FO-BMW-001</small></td>
                                            <td class="text-center">1</td>
                                            <td class="text-right">25,50 €</td>
                                            <td class="text-right">25,50 €</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Aceite sintético 5W30 4L <br><small class="text-muted">ACE-BMW-004</small></td>
                                            <td class="text-center">4</td>
                                            <td class="text-right">40,00 €</td>
                                            <td class="text-right">160,00 €</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-right font-weight-bold">Total Piezas:</td>
                                            <td class="text-right font-weight-bolder text-lg text-primary">185,50 €</td>
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
                                <span class="badge badge-warning text-dark font-weight-bold p-3 text-lg rounded-pill shadow">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> PENDIENTE
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <label for="estado">Cambiar Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="pendiente" selected>
                                        Pendiente
                                    </option>
                                    <option value="finalizado">
                                        Finalizado
                                    </option>
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