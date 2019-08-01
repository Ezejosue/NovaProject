<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/desperdicios.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['action'])) {
    session_start();
    $desperdicios = new Desperdicios;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idUsuario'])) {
        switch ($_GET['action']) {
            
            case 'read':
                if ($result['dataset'] = $desperdicios->readDesperdicios()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay desperdicios registrados';
                }
                break;

            //Operación para crear nuevos usuarios
            case 'create':
                $_POST = $desperdicios->validateForm($_POST);
                    if ($desperdicios->setid_platillo($_POST['create_id_platillo'])) {
                            if ($desperdicios->setid_usuario($_POST['create_id_usuario'])) {
                                if ($desperdicios->setid_empleado($_POST['create_id_empleado'])) {
                                    if ($desperdicios->createDesperdicios()) {
                                        $result['status'] = 1;
                                    } else {
                                        $result['exception'] = 'Operación fallida';
                                    }
                                } 
                                    else {
                                        $result['exception'] = 'Seleccione un empleado';
                                    }
                            } else {
                            $result['exception'] = 'Seleccione un usuario';
                        }  
                    } else {
                        $result['exception'] = 'Seleccione un empleado';
                    }
                break;
                
            //Operación para saber el usuario que se va a modificar
            case 'get':
                if ($desperdicios->setId($_POST['id_desperdicios'])) {
                    if ($result['dataset'] = $desperdicios->getDesperdicios()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'desperdicios prima inexistente';
                    }
                } else {
                    $result['exception'] = 'desperdicios prima incorrecta';
                }
                break;
            //Operación para actualizar un usuario
            case 'update':
				$_POST = $desperdicios->validateForm($_POST);
				if ($desperdicios->setId($_POST['id_desperdicios'])) {
					if ($desperdicios->getDesperdicios()) {
		                if ($desperdicios->setid_platillo($_POST['update_id_platillo'])) {
                            if ($desperdicios->setid_usuario($_POST['update_id_usuario'])) {
                                if ($desperdicios->setid_empleado($_POST['update_id_empleado'])) {
                                if ($desperdicios->updateDesperdicios()) {
                                    $result['status'] = 1;
                                            } else {
                                                $result['message'] = 'Desperdicio modificado correctamente';
                                                }
                                            } else {
                                                $result['exception'] = 'Seleccione un empleado';
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione un usuario';
                                        }
                                    } else {
                                        $result['exception'] = 'Seleccione un platillo';
                                        }
                            } else {
                                $result['exception'] = 'Desperdicio inexistente';
                                }
                        }else {
                            $result['exception'] = 'Acción no disponible';
                        }
                    break;
            //Operación para eliminar un usuario
            case 'delete':
            //Se comprueba que el usuario a eliminar no sea igual al que ha iniciado sesión
                    if ($desperdicios->setId($_POST['id_desperdicios'])) {
                        if ($desperdicios->getDesperdicios()) {
                            if ($desperdicios->deleteDesperdicios()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'Desperdicios inexistente';
                        }
                    } else {
                        $result['exception'] = 'Desperdicio incorrecto';
                    }
                break;

            //Operación para mostrar los tipos de usuario activos en el formulario de modificar usuario
            case 'readPlatillo':
                if ($result['dataset'] = $desperdicios->readPlatillos()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;

            case 'readUsuario':
                if ($result['dataset'] = $desperdicios->readNombreUsuario()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;

                
            case 'readEmpleados':
            if ($result['dataset'] = $desperdicios->readEmpleados()) {
                $result['status'] = 1;
            } else {
                $result['exception'] = 'Contenido no disponible';
            }
            break;
                
            default:
                exit('Acción no disponible 1');
        }
    } 
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>