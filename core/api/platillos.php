<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/platillos.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['action'])) {
    session_start();
    $platillo = new Platillos;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idUsuario'])) {
        switch ($_GET['action']) {
            
            case 'read':
                if ($result['dataset'] = $platillo->readPlatillo()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay platillos registrados';
                }
                break;

            //Operación para crear nuevos usuarios
            case 'create':
                $_POST = $platillo->validateForm($_POST);
                    if ($platillo->setNombre($_POST['create_nombre_materia'])) {
                        if ($platillo->setEstado(isset($_POST['create_estado']) ? 1 : 0)) {
                            if ($platillo->setDescripcion($_POST['create_descripcion_materia'])) {
                                if ($platillo->setCategorias($_POST['create_categoria'])) {
                                        if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
                                            if ($platillo->setImagen($_FILES['create_archivo'], null)) {
                                                if ($platillo->createMateriaPrima()) {
                                                    if ($platillo->saveFile($_FILES['create_archivo'], $platillo->getRuta(), $platillo->getImagen())) {
                                                        $result['status'] = 1;
                                                } else {
                                                    $result['status'] = 2;
                                                    $result['exception'] = 'No se guardó el archivo';
                                                }
                                            } else {
                                                $result['exception'] = 'Operación fallida';
                                            }
                                        } else {
                                            $result['exception'] = $platillo->getImageError();;
                                        } 
                                    }   else {
                                        $result['exception'] = 'Seleccione una imagen';
                                            } 
                                    } else {
                                    $result['exception'] = 'Seleccione una categoria';
                                }  
                                } else {
                                    $result['exception'] = 'Descripcion incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Estado incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Nombre incorrecto';
                        }                                     
                    break;
                
            //Operación para saber el usuario que se va a modificar
            case 'get':
                if ($platillo->setId($_POST['idMateria'])) {
                    if ($result['dataset'] = $platillo->getMateriaPrima()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Materia prima inexistente';
                    }
                } else {
                    $result['exception'] = 'Materia prima incorrecta';
                }
                break;
            //Operación para actualizar un usuario
            case 'update':
				$_POST = $platillo->validateForm($_POST);
				if ($platillo->setId($_POST['id_materia'])) {
					if ($platillo->getMateriaPrima()) {
		                if ($platillo->setNombre($_POST['nombre_materia'])) {
                            if ($platillo->setDescripcion($_POST['descripcion_materia'])) {
                                if ($platillo->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
                                    if ($platillo->setCategorias($_POST['update_categoria'])) {
                                        //Se comprueba que se haya subido una imagen
                                        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                                            if ($platillo->setImagen($_FILES['foto'], $_POST['foto_materia'])) {
                                                $archivo = true;
                                            } else {
                                                $result['exception'] = $platillo->getImageError();
                                                $archivo = false;
                                            }
                                        } else {
                                            if (!$platillo->setImagen(null, $_POST['foto_materia'])) {
                                                $result['exception'] = $platillo->getImageError();
                                            }
                                            $archivo = false;
                                        }
                                        if ($platillo->updateMateriaPrima()) {
                                            $result['status'] = 1;
                                            if ($archivo) {
                                                if ($platillo->saveFile($_FILES['foto'], $platillo->getRuta(), $platillo->getImagen())) {
                                                    $result['message'] = 'Categoría modificada correctamente';
                                                    } else {
                                                        $result['message'] = 'Categoría modificada. No se guardó el archivo';
                                                    }
                                                } else {
                                                    $result['message'] = 'Categoría modificada. No se subió ningún archivo';
                                                }
                                            } else {
                                                $result['exception'] = 'Operación fallida';
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione una categoria';
                                        }
                                    } else {
                                        $result['exception'] = 'Estado incorrecto';
                                        }
                                }else {
                                    $result['exception'] = 'Descripcion incorrecta';
                                } 
                            }else {
                                $result['exception'] = 'Nombre de materia prima incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Materia prima inexistente';
                        }
                    } else {
                        $result['exception'] = 'Materia prima incorrecta';
                    }
                    break;
            //Operación para eliminar un usuario
            case 'delete':
            //Se comprueba que el usuario a eliminar no sea igual al que ha iniciado sesión
                    if ($platillo->setId($_POST['idMateria'])) {
                        if ($platillo->getMateriaPrima()) {
                            if ($platillo->deleteMateriaPrima()) {
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
            //Operación para mostrar los tipos de usuario activos en el formulario de modificar usuario
            case 'readCategoria':
                if ($result['dataset'] = $platillo->readCategoriaMateria()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;
                
            default:
                exit('Acción no disponible 1');
        }
    } 
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>