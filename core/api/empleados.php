<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/empleados.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['action'])) {
	session_start();
	$empleado = new Empleados;
	$result = array('status' => 0, 'exception' => '');
	//Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario']) && $_GET['action']) {
		switch ($_GET['action']) {
			case 'read':
				if ($result['dataset'] = $empleado->readEmpleados()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay empleados registradas';
				}
				break;


				//Operación para crear nuevos Empleado
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
																										$result['status'] = 1;
																										$result['message'] = 'Categoría creada correctamente';
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
													$result['exception'] = 'Teléfono incorrecto';
												}
										} else {
											$result['exception'] = 'Dirección incorrecto';
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
				

				
           //Operación para mostrar los cargos activos en el formulario de modificar Empleado
				 case 'readCargo':
				 if ($result['dataset'] = $empleado->readCargo()) {
					 $result['status'] = 1;
				 } else {
					 $result['exception'] = 'Contenido no disponible';
				 }
				 break;

           //Operación para mostrar los tipos de usuario activos en el formulario de modificar Empleado
				 case 'readUsuarios':
				 if ($result['dataset'] = $empleado->readUsuarios()) {
					 $result['status'] = 1;
				 } else {
					 $result['exception'] = 'Contenido no disponible';
				 }
				 break;

				 /* Operacion para obtener el id del empleado */
				case 'get':
					 if ($empleado->setId($_POST['id_empleado']) 
					 ) {
						if ($result['dataset'] = 
						$empleado->getEmpleado()) {
							$result['status'] = 1;
						} else {
							$result['exception'] = 'Empleado no existente';
 						}
					 } else {
						 $result['exception'] = 'Empleado incorrecto';
					 }
					break;

				 /* Operacion para actualizar un empleado */
				case 'update':
					$_POST = $empleado->validateForm($_POST);
					if ($empleado->setId($_POST['id_empleado'])) 
					{
						if ($empleado->getEmpleado()) {
							if ($empleado->setNombres($_POST['update_nombre'])) {
								if ($empleado->setApellido($_POST['update_apellido'])) {
									if ($empleado->setDui($_POST['update_dui'])) {
										if ($empleado->setDireccion($_POST['update_direccion'])) {
											if ($empleado->setTelefono($_POST['update_telefono'])) {
												if ($empleado->setGenero($_POST['update_genero'])) {
													if ($empleado->setNacimiento($_POST['update_fecha'])) {
														if ($empleado->setNacionalidad($_POST['update_nacionalidad'])) {
															if ($empleado->setCorreo($_POST['update_email'])) {
																if ($empleado->setCargo($_POST['update_cargo'])) {
																	if ($empleado->setUsuario($_POST['update_usuario'])) {
																		if ($empleado->updateEmpleado()) {
																			$result['status'] = 1;
																			$result['message'] = 'Empleado modificado correctamente';
																		} else {
																				$result['exception'] = 'Operación fallida';	
																		}
																	} else {
																		$result['exception'] = 'Usuario fallido';
																	}
																} else {
																	$result['exception'] = 'Cargo incorrecto';
																}
															}	else {
																$result['exception'] = 'Correo Incorrecto';
															}
														}	else {
															$result['exception'] = 'Nacionalidad incorrecta';
														}
													}	else {
														$result['exception'] = 'Fecha incorrecta';
													}
												}	else {
													$result['exception'] = 'Genero Correcto';
												}
											}	else {
												$result['exception'] = 'Teléfono incorrecto';
											}
										}	else {
											$result['exception'] = 'Dirección incorrecta';
										}
									}	else {
										$result['exception'] = 'Dui incorrecto';
									}
								}	else {
									$result['exception'] = 'Apellido incorrecto';
								}
							}	else {
								$result['exception'] = 'Nombre incorrecto';
							}
						} 
						
					}
					break;

				 /* Operacion para eliminar un empleado */
				 case 'delete':
				 if ($empleado->setId($_POST['id_empleado'])) {
					 if ($empleado->getEmpleado()) {
						 if ($empleado->deleteEmpleado()) {
							$result['status'] = 1;
							$result['message'] = 'Empleado eliminado correctamente';
						 } else {
							 $result['exception'] = 'Operación fallida';
						 }
					 } else {
						 $result['exception'] = 'Empleado inexistente';
					 }
				 } else {
					 $result['exception'] = 'Empleado incorrecto';
				 }
				 break;
			 default:
				 exit('Acción no disponible');
				
		}
		print(json_encode($result));

	} else {
		exit('Acceso no disponible');
	}
} else {
	exit('Recurso denegado');
}
?>