<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/categorias.php');
require_once('../../models/productos.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
    session_start();
    $categoria = new Categorias;
    $producto = new Productos;
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    switch ($_GET['action']) {
        case 'readCategorias':
            if ($result['dataset'] = $categoria->readCategorias()) {
                $result['status'] = 1;
            } else {
                $result['exception'] = 'Contenido no disponible';
            }
            break;
        case 'readProductos':
            if ($producto->setCategoria($_POST['id_categoria'])) {
                if ($result['dataset'] = $producto->readProductosCategoria()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
            } else {
                $result['exception'] = 'Categoría incorrecta';
            }
            break;
        case 'detailProducto':
            if ($producto->setId($_POST['id_producto'])) {
                if ($result['dataset'] = $producto->getProducto()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
            } else {
                $result['exception'] = 'Producto incorrecto';
            }
            break;
        default:
            exit('Acción no disponible');
    }
    print(json_encode($result));
} else {
    exit('Recurso denegado');
}
?>
