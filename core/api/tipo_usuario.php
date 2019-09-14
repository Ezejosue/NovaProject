<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/tipo_usuario.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
	session_start();
	$tipo_usuario = new Tipo_usuario;
	$result = array('status' => 0, 'exception' => '');
	// Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario'])) {
		switch ($_GET['action']) {
			case 'read':
				if ($result['dataset'] = $tipo_usuario->readTipo_usuario()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay tipos de usuarios registrados';
				}
				break;

				/* Operacion para crear un tipo_usuario */
			case 'create':
				$_POST = $tipo_usuario->validateForm($_POST);
        		if ($tipo_usuario->setNombre($_POST['create_nombre'])) {
					if ($tipo_usuario->setDescripcion($_POST['create_descripcion'])) {
						if ($tipo_usuario->setEstado(isset($_POST['create_estado']) ? 1:0)) {
							if ($tipo_usuario->createTipo_usuario()) {
								$result['id'] = conexion::getLastRowId();
								$result['status'] = 1;
								$result['message'] = 'Tipo de usuario creado correctamente';
							} else {
								$result['exception'] = 'Operacion fallida';
							}
						} else {
							$result['exception'] = 'Estado incorrecto';
						}
					} else {
						$result['exception'] = 'Descripción incorrecta';
					}
				} else {
					$result['exception'] = 'Nombre incorrecto';
				}
				break;
				
				/* Operacion para obtener el tipo_usuario */
            case 'get':
                if ($tipo_usuario->setId($_POST['id_Tipousuario'])) {
                    if ($result['dataset'] = $tipo_usuario->getTipo_usuario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Tipo de usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Tipo de usuario incorrecto';
                }
				break;

			case 'getAcciones':
                if ($tipo_usuario->setId($_POST['id_Tipousuario'])) {
                    if ($result['dataset'] = $tipo_usuario->readAcciones()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Vistas inexistente';
                    }
                } else {
                    $result['exception'] = 'Tipo de usuario incorrecto';
                }
				break;
			case 'updateAcciones':
				if ($tipo_usuario->setId($_POST['id_Tipousuario'])) {
					if ($result['dataset'] = $tipo_usuario->readAcciones()) {
						foreach($result['dataset'] as $datos){
							$tipo_usuario->setEstado("1");
							$tipo_usuario->setIdVista($datos['id_vista']);
							$tipo_usuario->setId($datos['id_Tipousuario']);
							$tipo_usuario->updateAcciones();
						}
						$result['status'] = 1;
					} else {
						$result['exception'] = 'Vistas inexistente';
					}
				} else {
					$result['exception'] = 'Tipo de usuario incorrecto';
				}
				break;
				/* Operacion para actualizar un tipo_usuario */
			case 'update':
				$_POST = $tipo_usuario->validateForm($_POST);
				if ($tipo_usuario->setId($_POST['id_tipo_usuario'])) {
					if ($tipo_usuario->getTipo_usuario()) {
		                if ($tipo_usuario->setNombre($_POST['update_nombre_tipo'])) {
							if ($tipo_usuario->setDescripcion($_POST['update_descripcion'])) {
								if ($tipo_usuario->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
								if ($tipo_usuario->updateTipo_usuario()) {
									$result['status'] = 1;
									$result['message'] = 'Tipo de usuario modificado correctamente';
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
						$result['exception'] = 'Tipo de usuario inexistente';
					}
				} else {
					$result['exception'] = 'Tipo de usuario incorrecto';
				}
				break;
				

				/* Operacion para eliminar un tipo_usuario */
            case 'delete':
				if ($tipo_usuario->setId($_POST['id_Tipousuario'])) {
					if ($tipo_usuario->getTipo_usuario()) {
						if ($tipo_usuario->deleteTipo_usuario()) {
							$result['message'] = 'Tipo de usuario eliminado correctamente';
						} else {
							$result['exception'] = 'Operación fallida';
						}
					} else {
						$result['exception'] = 'Tipo de usuario inexistente';
					}
				} else {
					$result['exception'] = 'Tipo de usuario incorrecto';
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