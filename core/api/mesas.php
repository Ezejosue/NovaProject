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
			case 'readMesas':
				if ($result['dataset'] = $mesas->readMesas()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay mesas registradas';
				}
				break;

				case 'readCategorias':
				if ($result['dataset'] = $mesas->readCategorias()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay categorias registradas';
				}
				break;

				case 'readProductos':
				if ($mesas->setCategoria($_POST['idCategoria'])){
					if ($result['dataset'] = $mesas->readProductos()) {
					$result['status'] = 1;
					} else {
						$result['exception'] = 'No hay productos registrados';
					}
				} else{
					
				}
				
				break;
				case 'readPrepedido':
				if ($mesas->setIdMesa($_POST['idMesa'])){
					if ($result['dataset'] = $mesas->readPrepedido()) {
						$result['status'] = 1;
					} else {
						$result['exception'] = 'No hay productos registrados';
					}
				} else{
					
				}
				break;

				case 'createPrepedido':
				$_POST = $mesas->validateForm($_POST);
        		if ($mesas->setIdMesa($_POST['idMesa'])) {
					if ($mesas->setPlatillo($_POST['platillo'])) {
						if ($mesas->setCantidad($_POST['cantidad'])) {
							if ($mesas->createPrepedido()) {
									$result['status'] = 1;
									$result['message'] = 'Producto agregado correctamente';
							}
							else {
									$result['exception'] = 'Operacion fallida';
							}
						} else {
							$result['exception'] = 'Cantidad incorrecta';
						}
					} else {
						$result['exception'] = 'Platilllo incorrecto';
					}
				} else {
					$result['exception'] = 'Mesa incorrecta';
				}
				break;
				
				case 'deleteProducto':
				if($mesas->setIdPrepedido($_POST['id_prepedido'])){
                    if ($mesas->getPre()){
                        if ($mesas->deletePrepedido()){
                            $result['status'] = 1;
                        } else {
							$result['exception'] = 'Operación fallida';
                        }
                    } else {
						$result['exception'] = 'Pedido no encontrado';
                    }
                } else {
					$result['exception'] = 'Pedido incorrecto';
                }
				break;
				
				case 'updateCantidad':
				$_POST = $mesas->validateForm($_POST);
					if($mesas->setIdPrepedido($_POST['id_prepedido'])){
						if($mesas->setCantidad($_POST['cantidad'])){
							if($mesas->updateCantidad()){
								$result['status'] = 1;
							} else {
								$result['exception'] = 'Operación fallida';
							}
						} else {
							$result['exception'] = 'Cantidad incorrecta';
						}
					} else {
						$result['exception'] = 'Pedido incorrecto';
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
