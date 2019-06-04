<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/recetas.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
	session_start();
	$recetas = new Recetas;
	$result = array('status' => 0, 'exception' => '');
	// Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario'])) {
		switch ($_GET['action']) {
			case 'read':
				if ($result['dataset'] = $recetas->readCategorias()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay categorías registradas';
				}
				break;
			case 'create':
				$_POST = $recetas->validateForm($_POST);
        		if ($recetas->setNombre($_POST['create_nombre'])) {
					if ($recetas->setDescripcion($_POST['create_descripcion'])) {
						if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
							if ($recetas->setImagen($_FILES['create_archivo'], null)) {
								if ($recetas->setEstado(isset($_POST['create_estado']) ? 1:0)) {
								if ($recetas->createCategoria()) {
									$result['id'] = conexion::getLastRowId();
									$result['status'] = 1;
									if ($recetas->saveFile($_FILES['create_archivo'], $recetas->getRuta(), $recetas->getImagen())) {
										$result['message'] = 'Categoría creada correctamente';
									} else {
										$result['message'] = 'Categoría creada. No se guardó el archivo';
									}
								}
								else {
									$result['exception'] = 'Operacion fallida';
								}
								} else {
									$result['exception'] = 'Estado incorrecto';
								}
							} else {
								$result['exception'] = $recetas->getImageError();
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
                if ($recetas->setId($_POST['id_categoria'])) {
                    if ($result['dataset'] = $recetas->getCategoria()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Categoría inexistente';
                    }
                } else {
                    $result['exception'] = 'Categoría incorrecta';
                }
            	break;
			case 'update':
				$_POST = $recetas->validateForm($_POST);
				if ($recetas->setId($_POST['id_categoria'])) {
					if ($recetas->getCategoria()) {
		                if ($recetas->setNombre($_POST['update_nombre_categoria'])) {
							if ($recetas->setDescripcion($_POST['update_descripcion'])) {
								if ($recetas->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
								if (is_uploaded_file($_FILES['imagen_categoria']['tmp_name'])) {
									if ($recetas->setImagen($_FILES['imagen_categoria'], $_POST['foto_categoria'])) {
										$archivo = true;
									} else {
										$result['exception'] = $recetas->getImageError();
										$archivo = false;
									}
								} else {
									if (!$recetas->setImagen(null, $_POST['foto_categoria'])) {
										$result['exception'] = $recetas->getImageError();
									}
									$archivo = false;
								}
								if ($recetas->updateCategoria()) {
									$result['status'] = 1;
									if ($archivo) {
										if ($recetas->saveFile($_FILES['imagen_categoria'], $recetas->getRuta(), $recetas->getImagen())) {
											$result['message'] = 'Categoría modificada correctamente';
										} else {
											$result['message'] = 'Categoría modificada. No se guardó el archivo';
										}
									} else {
										$result['message'] = 'Categoría modificada. No se subió ningún archivo';
									}
								} else {
									$result['exception'] = 'Operación fallida';
								}
							} else{
								$result['exception'] = 'Estado incorrecto';
							} 
						}else {
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
				if ($recetas->setId($_POST['id_categoria'])) {
					if ($recetas->getCategoria()) {
						if ($recetas->deleteCategoria()) {
							$result['status'] = 1;
							if ($recetas->deleteFile($recetas->getRuta(), $_POST['foto_categoria'])) {
								$result['message'] = 'Categoría eliminada correctamente';
							} else {
								$result['message'] = 'Categoría eliminada. No se borró el archivo';
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
		print(json_encode($result));
	} else {
		exit('Acceso no disponible');
	}
} else {
    exit('Recurso denegado');
    
    
}
?>
