<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/materiaprima.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['site']) && isset($_GET['action'])) {
    session_start();
    $materiaprima = new MateriaPrima;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario']){
        switch ($_GET['action']) {
            case 'readProductos':
                if ($result['dataset'] = $materiaprima->readMateriaPrima()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay productos registrados';
                }
                break;
            case 'readMateriaPrima':
                if ($result['dataset'] = $materiaprima->readCategorias()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay categorías registradas';
                }
                break;
            case 'search':
                $_POST = $materiaprima->validateForm($_POST);
                if ($_POST['busqueda'] != '') {
                    if ($result['dataset'] = $materiaprima->searchMateriaPrima($_POST['busqueda'])) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
            case 'create':
                $_POST = $materiaprima->validateForm($_POST);
                if ($materiaprima->setNombre($_POST['create_nombre'])) {
                    if ($materiaprima->setDescripcion($_POST['create_descripcion'])) {
                        if ($materiaprima->setPrecio($_POST['create_precio'])) {
                            if ($materiaprima->setCategoria($_POST['create_categoria'])) {
                                if ($materiaprima->setEstado(isset($_POST['create_estado']) ? 1 : 0)) {
                                    if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
                                        if ($materiaprima->setImagen($_FILES['create_archivo'], null)) {
                                            if ($materiaprima->createProducto()) {
                                                if ($materiaprima->saveFile($_FILES['create_archivo'], $materiaprima->getRuta(), $materiaprima->getImagen())) {
                                                    $result['status'] = 1;
                                                } else {
                                                    $result['status'] = 2;
                                                    $result['exception'] = 'No se guardó el archivo';
                                                }
                                            } else {
                                                $result['exception'] = 'Operación fallida';
                                            }
                                        } else {
                                            $result['exception'] = $materiaprima->getImageError();
                                        }
                                    } else {
                                        $result['exception'] = 'Seleccione una imagen';
                                    }
                                } else {
                                    $result['exception'] = 'Estado incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Seleccione una categoría';
                            }
                        } else {
                            $result['exception'] = 'Precio incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Descripción incorrecta';
                    }
                } else {
                    $result['exception'] = 'Nombre incorrecto';
                }
                break;
            case 'get':
                if ($materiaprima->setId($_POST['idMateria'])) {
                    if ($result['dataset'] = $materiaprima->getProducto()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                break;
            case 'update':
                $_POST = $materiaprima->validateForm($_POST);
                if ($materiaprima->setId($_POST['id_producto'])) {
                    if ($materiaprima->getProducto()) {
                        if ($materiaprima->setNombre($_POST['update_nombre'])) {
                            if ($materiaprima->setDescripcion($_POST['update_descripcion'])) {
                                if ($materiaprima->setPrecio($_POST['update_precio'])) {
                                    if ($materiaprima->setCategoria($_POST['update_categoria'])) {
                                        if ($materiaprima->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
                                            if (is_uploaded_file($_FILES['update_archivo']['tmp_name'])) {
                                                if ($materiaprima->setImagen($_FILES['update_archivo'], $_POST['imagen_producto'])) {
                                                    $archivo = true;
                                                } else {
                                                    $result['exception'] = $materiaprima->getImageError();
                                                    $archivo = false;
                                                }
                                            } else {
                                                if ($materiaprima->setImagen(null, $_POST['imagen_producto'])) {
                                                    $result['exception'] = 'No se subió ningún archivo';
                                                } else {
                                                    $result['exception'] = $materiaprima->getImageError();
                                                }
                                                $archivo = false;
                                            }
                                            if ($materiaprima->updateProducto()) {
                                                if ($archivo) {
                                                    if ($materiaprima->saveFile($_FILES['update_archivo'], $materiaprima->getRuta(), $materiaprima->getImagen())) {
                                                        $result['status'] = 1;
                                                    } else {
                                                        $result['status'] = 2;
                                                        $result['exception'] = 'No se guardó el archivo';
                                                    }
                                                } else {
                                                    $result['status'] = 3;
                                                }
                                            } else {
                                                $result['exception'] = 'Operación fallida';
                                            }
                                        } else {
                                            $result['exception'] = 'Estado incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Seleccione una categoría';
                                    }
                                } else {
                                    $result['exception'] = 'Precio incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Descripción incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Nombre incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                break;
            case 'delete':
                if ($materiaprima->setId($_POST['id_producto'])) {
                    if ($materiaprima->getProducto()) {
                        if ($materiaprima->deleteProducto()) {
                            if ($materiaprima->deleteFile($materiaprima->getRuta(), $_POST['imagen_producto'])) {
                                $result['status'] = 1;
                            } else {
                                $result['status'] = 2;
                                $result['exception'] = 'No se borró el archivo';
                            }
                        } else {
                            $result['exception'] = 'Operación fallida';
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                break;
            default:
                exit('Acción no disponible');
        }
    } else if ($_GET['site'] == 'commerce') {
        switch ($_GET['action']) {
            case 'readCategorias':
                if ($result['dataset'] = $materiaprima->readCategorias()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;
            case 'readProductos':
                if ($materiaprima->setCategoria($_POST['id_categoria'])) {
                    if ($result['dataset'] = $materiaprima->readProductosCategoria()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Contenido no disponible';
                    }
                } else {
                    $result['exception'] = 'Categoría incorrecta';
                }
                break;
            case 'detailProducto':
                if ($materiaprima->setId($_POST['id_producto'])) {
                    if ($result['dataset'] = $materiaprima->getProducto()) {
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
    } else {
        exit('Acceso no disponible');
    }
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>
