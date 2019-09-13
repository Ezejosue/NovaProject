<?php
/*
    Clase para definir las plantillas en las páginas web del sitio privado.
*/



class Dashboard
{
	
	
	public static function headerTemplate($title)
	{
		if(!isset($_SESSION)) 
    	{ 
        	session_start(); 
    	} 
			if (isset($_SESSION['idUsuario'])) {
					if (isset($_SESSION['tiempo'])) {
						require_once("../core/helpers/conexion.php");
						require_once("../core/helpers/validator.php");						
						require_once('../core/helpers/usuarios.php');
						$usuario = new Usuarios;
						//Tiempo de vida de la sesión, en este caso 15min
						$inactivo = 900;
						//calculamos tiempo de vida inactivo
						$vida_session = time() - $_SESSION['tiempo'];
						//comparamos si el tiempo de vida de la sesión es mayor inactivo
						if ($vida_session > $inactivo) {
							if($usuario->setId($_SESSION['idUsuario'])) {
								$usuario->UpdateLogout();
								//remover sesión
								session_unset();
								//Destruimos la sesión
								session_destroy();

								//redirigir a index
							header("location: ../../views/index.php");
							}
							

						} else { //Si no a caducado la sesión, actualizamos
							$_SESSION['tiempo'] = time();
						}
						
					} else { //Activamos sesión tiempo
						$_SESSION['tiempo'] = time();
					} 
				
			} else {
				$result['exception'] = 'Usuario desconocido';
			} 
		
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
			<link href="../resources/css/all.css" rel="stylesheet" media="all">
			<link href="../resources/extras/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
			<!-- Bootstrap CSS-->
			<link href="../resources/extras/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
			<link href="../resources/extras/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
			<!-- Main CSS-->
			<link href="../resources/css/theme.css" rel="stylesheet" media="all">
			<!-- Vendor CSS-->
			<link href="../resources/extras/animsition/animsition.min.css" rel="stylesheet" media="all">
			<link href="../resources/css/dataTables.bootstrap4.min.css" rel="stylesheet" media="all">
			<link href="../resources/css/jquery.dataTables.min.css" rel="stylesheet" media="all">
			<link href="../resources/css/main.css" rel="stylesheet" media="all">
			<link href="../resources/css/Chart.css" rel="stylesheet" media="all">
			<body class="animsition">
			<div class="page-wrapper">
		</head>
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
							<div class="image img-cir img-120" id="foto-user">
							</div>
							<div id="nombre-user">
							</div>
							<div class="row">
								<a href="#modal-profile" class="modal-trigger" data-toggle="modal" onclick="modalProfile()"> <h6> <i class="fa fa-edit"></i> |</h6> </a>
								<a href="#modal-password" class="modal-trigger" data-toggle="modal"> <h6> | <i class="fa fa-key"></i> | </h6> </a>
								<a href="#" onclick="signOff()"> <h6> | <i class="fa fa-sign-out-alt"></i></h6> </a>
							</div>
						</div>
						<nav class="navbar-sidebar2">
							<ul class="list-unstyled navbar__list">
								<li>
									<a href="inicio.php">
										<i class="fas fa-tachometer-alt"></i>Vista General
									</a>
								</li>
										<li>
											<a href="#itemsDrop" data-toggle="collapse" class="collapsed"><i class="fab fa-dropbox"></i><span>
											Productos</span><i class="fas fa-sort-down"></i></a>
												<div id="itemsDrop" class="collapse">
													<ul>
													<li>
															<a href="categorias.php">
																<i class="fas fa-list"></i> Categorías</a>
														</li>
														<li>													
															<a href="materia_prima.php">
															<i class="fas fa-cart-plus"></i> Materia prima</a>
														</li>
														<li>
															<a href="platillos.php">
															<i class="fas fa-utensils"></i> Platillos</a>
														</li>
														<li>
															<a href="recetas.php">
															<i class="fas fa-book"></i> Recetas</a>
													</li> 
													<li>
															<a href="unidadmedida.php">
															<i class="fas fa-balance-scale"></i> Unidades de medida</a>
													</li> 
													</ul>
												</div>
										</li>
										<li>
											<a href="#itemsDrop1" data-toggle="collapse" class="collapsed"><i class="fas fa-clipboard"></i><span>
											Logistica</span><i class="fas fa-sort-down"></i></a>
												<div id="itemsDrop1" class="collapse">
													<ul>
														<li>
															<a href="ordenes.php">
																<i class="fas fa-list"></i> Ordenes</a>
														</li>
														<li>													
															<a href="pedidos.php">
															<i class="fas fa-pizza-slice"></i> Pedidos</a>
														</li>
														<li>
															<a href="mesas.php">
															<i class="fas fa-utensils"></i> Mesas</a>
														</li>
														<li>
															<a href="desperdicios.php">
															<i class="fas fa-trash"></i> Desperdicios</a>
														</li>
													</ul>
												</div>
										</li>
										<li>
											<a href="#itemsDrop2" data-toggle="collapse" class="collapsed"><i class="fas fa-user-circle"></i><span>
											Perfiles</span><i class="fas fa-sort-down"></i></a>
												<div id="itemsDrop2" class="collapse">
													<ul>
													<li>
											<a href="usuarios.php">
												<i class="fas fa-user-plus"></i> Usuarios</a>
										</li>
										<li>
											<a href="tipo_usuarios.php">
											<i class="fas fa-users"></i> Tipo de usuarios</a>
										</li>
										<li>
											<a href="empleados.php">
												<i class="fas fa-id-card"></i> Empleados</a>
										</li>
										</li>
										<li>
													<a href="cargo.php">
													<i class="far fa-address-book"></i>Cargo</a>
												</li>
													</ul>
												</div>
										</li>
										<li>
											<a href="reportes.php">
												<i class="fas fa-chart-bar"></i> Reportes</a>
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
						<div class="menu-sidebar2__content js-scrollbar1">
						<div class="account2">
							<div class="image img-cir img-120" id="foto-user-responsive">
							</div>
							<div id="nombre-user-responsive">
							</div>
							<div class="row">
								<a href="#modal-profile" class="modal-trigger" data-toggle="modal" onclick="modalProfile()"> <h6> <i class="fa fa-edit"></i> |</h6> </a>
								<a href="#modal-password1" class="modal-trigger" data-toggle="modal"> <h6> | <i class="fa fa-key"></i> | </h6> </a>
								<a href="#" onclick="signOff()"> <h6> | <i class="fa fa-sign-out-alt"></i></h6> </a>
							</div>
						</div>
							<nav class="navbar-sidebar2">
							<ul class="list-unstyled navbar__list">
								<li>
									<a href="inicio.php">
										<i class="fas fa-tachometer-alt"></i> Vista General
									</a>
								</li>
											<li>
												<a href="categorias.php">
												<i class="fas fa-list"></i> Categorías</a>
											</li>
											<li>													
												<a href="materia_prima.php">
												<i class="fas fa-cart-plus"></i> Materia prima</a>
											</li>
											<li>
												<a href="platillos.php">
												<i class="fas fa-utensils"></i> Platillos</a>
											</li>
											<li>
												<a href="recetas.php">
												<i class="fas fa-book"></i> Recetas</a>
											</li> 
											<li>
												<a href="unidadmedida.php">
												<i class="fas fa-balance-scale"></i> Unidades de medida</a>
											</li> 
											
											<li>
												<a href="ordenes.php">
												<i class="fas fa-list"></i> Ordenes</a>
											</li>
											<li>
												<a href="pedidos.php">
												<i class="fas fa-pizza-slice"></i> Pedidos</a>
											</li>
											<li>
												<a href="mesas.php">
												<i class="fas fa-utensils"></i> Mesas</a>
											</li>
											<li>
												<a href="desperdicios.php">
												<i class="fas fa-trash"></i> Desperdicios</a>
											</li>
											<li>
												<a href="usuarios.php">
												<i class="fas fa-user-plus"></i> Usuarios</a>
											</li>
											<li>
												<a href="tipo_usuarios.php">
												<i class="fas fa-users"></i> Tipo de usuarios</a>
											</li>
											<li>
												<a href="empleados.php">
												<i class="fas fa-id-card"></i> Empleados</a>
											</li>
											</li>
											<li>
												<a href="reportes.php">
												<i class="fas fa-chart-bar"></i> Reportes</a>
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
            <script src="../resources/js/bootstrap.bundle.min.js"></script>
            <script src="../resources/extras/animsition/animsition.min.js"></script>
            <script src="../resources/extras/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="../core/helpers/table.js"></script>
            <script src="../resources/js/main.js"></script>
            <script src="../resources/js/jquery.dataTables.min.js"></script>
			<script src="../resources/js/dataTables.bootstrap4.min.js"></script>
			<script src="../resources/js/all.js"></script>
			<script src="../resources/js/chart.js"></script>
			
            <script src="../resources/js/sweetalert.min.js"></script>
            <script type="text/javascript" src="../core/helpers/functions.js"></script>
            <script type="text/javascript" src="../core/controllers/account.js"></script>
			<script type="text/javascript" src="../core/controllers/'.$controller.'"></script>
			<script src="../resources/js/bootstrap-validate.js"></script>
			<script>bootstrapValidate("#clave_actual_1", "min:6:Ingrese una contraseña mayor a 5 caracteres")</script>
			<script>bootstrapValidate("#clave_actual_2", "min:6:Ingrese una contraseña mayor a 5 caracteres")</script>
			<script>bootstrapValidate("#clave_nueva_1", "min:6:Ingrese una contraseña mayor a 5 caracteres")</script>
			<script>bootstrapValidate("#clave_nueva_2", "min:6:Ingrese una contraseña mayor a 5 caracteres")</script>
			<script>bootstrapValidate("#profile_alias", "required:Ingrese un nombre de usuario")</script>
			
		');
	}
	public static function inicio()
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
			<div id="modal-profile" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">EDITAR PERFIL</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<form method="post" id="form-profile" enctype="multipart/form-data">
							<select id="profile_tipo" name="profile_tipo" hidden>
							<input type="hidden" id="profile_imagen" name="profile_imagen" />
							<div class="custom-control custom-switch" hidden>
                                <input type="checkbox" class="custom-control-input" id="profile_estado" name="profile_estado">
                                <label class="custom-control-label" for="profile_estado">
                                </label>
                        	 </div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-11">
										<input id="profile_alias" type="text" name="profile_alias" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-image"></i>
									</div>
									<div class="col-sm-11">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="profile_foto"
												name="profile_foto" required>
											<label class="custom-file-label" for="profile_foto">Escoge un archivo</label>
											<div class="invalid-feedback">Example invalid custom file feedback</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-body text-center">
								<button type="button" class="btn btn-secondary tooltipped" data-tooltip="Cancelar" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary tooltipped" data-tooltip="Guardar">Guardar</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="modal-password" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">CAMBIAR CONTRASEÑA</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<form method="post" id="form-password">
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-11">
                            			<input id="clave_actual_1" type="password" name="clave_actual_1" class="form-control validate" required placeholder="Clave Actual">
									</div>
								</div>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-11">
                            			<input id="clave_actual_2" type="password" name="clave_actual_2" class="form-control validate" required placeholder="Confirmar Clave">
									</div>
								</div>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-11">
                            			<input id="clave_nueva_1" type="password" name="clave_nueva_1" class="form-control validate" required placeholder="Nueva Clave">
									</div>
								</div>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-11">
                            			<input id="clave_nueva_2" type="password" name="clave_nueva_2" class="form-control validate" required placeholder="Confirmar Clave">
									</div>
								</div>
							</div>
								<div class="modal-body text-center">
                    				<button type="button" class="btn btn-secondary tooltipped" data-tooltip="Cancelar" data-dismiss="modal">Cancelar</button>
                    				<button type="submit" class="btn btn-primary tooltipped" data-tooltip="Cambiar">Guardar</button>
                				</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="modal-password1" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">CAMBIAR CONTRASEÑA</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<form method="post" id="form-password1">
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-11">
                            			<input id="clave_actual" type="password" name="clave_actual" class="form-control validate" required placeholder="Clave Actual">
									</div>
								</div>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-11">
                            			<input id="clave_actual1" type="password" name="clave_actual1" class="form-control validate" required placeholder="Confirmar Clave">
									</div>
								</div>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-11">
                            			<input id="clave_nueva" type="password" name="clave_nueva" class="form-control validate" required placeholder="Nueva Clave">
									</div>
								</div>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa fa-user"></i>
									</div>
									<div class="col-sm-11">
                            			<input id="clave_nueva1" type="password" name="clave_nueva1" class="form-control validate" required placeholder="Confirmar Clave">
									</div>
								</div>
							</div>
								<div class="modal-body text-center">
                    				<button type="button" class="btn btn-secondary tooltipped" data-tooltip="Cancelar" data-dismiss="modal">Cancelar</button>
                    				<button type="submit" class="btn btn-primary tooltipped" data-tooltip="Cambiar">Guardar</button>
                				</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		');
	}
}
?>