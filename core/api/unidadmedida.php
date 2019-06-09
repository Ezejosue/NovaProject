<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/unidadmedida.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
	session_start();
	$unidad = new UnidadMedida;
	$result = array('status' => 0, 'exception' => '');
	// Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario'])) {
		switch ($_GET['action']) {
			case 'read':
				if ($result['dataset'] = $unidad->readUnidades()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay unidades de medida registradas';
				}
				break;
			case 'create':
				$_POST = $unidad->validateForm($_POST);
        		if ($unidad->setNombreMedida($_POST['create_nombre'])) {
					if ($unidad->setDescripcion($_POST['create_descripcion'])) {
						if ($unidad->createMedida()) {
							    $result['id'] = conexion::getLastRowId();
								$result['status'] = 1;
								$result['message'] = 'Unidad de medida creada correctamente';
                        }
						 else {
								$result['exception'] = 'Operacion fallida';
						}
					} else {
						$result['exception'] = 'Descripción incorrecta';
					}
				} else {
					$result['exception'] = 'Nombre incorrecto';
				}
            	break;
            case 'get':
                if ($unidad->setIdMedida($_POST['id_Medida'])) {
                    if ($result['dataset'] = $unidad->getMedida()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Unidad de medida inexistente';
                    }
                } else {
                    $result['exception'] = 'Unidad de medida incorrecta';
                }
            	break;
			case 'update':
				$_POST = $unidad->validateForm($_POST);
				if ($unidad->setIdMedida($_POST['id_unidad'])) {
					if ($unidad->getMedida()) {
		                if ($unidad->setNombreMedida($_POST['update_unidad'])) {
							if ($unidad->setDescripcion($_POST['update_descripcion'])) {
								if ($unidad->updateMedida()) {
									$result['status'] = 1;
											$result['message'] = 'Unidad de medida modificada correctamente';
										} else {
											$result['message'] = 'Unidad de medida modificada. No se guardó el archivo';
										}
						}else {
								$result['exception'] = 'Descripción incorrecta';
							}
						} else {
							$result['exception'] = 'Nombre de unidad de medida incorrecto';
						}
					} else {
						$result['exception'] = 'Unidad de medida inexistente';
					}
				} else {
					$result['exception'] = 'Unidad de medida incorrecta';
				}
            	break;
            case 'delete':
				if ($unidad->setIdMedida($_POST['id_unidad'])) {
					if ($unidad->getMedida()) {
						if ($unidad->deleteMedida()) {
                                $result['status'] = 1;
                                $result['message'] = 'Unidad de medida eliminada correctamente';
							} else {
								$result['message'] = 'Unidad de medida eliminada. No se borró el archivo';
							}
					} else {
						$result['exception'] = 'Unidad de medida inexistente';
					}
				} else {
					$result['exception'] = 'Unidad de medida incorrecta';
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
