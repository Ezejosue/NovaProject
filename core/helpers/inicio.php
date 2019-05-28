<?php  
class Dashboard 

{
    public static function headerTemplate($title)
	{
        session_start();
    
    if (isset($_SESSION['idUsuario'])) {
        $filename = basename($_SERVER['PHP_SELF']);
        if ($filename != 'index.php') {
            print('<!DOCTYPE html>
            <html lang="es">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
            
                <title>Dashboard - Inicio</title>
            
                <!-- Fontfaces CSS-->
                <link href="../resources/css/font-face.css" rel="stylesheet" media="all">
                <link href="../resources/css/font-awesome.css" rel="stylesheet" media="all">
                <link href="../resources/extras/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
                <link href="../resources/extras/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
                <link href="../resources/extras/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
                <link href="../resources/css/theme.css" rel="stylesheet" media="all">
                <link href="../resources/extras/animsition/animsition.min.css" rel="stylesheet" media="all">
            </head>
            
            <body class="animsition">
                <div class="page-wrapper">
                    <aside class="menu-sidebar2">
                        <div id="logo_pizza_nova" class="logo">
                            <a href="#">
                                <img src="../resources/img/logo.png" alt="Pizza Nova" />
                            </a>
                        </div>
                        <div class="menu-sidebar2__content js-scrollbar1">
                            <div class="account2">
                                <div class="image img-cir img-120">
                                    <img src="../resources/img/icon/avatar-big-01.jpg" alt="John Doe" />
                                </div>
                                <h4 class="name">john doe</h4>
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
                                        <a href="categorias.php">
                                            <i class="fas fa-list"></i>Categorías</a>
                                    </li>
                                    <li>
										<a href="#itemsDrop" data-toggle="collapse" class="collapsed"><i class="fas fa-shopping-basket"></i><span>
										Productos</span><i class="fa fa-caret-down right"></i></a>
											<div id="itemsDrop" class="collapse">
												<ul>
													<li>													
														<a href="productos.php">
														<i class="fas fa-shopping-basket"></i>Materia prima</a>
													</li>
													<li>
														<a href="platillos.php">
														<i class="fas fa-shopping-basket"></i>Platillos</a>
													</li>
												</ul>
											</div>
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
						<form method="post" id="form-profile">
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
												name="profile_foto">
											<label class="custom-file-label" for="profile_foto">Escoga un archivo</label>
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
		');
	}
}
?>