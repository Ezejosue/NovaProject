<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/proveedores.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
    session_start();
    $proveedores = new Proveedores;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes    
    if (isset($_SESSION['idUsuario']) && $_GET['action']) {
        switch ($_GET['action']) {
            case 'read':
                if ($result['dataset'] = $proveedores->readProveedores()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay proveedores registrados';
				}
                break;
            
            case 'create':
				$_POST = $proveedores->validateForm($_POST);
                if ($proveedores->setNomProveedor($_POST['create_proveedor'])) {
                    if ($proveedores->setContacto($_POST['create_contacto'])) {
                        if ($proveedores->setTelefono($_POST['create_telefono'])) {
                            if ($proveedores->setEstado(isset($_POST['create_estado']) ? 1:0)) {
                                if ($proveedores->createProveedor()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Proveedor creado correctamente';
                                } else {
                                    $result['exception'] = 'Error al insertar';
                                }
                            } else {
                                $result['exception'] = 'Estado incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Teléfono incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Nombre de contacto incorrecto';
                    }
                } else {
                    $result['exception'] = 'Proveedor incorrecto';
                }
                break;
                
            /* Operación para obtener el id del empleado */
			case 'get':
                if ($proveedores->setId($_POST['id_Cargo']) 
                ) {
                   if ($result['dataset'] = 
                   $proveedores->searchCargo()) {
                       $result['status'] = 1;
                   } else {
                       $result['exception'] = 'Cargo no existente';
                    }
                } else {
                    $result['exception'] = 'Cargo incorrecto';
                }
               break;

            case 'update':
					$_POST = $proveedores->validateForm($_POST);
					if ($proveedores->setId($_POST['id_Cargo'])) 
					{
                        if ($proveedores->searchCargo()) {
                            if ($proveedores->setCargo($_POST['update_nombre_cargo'])) {
                                if ($proveedores->updateCargo()) {
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
                    if ($proveedores->setId($_POST['id_Cargo'])) {
                        if ($proveedores->searchCargo()) {
                            if ($proveedores->deleteCargo()) {
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