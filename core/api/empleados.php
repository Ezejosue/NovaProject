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
			case 'create':
				$_POST = $empleado->validateForm($_POST);
        		if ($empleado->setNombre($_POST['create_nombre'])) {
					if ($empleado->setApellido($_POST['create_apellido'])) {
						if ($empleado->setDui($_POST['create_dui'])) {
							if ($empleado->setDireccion($_POST['create_direccion'])) {
								if ($empleado->setTelefono($_POST['create_telefono'])) {
									if ($empleado->setGenero($_POST['create_genero'])) {
										if ($empleado->setNacimiento($_POST['create_fecha'])) {
											if ($empleado->setCorreo($_POST['create_correo'])) {
											} else {
												$result['exception'] = 'Correo incorrecto';
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
								$result['exception'] = 'Direccion incorrecta';
							}
						} else {
							$result['exception'] = 'Dui incorrecto';
						}
					} else {
						$result['exception'] = 'Apellido incorrecta';
					}
				} else {
					$result['exception'] = 'Nombre incorrecto';
				}
            	break;
            case 'get':
                if ($empleado->setId($_POST['id_categoria'])) {
                    if ($result['dataset'] = $empleado->getCategoria()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Categoría inexistente';
                    }
                } else {
                    $result['exception'] = 'Categoría incorrecta';
                }
            	break;
			case 'update':
				$_POST = $empleado->validateForm($_POST);
				if ($empleado->setId($_POST['id_categoria'])) {
					if ($empleado->getCategoria()) {
		                if ($empleado->setNombre($_POST['update_nombre'])) {
							if ($empleado->setDescripcion($_POST['update_descripcion'])) {
								if (is_uploaded_file($_FILES['update_archivo']['tmp_name'])) {
									if ($empleado->setImagen($_FILES['update_archivo'], $_POST['imagen_categoria'])) {
										$archivo = true;
									} else {
										$result['exception'] = $empleado->getImageError();
										$archivo = false;
									}
								} else {
									if ($empleado->setImagen(null, $_POST['imagen_categoria'])) {
										$result['exception'] = 'No se subió ningún archivo';
									} else {
										$result['exception'] = $empleado->getImageError();
									}
									$archivo = false;
								}
								if ($empleado->updateCategoria()) {
									if ($archivo) {
										if ($empleado->saveFile($_FILES['update_archivo'], $empleado->getRuta(), $empleado->getImagen())) {
											$result['status'] = 1;
										} else {
											$result['status'] = 2;
											$result['exception'] = 'No se guardó el archivo';
										}
									} else {
										$result['status'] = 3;
									}
								} else {
									$result['exception'] = 'Operación fallida';
								}
							} else {
								$result['exception'] = 'Descripción incorrecta';
							}
						} else {
							$result['exception'] = 'Nombre incorrecto';
						}
					} else {
						$result['exception'] = 'Categoría inexistente';
					}
				} else {
					$result['exception'] = 'Categoría incorrecta';
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
				 
			 default:
				 exit('Acción no disponible 2');
				
		}
	} else {
		exit('Acceso no disponible');
	}
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>
