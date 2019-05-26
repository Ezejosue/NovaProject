<?php
/*
    Clase para definir las plantillas en las páginas web del sitio privado.
*/
class Dashboard
{
	public static function headerTemplate($title)
	{
		session_start();
		print('
        <!DOCTYPE html>
		<html lang="es">

		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<title>Dashboard - '.$title.'</title>

			<!-- Fontfaces CSS-->
			<link href="../resources/css/font-face.css" rel="stylesheet" media="all">
			<link href="../resources/css/font-awesome.css" rel="stylesheet" media="all">
			<link href="../resources/extras/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
			<!-- Bootstrap CSS-->
			<link href="../resources/extras/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
			<link href="../resources/extras/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
			<!-- Main CSS-->
			<link href="../resources/css/theme.css" rel="stylesheet" media="all">
			<!-- Vendor CSS-->
			<link href="../resources/extras/animsition/animsition.min.css" rel="stylesheet" media="all">
			<link href="../resources/css/imagen.css" rel="stylesheet" media="all">
			<link href="../resources/css/dataTables.bootstrap4.min.css" rel="stylesheet" media="all">
			<link href="../resources/css/jquery.dataTables.min.css" rel="stylesheet" media="all">

		</head>
		<body class="animsition">
		<div class="page-wrapper">
		');
		//Se comprueba si existe una sesión para mostrar el menú de opciones, de lo contrario se muestra un menú vacío
		if (isset($_SESSION['idUsuario'])) {
			$filename = basename($_SERVER['PHP_SELF']);
			if ($filename != 'index.php') {
				self::modals();
				print('
                <aside class="menu-sidebar2">
					<div id="logo_pizza_nova" class="logo">  
						<a align="center" href="#">
							<img src="../resources/img/logo.png" alt="Pizza Nova"/>
						</a>
					</div>
					<div class="menu-sidebar2__content js-scrollbar1">
						<div class="account2">
							<div class="image img-cir img-120">
								<img src="../resources/img/icon/avatar-big-01.jpg" alt="John Doe" />
							</div>
							<h4 class="name">john doe</h4>
						</div>
						
						<nav class="navbar-sidebar2">
							<ul class="list-unstyled navbar__list">
								<li>
									<a href="inicio.php">
										<i class="fas fa-tachometer-alt"></i>Vista General
									</a>
								</li>
								<li>
									<a href="perfil.php">
										<i class="fas fa-user-circle"></i>Perfil</a>

								</li>
								<li>
									<a href="categorias.php">
										<i class="fas fa-list"></i>Categorías</a>
								</li>
										<li>
											<a href="productos.php">
												<i class="fas fa-shopping-basket"></i>Materia prima</a>
										</li>
										<li>
											<a href="usuarios.php">
												<i class="fas fa-users"></i>Usuarios</a>
										</li>
										<li>
											<a href="tipo_usuarios.php">
												<i class="fa fa-th	
												"></i>Tipo de usuarios</a>
										</li>
										<li>
											<a href="empleados.php">
												<i class="fas fa-id-card"></i>Empleados</a>
										</li>
									</li>
									<li>
										<a href="reportes.php">
											<i class="fas fa-chart-bar"></i>Reportes</a>
									</li>
									<li>
										<a href="index.php">
											<i class="fas fa-power-off"></i>Cerrar sesion</a>
									</li>
									
							</ul>
						</nav>
					</div>
				</aside>

				<div class="page-container2">
								<!-- Menu Responsive-->
								<header class="header-desktop2">
									<div class="section__content section__content--p30">
										<div class="container-fluid">
											<div class="header-wrap2">
												<div class="logo d-block d-lg-none">
													<a href="inicio.php">
														<img src="../resources/img/logo.png" alt="PizzaNova" />
													</a>
												</div>

												<div class="header-button-item mr-0 js-sidebar-btn">
													<i class="zmdi zmdi-menu"></i>
												</div>
											</div>
										</div>
									</div>
								</header>
								<aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
									<div class="logo">
										<a href="#">
											<img src="../resources/img/logo.png" alt="PizzaNova" />
										</a>
									</div>
									<div class="menu-sidebar2__content js-scrollbar2">
										<div class="account2">
											<div class="image img-cir img-120">
												<img src="../resources/img/icon/avatar-big-01.jpg" alt="John Doe" />
											</div>
											<h4 class="name">john doe</h4>
											<a href="index.php">Cerrar Sesión</a>
										</div>
										<nav class="navbar-sidebar2">
											<ul class="list-unstyled navbar__list">
												<li>
													<a href="inicio.php">
														<i class="fas fa-tachometer-alt"></i>Vista General
														<span class="arrow">

														</span>
													</a>
												</li>
												<li>
													<a href="perfil.php">
														<i class="fas fa-user-circle"></i>Perfil</a>

												</li>
												<li>
													<a href="categorias.php">
														<i class="fas fa-list"></i>Categorías</a>
												</li>
												<li>
													<a href="productos.php">
														<i class="fas fa-shopping-basket"></i>Productos</a>
												</li>
												<li>
													<a href="usuarios.php">
														<i class="fas fa-users"></i>Usuarios</a>
												</li>
												<li>
													<a href="empleados.php">
														<i class="fas fa-id-card"></i>Empleados</a>
												</li>
												</li>
												<li>
													<a href="reportes.php">
														<i class="fas fa-chart-bar"></i>Reportes</a>
												</li>
											</ul>
										</nav>
									</div>
								</aside>
								<!-- Fin Menu Responsive-->
								<br>
				');
			} else {
				header('location: inicio.php');
			}
		} else {
			$filename = basename($_SERVER['PHP_SELF']);
			if ($filename != 'index.php') {
				header('location: index.php');
			} else {
				print('
					<header>
						<div class="navbar-fixed">
							<nav class="teal">
								<div class="nav-wrapper">
									<a href="index.php" class="brand-logo"><i class="material-icons">dashboard</i></a>
								</div>
							</nav>
						</div>
					</header>
					<main class="container">
						<h3 class="center-align">'.$title.'</h3>
				');
			}
		}
	}

	public static function footerTemplate($controller, $tabla)
	{
		print('

			<script src="../resources/js/jquery-3.2.1.min.js"></script>
            <script src="../resources/extras/bootstrap-4.1/bootstrap.min.js"></script>
            <script src="../resources/extras/animsition/animsition.min.js"></script>
            <script src="../resources/extras/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="../core/helpers/table.js"></script>
            <script src="../resources/js/main.js"></script>
            <script src="../resources/js/jquery.dataTables.min.js"></script>
            <script src="../resources/js/dataTables.bootstrap4.min.js"></script>

            <script src="../resources/js/sweetalert.min.js"></script>
            <script type="text/javascript" src="../core/helpers/functions.js"></script>
            <script type="text/javascript" src="../core/controllers/account.js"></script>
            <script type="text/javascript" src="../core/controllers/'.$controller.'"></script>
</body>

</html>
		');
	}

	private function modals()
	{
		print('
			
		');
	}
}
?>