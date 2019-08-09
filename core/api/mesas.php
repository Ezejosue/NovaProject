<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/mesas.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
	session_start();
	$mesas = new Mesas;
	$result = array('status' => 0, 'exception' => '');
	// Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario'])) {
		switch ($_GET['action']) {
			case 'read':
				if ($result['dataset'] = $mesas->readMesas()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay mesas registradas';
				}
			break;
			case 'create':
				$_POST = $mesas->validateForm($_POST);
        		if ($mesas->setNumero_mesa($_POST['create_nombre'])) {
                    if ($mesas->setEstado_mesa(isset($_POST['create_estado']) ? 1 : 0)) {
						if ($mesas->createMesas()) {
								$result['status'] = 1;
								$result['message'] = 'Mesa creada correctamente';
                        }
						 else {
								$result['exception'] = 'Operacion fallida';
						}
					} else {
						$result['exception'] = 'Estado incorrecto';
					}
				} else {
					$result['exception'] = 'Nombre de mesa incorrecto';
				}
            break;
            case 'get':
                if ($mesas->setIdMesa($_POST['id_mesa'])) {
                    if ($result['dataset'] = $mesas->getMesa()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Mesa inexistente';
                    }
                } else {
                    $result['exception'] = 'Mesa incorrecta';
                }
            break;
			case 'update':
				$_POST = $mesas->validateForm($_POST);
				if ($mesas->setIdMesa($_POST['id_mesa'])) {
					if ($mesas->getMesa()) {
		                if ($mesas->setNumero_mesa($_POST['update_nombre'])) {
							if ($mesas->setEstado_mesa(isset($_POST['update_estado']) ? 1 : 0)) {
								if ($mesas->updateMesas()) {
									$result['status'] = 1;
                                    $result['message'] = 'Mesa modificada correctamente';
                                } else {
                                    $result['message'] = 'Ocurrió un problema';
                                }
                            } else {
                                $result['exception'] = 'Estado incorrecto';
                            }
						} else {
							$result['exception'] = 'Número de mesa incorrecto';
						}
					} else {
						$result['exception'] = 'Mesa inexistente';
					}
				} else {
					$result['exception'] = 'Mesa incorrecta';
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
