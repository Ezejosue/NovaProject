<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/inventarios.php');

/* Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error */
if (isset($_GET['action'])) {
	session_start();
	$inventarios = new Inventarios;
	$result = array('status' => 0, 'exception' => '');
	/* Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes */
	if (isset($_SESSION['idUsuario'])) {
		switch ($_GET['action']) {
            /* Case para leer facturas */
			case 'readFacturas':
				if ($result['dataset'] = $inventarios->readFacturas()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay facturas registrados';
				}
            break;
            /* Case para ejectuar método del modelo y crear factura */
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
            /* Case para llenar select de proveedores */
            case 'readProveedores':
				if ($result['dataset'] = $inventarios->readProveedores()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay proveedores registrados';
				}
            break;
            /* Case para llenar select de facturas disponibles */
            case 'readSelectFacturas':
				if ($result['dataset'] = $inventarios->readSelectFacturas()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay facturas registrados';
				}
            break;
            /* Casa para llenar select de productos/materias primas disponibles */
            case 'readMateriaPrima':
                if ($result['dataset'] = $inventarios->readMateriasPrimas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
            break;
            /* Case para ejecturar método del modelo y crear detalle de factura */
            case 'createDetalle':
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
            /* Case para obtener datos de una factura */
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
            /* Case para obtener datos de una filla del detalle de una factura */
            case 'getInventario':
                if ($inventarios->setId_inventario($_POST['id_inventario'])) {
                    if ($result['dataset'] = $inventarios->getInventario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecta';
                }
            break;
            /* Case para leer detalle de una factura */
            case 'readDetalleFactura':
                if ($inventarios->setId_factura($_POST['id_factura'])) {
                    if ($result['dataset'] = $inventarios->readFactura()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'No hay detalles registrados';
                    }
                }else{
                    $result['exception'] = 'Factura incorrecta';
                }
            break;
            /* Case para modificar una fila de un detalle de */
            case 'updateInventario':
                $_POST = $inventarios->validateForm($_POST);
                if ($inventarios->setId_inventario($_POST['id_inventario'])) {
                    if ($inventarios->getInventario()) {
                        if ($inventarios->setIdmateria($_POST['update_materia'])) {
                            if ($inventarios->setCantidad($_POST['update_cantidad'])) {
                                if ($inventarios->setPrecio($_POST['update_precio'])) {
                                    if ($inventarios->updateInventario()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Producto actualizado correctamente';
                                    }
                                    else {
                                        $result['exception'] = 'Operación fallida';
                                    }
                                } else {
                                    $result['exception'] = 'Precio incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Cantidad incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Producto incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecta';
                }            
            break;
            /* Case para actualizar correlativo o proveedor de una factura */
            case 'updateFactura':
                $_POST = $inventarios->validateForm($_POST);
                if ($inventarios->setId_factura($_POST['id_factura'])) {
                    if ($inventarios->getFactura()) {
                        if ($inventarios->setCorrelativo($_POST['update_correlativo'])) {
                            if ($inventarios->setId_proveedor($_POST['update_proveedor'])) {
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
            /* Case para cambiar estado de una factura */
            case 'updateEstado':
                $_POST = $inventarios->validateForm($_POST);
                if ($inventarios->setId_factura($_POST['hid_factura'])) {
                    if ($inventarios->getFactura()) {
                        if ($inventarios->setEstado($_POST['hestado'])) {
                            if ($inventarios->updateEstado()) {
                                $result['status'] = 1;
                                $result['message'] = 'Factura actualizada correctamente';
                            }
                            else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'Estado incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Factura inexistente';
                    }
                } else {
                    $result['exception'] = 'Factura incorrecta';
                }
            break;
            /* Case para borrar una fila de un detalle de factura */
            case 'deleteProducto':
                if ($inventarios->setId_inventario($_POST['id_inventario'])) {
                    if ($inventarios->getInventario()) {
                        if ($inventarios->deleteInventario()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'Operación fallida';
                        }
                    } else {
                        $result['exception'] = 'Materia prima inexistente';
                    }
                } else {
                    $result['exception'] = 'Materia prima incorrecta';
                }
            break;
            /* Case para obtener datos generales de bodega */
            case 'readBodega':
                if ($result['dataset'] = $inventarios->readBodega()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay materias primas registradas';
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
