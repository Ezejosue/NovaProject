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
					if ($empleado->setDescripcion($_POST['create_descripcion'])) {
						if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
							if ($empleado->setImagen($_FILES['create_archivo'], null)) {
								if ($empleado->createCategoria()) {
									if ($empleado->saveFile($_FILES['create_archivo'], $empleado->getRuta(), $empleado->getImagen())) {
										$result['status'] = 1;
									} else {
										$result['status'] = 2;
										$result['exception'] = 'No se guardó el archivo';
									}
								} else {
									$result['exception'] = 'Operación fallida';
								}
							} else {
								$result['exception'] = $empleado->getImageError();
							}
						} else {
							$result['exception'] = 'Seleccione una imagen';
						}
					} else {
						$result['exception'] = 'Descripción incorrecta';
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
            case 'delete':
				if ($empleado->setId($_POST['id_categoria'])) {
					if ($empleado->getCategoria()) {
						if ($empleado->deleteCategoria()) {
							if ($empleado->deleteFile($empleado->getRuta(), $_POST['imagen_categoria'])) {
								$result['status'] = 1;
							} else {
								$result['status'] = 2;
								$result['exception'] = 'No se borró el archivo';
							}
						} else {
							$result['exception'] = 'Operación fallida';
						}
					} else {
						$result['exception'] = 'Categoría inexistente';
					}
				} else {
					$result['exception'] = 'Categoría incorrecta';
				}
            	break;
			default:
				exit('Acción no disponible');
		}
	} else {
		exit('Acceso no disponible');
	}
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>
