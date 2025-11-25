<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Galician Motors</title>

	<!-- ADMINLTE + FONT AWESOME Y CSS PERSO-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/assets/css/taller.css">
</head>
<body class="hold-transition sidebar-mini layout-footer-fixed">
<!--WRAPPER-->
<div class="wrapper">

	<header class="main-header-wrapper">
	<nav class="main-header navbar navbar-expand navbar-primary navbar-dark" role="navigation">
		<ul class="navbar-nav">
			<li class="nav-item">
				<!-- Boton aside -->
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<span class="navbar-brand">
					<i class="fas fa-wrench brand-icon ajuste-logo"></i> Galician Motors
				</span>
			</li>
		</ul>

		<ul class="navbar-nav ml-auto">
			<!-- Nombre y cerrar sesion -->
			<li class="nav-item">
				<span class="nav-link">Bienvenido/a  <?php echo $_SESSION['datosEmpleado']['nombre'] ?? 'Usuario';?></span>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/logout" role="button" title="Cerrar Sesión">
					<i class="fas fa-sign-out-alt"></i>
				</a>
			</li>
		</ul>
	</nav>

	</header>

