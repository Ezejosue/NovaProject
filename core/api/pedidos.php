<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/pedidos.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
	session_start();
	$pedidos = new Pedidos;
	$result = array('status' => 0, 'exception' => '');
	// Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario'])) {
		switch ($_GET['action']) {
			case 'read':
				if ($result['dataset'] = $pedidos->readPedidos()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay pedidos registrados';
				}
            break;
            case 'get':
                if ($pedido->setIdPedido($_POST['id_pedido'])) {
                    if ($result['dataset'] = $pedido->getPedido()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Pedido inexistente';
                    }
                } else {
                    $result['exception'] = 'Pedido incorrecto';
                }
                break;
            case 'getDetalle':
                if ($pedidos->setIdPedido($_POST['id_pedido'])) {
                    if ($result['dataset'] = $pedidos->readDetalle()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Mesa inexistente';
                    }
                } else {
                    $result['exception'] = 'Mesa incorrecta';
                }
                break;
                case 'readDetalle':
                if ($pedidos->setIdPedido($_POST['id_pedido'])){
                    if ($result['dataset'] = $pedidos->readDetalle()) {
                        $result['status'] = 1;

                    } else {
                        $result['exception'] = 'No hay detalles registrados';
                    }
                } else {
                    $result['exception'] = 'Pedido inexistente';
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
