    
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Alta de Empleado</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Empleados</a></li>
                            <li class="breadcrumb-item active">Nuevo Empleado</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">

                        <div class="card card-primary card-outline shadow-lg">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-user-plus mr-2"></i> Registro de Nuevo Empleado
                                </h3>
                            </div>

                            <div class="card-body">
                                <p class="text-muted text-center mb-4">
                                    Ingresa los datos para crear un nuevo empleado
                                </p>

                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--Nombre-->
                                            <div class="form-group">
                                                <label for="nombre">Nombre Completo</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required 
                                                    placeholder="Ej: Sara Montes">
                                            </div>
                <!--Correo-->
                                            <div class="form-group">
                                                <label for="email">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="email" name="email" required 
                                                    placeholder="ejemplo@galicianMotors.com">
                                            </div>
                <!--Telefono-->
                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" required 
                                                    placeholder="Ej: 674567764">
                                            </div>
                <!--ROl-->
                                            <div class="form-group">
                                                <label for="id_rol">Rol</label>
                                                <select id="id_rol" name="id_rol" class="form-control" required>
                                                    <option value="" disabled selected>Selecciona un rol</option>

                                                </select>
                                            </div>
                                        </div>
                <!--pass-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pass">Contraseña</label>
                                                <input type="password" class="form-control" id="pass" name="pass" required 
                                                    placeholder="Mínimo 3 caracteres">
                                            </div>
                <!--pass2-->
                                            <div class="form-group">
                                                <label for="pass2">Repite Contraseña</label>
                                                <input type="password" class="form-control" id="pass2" name="pass2" required 
                                                    placeholder="Repite la contraseña">
                                            </div>
                                                            <!--Pais-->
                                            <div class="form-group">
                                                <label for="id_pais">País</label>
                                                <select id="id_pais" name="id_pais" class="form-control" required>
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit"
                                            class="btn btn-primary btn-lg btn-block shadow mt-4">
                                        <i class="fas fa-check-circle mr-2"></i> Añadir Nuevo Empleado
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
                                            
