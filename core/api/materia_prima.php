<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/materia_prima.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['action'])) {
    session_start();
    $materia = new Materias;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idUsuario'])) {
        switch ($_GET['action']) {
            
            case 'read':
                if ($result['dataset'] = $materia->readMateriaPrima()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay materia prima registradas';
                }
                break;

            //Operación para crear nuevos usuarios
            case 'create':
                $_POST = $materia->validateForm($_POST);
                    if ($materia->setNombre($_POST['create_alias'])) {
                        if ($materia->setEstado(isset($_POST['create_estado']) ? 1 : 0)) {
                            if ($materia->setDescripcion($_POST['create_descripcion'])) {
                                if ($materia->setCategoria($_POST['create_categoria'])) {
                                        if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
                                            if ($materia->setImagen($_FILES['create_archivo'], null)) {
                                                if ($materia->createMateriaPrima()) {
                                                    if ($materia->saveFile($_FILES['create_archivo'], $materia->getRuta(), $materia->getImagen())) {
                                                        $result['status'] = 1;
                                                } else {
                                                    $result['status'] = 2;
                                                    $result['exception'] = 'No se guardó el archivo';
                                                }
                                            } else {
                                                $result['exception'] = 'Operación fallida';
                                            }
                                        } else {
                                            $result['exception'] = $materia->getImageError();;
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
                if ($materia->setId($_POST['idMateria'])) {
                    if ($result['dataset'] = $materia->getMateriaPrima()) {
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
				$_POST = $materia->validateForm($_POST);
				if ($materia->setId($_POST['idMateria'])) {
					if ($materia->getMateriaPrima()) {
		                if ($materia->setAlias($_POST['update_alias'])) {
							if ($materia->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
                                if ($materia->setTipo_usuario($_POST['update_tipo'])) {
                                    //Se comprueba que se haya subido una imagen
                                    if (is_uploaded_file($_FILES['imagen_usuario']['tmp_name'])) {
                                        if ($usuario->setFoto($_FILES['imagen_usuario'], $_POST['foto_usuario'])) {
                                            $archivo = true;
                                        } else {
                                            $result['exception'] = $usuario->getImageError();
                                            $archivo = false;
                                        }
                                    } else {
                                        if (!$usuario->setFoto(null, $_POST['foto_usuario'])) {
                                            $result['exception'] = $usuario->getImageError();
                                        }
                                        $archivo = false;
                                    }
                                    if ($usuario->updateUsuario()) {
                                        $result['status'] = 1;
                                        if ($archivo) {
                                            if ($usuario->saveFile($_FILES['imagen_usuario'], $usuario->getRuta(), $usuario->getFoto())) {
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
                                    $result['exception'] = 'Seleccione un tipo de usuario';
                                }
							} else {
								$result['exception'] = 'Estado incorrecto';
							}
						} else {
							$result['exception'] = 'Alias incorrecto';
						}
					} else {
						$result['exception'] = 'Usuario inexistente';
					}
				} else {
					$result['exception'] = 'Usuario incorrecta';
				}
                break;
            //Operación para eliminar un usuario
            case 'delete':
            //Se comprueba que el usuario a eliminar no sea igual al que ha iniciado sesión
                    if ($materia->setId($_POST['idMateria'])) {
                        if ($materia->getMateriaPrima()) {
                            if ($materia->deleteMateriaPrima()) {
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
            case 'readTipoUsuario2':
                if ($result['dataset'] = $usuario->readTipoUsuario()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;
                
            default:
                exit('Acción no disponible 1');
        }
    } else {
        //Operaciones que se realizan cuando no se ha iniciado sesión
        switch ($_GET['action']) {
            case 'read':
                if ($usuario->readUsuarios()) {
                    //Cuando existen usuarios registrados no se muestra el formulario de registrar el primer usuario
                    $result['status'] = 1;
                    $result['exception'] = 'Existe al menos un usuario registrado';
                } else {
                    //Si no existen usuarios se muestra el formulario de registrar el primer usuario
                    $result['status'] = 2;
                    $result['exception'] = 'No existen usuarios registrados';
                }
            break;
            //Operación para mostrar los tipos de usuario activos en el formulario de registrar el primer usuario
            case 'readTipoUsuario':
                if ($result['dataset'] = $usuario->readTipoUsuario()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;
            }
        }
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>