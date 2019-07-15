<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/recetas.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['action'])) {
    session_start();
    $recetas = new Recetas;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idUsuario'])) {
        switch ($_GET['action']) {
            
            case 'read':
                if ($result['dataset'] = $recetas->readRecetas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay recetas registradas';
                }
                break;

            //Operación para crear nuevos usuarios
            case 'create':
                $_POST = $recetas->validateForm($_POST);
                    if ($recetas->setNombre($_POST['create_nombre_materia'])) {
                        if ($recetas->setEstado(isset($_POST['create_estado']) ? 1 : 0)) {
                            if ($recetas->setDescripcion($_POST['create_descripcion_materia'])) {
                                if ($recetas->setCantidad($_POST['create_cantidad'])) {
                                    if ($recetas->setCategorias($_POST['create_categoria'])) {
                                        if ($recetas->setIdMedida($_POST['create_unidad'])) {
                                            if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
                                                if ($recetas->setImagen($_FILES['create_archivo'], null)) {
                                                    if ($recetas->createMateriaPrima()) {
                                                        if ($recetas->saveFile($_FILES['create_archivo'], $recetas->getRuta(), $recetas->getImagen())) {
                                                            $result['status'] = 1;
                                                        } else {
                                                            $result['status'] = 2;
                                                            $result['exception'] = 'No se guardó el archivo';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Operación fallida';
                                                    }
                                                } else {
                                                    $result['exception'] = $recetas->getImageError();;
                                                } 
                                            }   else {
                                                $result['exception'] = 'Seleccione una imagen';
                                                    } 
                                                } else {
                                                    $result['exception'] = 'Seleccione una unidad de medida';
                                                } 
                                            } else {
                                            $result['exception'] = 'Seleccione una categoria';
                                        }  
                                    } else {
                                        $result['exception'] = 'Cantidad incorrecta';
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
                if ($recetas->setId($_POST['idMateria'])) {
                    if ($result['dataset'] = $recetas->getMateriaPrima()) {
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
				$_POST = $recetas->validateForm($_POST);
				if ($recetas->setId($_POST['id_materia'])) {
					if ($recetas->getMateriaPrima()) {
		                if ($recetas->setNombre($_POST['nombre_materia'])) {
                            if ($recetas->setDescripcion($_POST['descripcion_materia'])) {
                                if ($recetas->setCantidad($_POST['cantidad'])) {
                                    if ($recetas->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
                                        if ($recetas->setCategorias($_POST['update_categoria'])) {
                                            if ($recetas->setIdMedida($_POST['update_unidad'])) {
                                            //Se comprueba que se haya subido una imagen
                                            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                                                if ($recetas->setImagen($_FILES['foto'], $_POST['foto_materia'])) {
                                                    $archivo = true;
                                                } else {
                                                    $result['exception'] = $recetas->getImageError();
                                                    $archivo = false;
                                                }
                                            } else {
                                                if (!$recetas->setImagen(null, $_POST['foto_materia'])) {
                                                    $result['exception'] = $recetas->getImageError();
                                                }
                                                $archivo = false;
                                            }
                                        if ($recetas->updateMateriaPrima()) {
                                            $result['status'] = 1;
                                            if ($archivo) {
                                                if ($recetas->saveFile($_FILES['foto'], $recetas->getRuta(), $recetas->getImagen())) {
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
                                                $result['exception'] = 'Seleccione una unidad de medida';
                                            }
                                            } else {
                                                $result['exception'] = 'Seleccione una categoria';
                                            }
                                        } else {
                                            $result['exception'] = 'Estado incorrecto';
                                            }
                                    }else {
                                        $result['exception'] = 'Cantidad incorrecta';
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
                    if ($recetas->setId($_POST['idMateria'])) {
                        if ($recetas->getMateriaPrima()) {
                            if ($recetas->deleteMateriaPrima()) {
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
            case 'readMateriaPrima':
                if ($result['dataset'] = $recetas->readMateriaPrima()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;

            case 'readUnidad':
                if ($result['dataset'] = $recetas->readMedidaMateria()) {
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