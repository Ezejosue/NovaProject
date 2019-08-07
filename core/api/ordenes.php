<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/ordenes.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
	session_start();
	$ordenes = new Ordenes;
	$result = array('status' => 0, 'exception' => '');
	// Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario'])) {
		switch ($_GET['action']) {
			case 'readMesas':
				if ($result['dataset'] = $ordenes->readMesas()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay mesas registradas';
				}
				break;

				case 'readCategorias':
				if ($result['dataset'] = $ordenes->readCategorias()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay categorias registradas';
				}
				break;

				case 'readProductos':
				if ($ordenes->setCategoria($_POST['idCategoria'])){
					if ($result['dataset'] = $ordenes->readProductos()) {
					$result['status'] = 1;
					} else {
						$result['exception'] = 'No hay productos registrados';
					}
				} else{
					
				}
				
				break;
				case 'readPrepedido':
				if ($ordenes->setIdMesa($_POST['idMesa'])){
					if ($result['dataset'] = $ordenes->readPrepedido()) {
						$result['status'] = 1;
					} else {
						$result['exception'] = 'No hay productos registrados';
					}
				} else{
					
				}
				break;

				case 'createPrepedido':
				$_POST = $ordenes->validateForm($_POST);
        		if ($ordenes->setIdMesa($_POST['idMesa'])) {
					if ($ordenes->setPlatillo($_POST['platillo'])) {
						if ($ordenes->setCantidad($_POST['cantidad'])) {
							if ($ordenes->createPrepedido()) {
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
				if($ordenes->setIdPrepedido($_POST['id_prepedido'])){
                    if ($ordenes->getPre()){
                        if ($ordenes->deletePrepedido()){
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
				$_POST = $ordenes->validateForm($_POST);
					if($ordenes->setIdPrepedido($_POST['id_prepedido'])){
						if($ordenes->setCantidad($_POST['cantidad'])){
							if($ordenes->updateCantidad()){
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

				case 'createPedido':
                if($ordenes->setIdUsuario($_SESSION['idUsuario'])){
					if($ordenes->setIdMesa($_POST['idMesa'])){
						if($ordenes->createPedido()){
							if($ordenes->readUltimoPedido()){
								if($ordenes->setIdMesa($_POST['idMesa'])){
									print_r('test');
									if ($ordenes->readPrepedido()){
										if($data = $ordenes->readPrepedido2()){
											foreach($data as $platillo){
												if($ordenes->setPlatillo($platillo['id_platillo'])){
													if($ordenes->setCantidad($platillo['cantidad'])){
														if($ordenes->createDetallePedido()){
															$result['status'] = 1;
														} else {
															
														}
														
													} else {
														$result['exception'] = 'Cantidad incorrecta';
													}
												} else {
													$result['exception'] = 'Producto incorrecto';
												}
											}
											if($ordenes->deletePrepedido()){
												$result['status'] = 1;
												
											} else {
												$result['exception'] = 'Ocurrió un problema al eliminar el pre pedido';
											}
										} else {
											$result['exception'] = 'Ocurrió un problema al obtener los productos';
										}
									} else {
										$result['exception'] = 'Ocurrió un problema al obtener los datos del pre pedido';
									}
								} else {
									$result['exception'] = 'Ocurrió un problema al obtener la mesa';
								}
							} else {
								$result['exception'] = 'Ocurrió un problema al obtener el ultimo pedido';
							}
						} else {
							$result['exception'] = 'Ocurrió un problema al crear el pedido';
						}
					} else {
						$result['exception'] = 'Ocurrió un problema al obtener la mesa';
					}		
				} else {
					$result['exception'] = 'Inicie Sesión';
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
