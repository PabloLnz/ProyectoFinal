    
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

                                <form method="post" action="/altaEmpleado">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--Nombre-->
                                            <div class="form-group">
                                                <label for="nombre">Nombre Completo</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required 
                                                    placeholder="Ej: Sara Montes" value="<?php echo htmlspecialchars($input['username'] ?? $input['nombre'] ?? ''); ?>">
                                            <?php if (isset($errors['username'])) { ?>
                                                <p class="text-danger"><?php echo htmlspecialchars($errors['username']); ?></p>
                                            <?php } ?>
                                            </div>
                <!--Correo-->
                                            <div class="form-group">
                                                <label for="email">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="email" name="email" required 
                                                    placeholder="ejemplo@galicianMotors.com" value="<?= htmlspecialchars($input['email'] ?? '') ?>">
                                            <?php if (isset($errors['email'])) { ?>
                                                <p class="text-danger"><?php echo htmlspecialchars($errors['email']); ?></p>
                                            <?php } ?>
                                            </div>
                <!--Telefono-->
                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" required 
                                                    placeholder="Ej: 674567764" value="<?= htmlspecialchars($input['telefono'] ?? '') ?>">
                                            <?php if (isset($errors['telefono'])) { ?>
                                                <p class="text-danger"><?php echo htmlspecialchars($errors['telefono']); ?></p>
                                            <?php } ?>
                                            </div>
                <!--ROl-->
                                            <div class="form-group">
                                                <label for="id_rol">Rol</label>
                                                <select id="id_rol" name="id_rol" class="form-control" required>
                                                    <option value="" disabled <?= empty($input['id_rol']) ? 'selected' : '' ?>>Selecciona un rol</option>
                                                    <?php if (!empty($roles) && is_array($roles)): foreach($roles as $r): ?>
                                                        <option value="<?= $r['id_rol'] ?>" <?= (isset($input['id_rol']) && $input['id_rol'] == $r['id_rol']) ? 'selected' : '' ?>><?= htmlspecialchars($r['nombre_rol']) ?></option>
                                                    <?php endforeach; endif; ?>
                                                </select>
                                            <?php if (isset($errors['rol'])) { ?>
                                                <p class="text-danger"><?php echo htmlspecialchars($errors['rol']); ?></p>
                                            <?php } ?>
                                            </div>
                                        </div>
                <!--pass-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pass">Contraseña</label>
                                                <input type="password" class="form-control" id="pass" name="pass" required 
                                                    placeholder="Mínimo 3 caracteres">
                                            <?php if (isset($errors['pass'])) { ?>
                                                <p class="text-danger"><?php echo htmlspecialchars($errors['pass']); ?></p>
                                            <?php } ?>
                                            </div>
                <!--pass2-->
                                            <div class="form-group">
                                                <label for="pass2">Repite Contraseña</label>
                                                <input type="password" class="form-control" id="pass2" name="pass2" required 
                                                    placeholder="Repite la contraseña">
                                            <?php if (isset($errors['pass2'])) { ?>
                                                <p class="text-danger"><?php echo htmlspecialchars($errors['pass2']); ?></p>
                                            <?php } ?>
                                            </div>
                                                            <!--Pais-->
                                            <div class="form-group">
                                                <label for="id_pais">País</label>
                                                <select id="id_pais" name="id_pais" class="form-control" required data-selected="<?= htmlspecialchars($input['id_pais'] ?? '') ?>">
                                                  <option value="" disabled <?= empty($input['id_rol']) ? 'selected' : '' ?>>Selecciona un pais</option>
                                                    <?php if (!empty($paises) && is_array($paises)): foreach($paises as $p): ?>
                                                        <option value="<?= $p['id_pais'] ?>" <?= (isset($input['id_pais']) && $input['id_pais'] == $p['id_pais']) ? 'selected' : '' ?>><?= htmlspecialchars($p['nombre']) ?></option>
                                                    <?php endforeach; endif; ?>
                                                </select>
                
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit"
                                            class="btn btn-primary btn-lg btn-block shadow mt-4">
                                        <i class="fas fa-check-circle mr-2" aria-hidden="true"></i> Añadir Nuevo Empleado
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
                                            
