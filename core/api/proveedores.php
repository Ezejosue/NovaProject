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
                if ($proveedores->setId($_POST['id_proveedor'])) {
                   if ($result['dataset'] = $proveedores->getProveedor()) {
                       $result['status'] = 1;
                   } else {
                       $result['exception'] = 'Proveedor no existente';
                    }
                } else {
                    $result['exception'] = 'Proveedor incorrecto';
                }
               break;

            case 'update':
					$_POST = $proveedores->validateForm($_POST);
					if ($proveedores->setId($_POST['id_proveedor'])) {
                        if ($proveedores->getProveedor()) {
                            if ($proveedores->setNomProveedor($_POST['update_proveedor'])) {
                                if ($proveedores->setContanto($_POST['update_contacto'])) {
                                    if ($proveedores->setTelefono($_POST['update_telefono'])) {
                                        if ($proveedores->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
                                            if ($proveedores->updateProveedor()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Proveedor actualizado correctamente';
                                            } else {
                                                $result['exception'] = 'Operación fallida';                    
                                            }  
                                        } else {
                                            $result['exception'] = 'Estado incorrecto';
                                        }  
                                    } else {
                                        $result['exception'] = 'Teléfono incorrecto';
                                    }  
                                } else {
                                    $result['exception'] = 'Contacto incorrecto';
                                }                          
                            } else {
                                $result['exception'] = 'Nombre de proveedor incorrecto';              
                            }                            
                        } else {
                            $result['exception'] = 'Proveedor inexistente'; 
                        }                    
					} else {
                        $result['exception'] = 'Proveedor incorrecto';
                    }
                    break;
                    
            case 'delete':
                    if ($proveedores->setId($_POST['id_proveedor'])) {
                        if ($proveedores->getProveedor()) {
                            if ($proveedores->deleteProveedor()) {
                                $result['status'] = 1;
                                $result['message'] = 'Proveedor eliminado correctamente';
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'Proveedor inexistente';
                        }
                    } else {
                        $result['exception'] = 'Proveedor incorrecto';
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