<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galician Motors</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="contenedor-principal-login">

<div class="caja-login caja-registro">
    <div class="logo-login">
        <a href="/">
            <img src="assets/img/logo.png" alt="Logo Galician Motors" class="img-logo-login">
        </a>
    </div>

    <div class="tarjeta-login">
        <div class="cuerpo-tarjeta">

            <form method="post">

                <!-- NOMBRE -->
                <div class="datos-login">
                    <input type="text" class="campo-texto" name="nombre" placeholder="Nombre completo" required>
                    <span class="icono-login">
                        <i class="fas fa-signature"></i>
                    </span>
                </div>

                <!-- EMAIL -->
                <div class="datos-login">
                    <input type="email" class="campo-texto" name="email" placeholder="Correo electrónico" required>
                    <span class="icono-login">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>

                <!-- CONTRASEÑA -->
                <div class="datos-login">
                    <input type="password" class="campo-texto" name="pass" placeholder="Contraseña" required>
                    <span class="icono-login">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <!-- CONTRASEÑA 2-->
                <div class="datos-login">
                    <input type="password" class="campo-texto" name="pass2" placeholder="Repite la contraseña" required>
                    <span class="icono-login">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>

                <!-- TELEFONO -->
                <div class="datos-login">
                    <input type="tel" class="campo-texto" name="telefono" placeholder="Teléfono">
                    <span class="icono-login">
                        <i class="fas fa-phone"></i>
                    </span>
                </div>

                <!-- DIRECCION -->
                <div class="datos-login">
                    <input type="text" class="campo-texto" name="direccion" placeholder="Dirección">
                    <span class="icono-login">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                </div>

                <div class="acceder">
                    <button type="submit" class="boton-acceder">Registrarse</button>
                </div>
            </form>

            <div class="enlaces-login">
                <p>¿Ya tienes cuenta? <a href="/login">Login</a></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>