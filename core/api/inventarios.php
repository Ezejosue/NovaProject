<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/inventarios.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
	session_start();
	$inventarios = new Inventarios;
	$result = array('status' => 0, 'exception' => '');
	// Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario'])) {
		switch ($_GET['action']) {
			case 'readFacturas':
				if ($result['dataset'] = $inventarios->readFacturas()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay facturas registrados';
				}
            break;
            case 'createFactura':
				$_POST = $inventarios->validateForm($_POST);
        		if ($inventarios->setCorrelativo($_POST['create_correlativo'])) {
					if ($inventarios->setId_proveedor($_POST['create_proveedor'])) {
                        if ($inventarios->setId_usuario($_SESSION['idUsuario'])) {
                            if ($inventarios->createFactura()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Factura agregado correctamente';
                            }
                            else {
                                    $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
					} else {
						$result['exception'] = 'Proveedor incorrecto';
					}
				} else {
					$result['exception'] = 'Correlativo incorrecto, escribe solo números de 8 dígitos.';
				}
            break;
            case 'readProveedores':
				if ($result['dataset'] = $inventarios->readProveedores()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay proveedores registrados';
				}
            break;
            case 'readSelectFacturas':
				if ($result['dataset'] = $inventarios->readSelectFacturas()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay facturas registrados';
				}
            break;
            case 'readMateriaPrima':
                if ($result['dataset'] = $inventarios->readMateriasPrimas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
            break;
            case 'readInventario':
				if ($result['dataset'] = $inventarios->readInventario()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay facturas ingresadas';
				}
            break;
            case 'ingresarFactura':
                $_POST = $inventarios->validateForm($_POST);
                if ($inventarios->setId_factura($_POST['create_factura'])) {
                    if ($inventarios->setIdmateria($_POST['create_materia'])) {
                        if ($inventarios->setCantidad($_POST['create_cantidad'])) {
                            if ($inventarios->setPrecio($_POST['create_precio'])) {
                                if ($inventarios->createInventario()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Factura agregado correctamente';
                                }
                                else {
                                    $result['exception'] = 'Operación fallida';
                                }
                            } else {
                                $result['exception'] = 'Precio incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Cantidad incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Materia prima incorrecta';
                    }
                } else {
                    $result['exception'] = 'Correlativo incorrecto';
                }
            break;
            case 'getFactura':
                if ($inventarios->setId_factura($_POST['id_factura'])) {
                    if ($result['dataset'] = $inventarios->getFactura()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Factura inexistente';
                    }
                } else {
                    
                    $result['exception'] = 'Factura incorrecta';
                }
                break;
            case 'readDetalleFactura':
                if ($inventarios->setId_factura($_POST['id_factura'])) {
                    if ($result['dataset'] = $inventarios->readFactura()) {
                        
                        $result['status'] = 1;
                        /* print_r($result['dataset']); */
                    } else {
                        $result['exception'] = 'No hay detalles registrados';
                    }
                }else{
                    $result['exception'] = 'Factura incorrecta';
                }
            break;
            case 'updateFactura':
                $_POST = $inventarios->validateForm($_POST);
                if ($inventarios->setId_factura($_POST['id_factura'])) {
                    if ($inventarios->updateFactura()) {
                        if ($inventarios->setCorrelativo($_POST['update_materia'])) {
                            if ($inventarios->setId_proveedor($_POST['update_cantidad'])) {
                                if ($inventarios->updateFactura()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Factura actualizada correctamente';
                                }
                                else {
                                    $result['exception'] = 'Operación fallida';
                                }
                            } else {
                                $result['exception'] = 'Cantidad incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Materia prima incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Factura inexistente';
                    }
                } else {
                    $result['exception'] = 'Factura incorrecta';
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
