<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/cargo.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
    session_start();
    $cargo = new Cargo;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes    
    if (isset($_SESSION['idUsuario']) && $_GET['action']) {
        switch ($_GET['action']) {
            case 'read':
                if ($result['dataset'] = $cargo->readCargo()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay cargos registrados';
				}
                break;
            
            case 'create':
				$_POST = $cargo->validateForm($_POST);
                if ($cargo->setCargo($_POST['create_cargo'])) {
                    if ($cargo->createCargo()) {
                        $result['status'] = 1;
                        $result['message'] = 'Cargo creado correctamente';
                    } else {
                        $result['exception'] = 'Error al insertar';
                    }
                } else {
                    $result['exception'] = 'Cargo incorrecto';
                }
                break;
                
            /* Operación para obtener el id del empleado */
				case 'get':
                if ($cargo->setId($_POST['id_Cargo']) 
                ) {
                   if ($result['dataset'] = 
                   $cargo->searchCargo()) {
                       $result['status'] = 1;
                   } else {
                       $result['exception'] = 'Cargo no existente';
                    }
                } else {
                    $result['exception'] = 'Cargo incorrecto';
                }
               break;

               case 'update':
					$_POST = $cargo->validateForm($_POST);
					if ($cargo->setId($_POST['id_Cargo'])) 
					{
                        if ($cargo->searchCargo()) {
                            if ($cargo->setCargo($_POST['update_nombre_cargo'])) {
                                if ($cargo->updateCargo()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Cargo actualizado correctamente';
                                } else {
                                    $result['exception'] = 'Operación fallida';                    
                                }
                                
                            } else {
                                $result['exception'] = 'Cargo incorrecto';                    
                            }
                            
                        }
                        
					}
                    break;
                    
                case 'delete':
                    if ($cargo->setId($_POST['id_Cargo'])) {
                        if ($cargo->searchCargo()) {
                            if ($cargo->deleteCargo()) {
                               $result['status'] = 1;
                               $result['message'] = 'Cargo eliminado correctamente';
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'Cargo inexistente';
                        }
                    } else {
                        $result['exception'] = 'Cargo incorrecto';
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