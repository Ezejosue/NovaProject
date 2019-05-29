<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/empleados.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['site']) && isset($_GET['action'])) {
	session_start();
	$empleado = new Empleados;
	$result = array('status' => 0, 'exception' => '');
	//Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario']) && $_GET['site'] == 'private') {
		switch ($_GET['action']) {
			case 'read':
				if ($result['dataset'] = $empleado->readEmpleados()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay empleados registradas';
				}
				break;


				//Operación para crear nuevos usuarios
		case 'create':
				$_POST = $empleado->validateForm($_POST);
				if ($empleado->setNombres($_POST['create_nombre'])) {
						if ($empleado->setApellido($_POST['create_apellido'])) {
								if ($empleado->setDui($_POST['create_dui'])) {
										if ($empleado->setDireccion($_POST['create_direccion'])) {
												if ($empleado->setTelefono($_POST['create_telefono'])) {
														if ($empleado->setGenero($_POST['create_genero'])) {
																if ($empleado->setNacimiento($_POST['create_fecha'])) {
																		if ($empleado->setNacionalidad($_POST['create_nacionalidad'])) {
																				if ($empleado->setCorreo($_POST['create_email'])) {
																						if ($empleado->setCargo($_POST['create_cargo'])) {
																								if ($empleado->setUsuario($_POST['create_usuario'])) {
																									if($empleado->createEmpleado()){
																									}else{
																										$result['exception'] = 'Error al insertar';
																									}
																								} else {
																									$result['exception'] = 'Usuario incorrecto';
																								}
																						} else {
																							 $result['exception'] = 'Cargo incorrecto';
																						}
																				} else {
																					 $result['exception'] = 'Correo incorrecto';
																				}
																		} else {
																			$result['exception'] = 'Nacionalidad incorrecta';
																		}
																} else {
																	$result['exception'] = 'Fecha incorrecta';
																}
														} else {
															$result['exception'] = 'Genero incorrecto';
														}
												} else {
													$result['exception'] = 'Telefono incorrecto';
												}
										} else {
											$result['exception'] = 'Direccion incorrecto';
										}
								} else {
									$result['exception'] = 'Dui incorrecto';
								}
						} else {
							$result['exception'] = 'Apellido incorrecto';
						}
				} else {
					$result['exception'] = 'Nombre incorrecto';
				}
			
			break;
				

				
           //Operación para mostrar los tipos de usuario activos en el formulario de modificar usuario
				 case 'readCargo':
				 if ($result['dataset'] = $empleado->readCargo()) {
					 $result['status'] = 1;
				 } else {
					 $result['exception'] = 'Contenido no disponible';
				 }
				 break;

           //Operación para mostrar los tipos de usuario activos en el formulario de modificar usuario
				 case 'readUsuarios':
				 if ($result['dataset'] = $empleado->readUsuarios()) {
					 $result['status'] = 1;
				 } else {
					 $result['exception'] = 'Contenido no disponible';
				 }
				 break;
				
		}
	} else {
		exit('Acceso no disponible');
	}
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>