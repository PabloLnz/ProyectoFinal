<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galician Motors</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="contenedor-principal-login">

<?php include $_ENV['folder.views'] . '/templates/flash-messages.php'; ?>

<div class="caja-login">
    <div class="logo-login">
        <a href="/">
            <img src="assets/img/logo.png" alt="Logo Galician Motors" class="img-logo-login">
        </a>
    </div>

    <div class="tarjeta-login">
        <div class="cuerpo-tarjeta">
            <p class="mensaje-login">Iniciar sesión</p>

            <form method="post">
                <div class="datos-login">
                    <input type="text" class="campo-texto" name="email" placeholder="Email" value="<?php echo $input['email'] ?? '' ?>" required>
                    <span class="icono-login"><i class="fas fa-user"></i></span>
                </div>

                <div class="datos-login">
                    <input type="password" class="campo-texto" name="pass" placeholder="Contraseña" required>
                    <span class="icono-login"><i class="fas fa-lock"></i></span>
                </div>
                <?php if (isset($errors)){ ?>
                    <div class="mensaje-error">
                        <p>Datos Incorrectos</p>
                    </div>

                <?php }?>

                <div class="acceder">
                    <button type="submit" class="boton-acceder">Acceder</button>
                </div>
            </form>


            <div class="enlaces-login">
                <p>¿No tienes cuenta? <a href="/register">Regístrate aquí</a></p>
            </div>

        </div>
    </div>
</div>

</body>
</html>
