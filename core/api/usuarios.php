<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/usuarios.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['action'])) {
    session_start();
    $usuario = new Usuarios;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idUsuario'])) {
        switch ($_GET['action']) {
            //Operación de cerrar sesión
            case 'logout':
                if (session_destroy()) {
                    header('location: ../../views/');
                } else {
                    header('location: ../../views/inicio.php');
                }
                break;
            //Operación para mostrar los datos del usuario que ha iniciado sesión
            case 'readProfile':
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    if ($result['dataset'] = $usuario->getUsuario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'readData':
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    if ($result['dataset'] = $usuario->getCantidadProductos()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = '';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            //Operación para editar el perfil del usuario que ha iniciado sesión
            case 'editProfile':
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    if ($usuario->getUsuario()) {
                        $_POST = $usuario->validateForm($_POST);
                        if ($usuario->setAlias($_POST['profile_alias'])) {
							if ($usuario->setEstado(isset($_POST['profile_estado']) ? 1 : 0)) {
                                if ($usuario->setTipo_usuario($_POST['profile_tipo'])) {
                                    //Se comprueba que se haya subido una imagen
                                    if (is_uploaded_file($_FILES['profile_foto']['tmp_name'])) {
                                        if ($usuario->setFoto($_FILES['profile_foto'], $_POST['profile_imagen'])) {
                                            $archivo = true;
                                        } else {
                                            $result['exception'] = $usuario->getImageError();
                                            $archivo = false;
                                        }
                                    } else {
                                        if (!$usuario->setFoto(null, $_POST['profile_imagen'])) {
                                            $result['exception'] = $usuario->getImageError();
                                        }
                                        $archivo = false;
                                    }
                                    if ($usuario->updateUsuario()) {
                                        $result['status'] = 1;
                                        if ($archivo) {
                                            if ($usuario->saveFile($_FILES['profile_foto'], $usuario->getRuta(), $usuario->getFoto())) {
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
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            //Operación para cambiar la contraseña del usuario que ha iniciado sesión
            case 'password':
            //Se comprueba que el usuario haya iniciado sesión anteriormente
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    $_POST = $usuario->validateForm($_POST);
                    //Se comprueba que las claves actuales sean iguales
                    if ($_POST['clave_actual_1'] == $_POST['clave_actual_2']) {
                        if ($usuario->setClave($_POST['clave_actual_1'])) {
                            if ($usuario->checkPassword()) {
                                //Se comprueba que las nuevas claves sean iguales
                                if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                    if ($usuario->setClave($_POST['clave_nueva_1'])) {
                                        //Si todo está correcto se ejecuta el método para cambiar la contraseña, de lo contrario se muestra el mensaje de error
                                        if ($usuario->changePassword()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave nueva menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves nuevas diferentes';
                                }
                            } else {
                                $result['exception'] = 'Clave actual incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Clave actual menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Claves actuales diferentes';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            //Operación para comprobar que haya usuarios registrados
            case 'read':
                if ($result['dataset'] = $usuario->readUsuarios()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay usuarios registrados';
                }
                break;

                //Operación para cambiar la contraseña del usuario que ha iniciado sesión
            case 'password1':
            //Se comprueba que el usuario haya iniciado sesión anteriormente
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    $_POST = $usuario->validateForm($_POST);
                    //Se comprueba que las claves actuales sean iguales
                    if ($_POST['clave_actual'] == $_POST['clave_actual1']) {
                        if ($usuario->setClave($_POST['clave_actual1'])) {
                            if ($usuario->checkPassword()) {
                                //Se comprueba que las nuevas claves sean iguales
                                if ($_POST['clave_nueva'] == $_POST['clave_nueva1']) {
                                    if ($usuario->setClave($_POST['clave_nueva'])) {
                                        //Si todo está correcto se ejecuta el método para cambiar la contraseña, de lo contrario se muestra el mensaje de error
                                        if ($usuario->changePassword()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave nueva menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves nuevas diferentes';
                                }
                            } else {
                                $result['exception'] = 'Clave actual incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Clave actual menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Claves actuales diferentes';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            //Operación para comprobar que haya usuarios registrados
            case 'read':
                if ($result['dataset'] = $usuario->readUsuarios()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay usuarios registrados';
                }
                break;
            //Operación para crear nuevos usuarios
            case 'create':
                $_POST = $usuario->validateForm($_POST);
                    if ($usuario->setAlias($_POST['create_alias'])) {
                        if ($usuario->setEstado(isset($_POST['create_estado']) ? 1 : 0)) {
                            if ($usuario->setTipo_usuario($_POST['create_tipo'])) {
                                //Se comprueba que las claves sean iguales
                                if ($_POST['create_clave1'] == $_POST['create_clave2']) {
                                    if ($usuario->setClave($_POST['create_clave1'])) {
                                        //Se comprueba que se haya subido una imagen
                                        if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
                                            if ($usuario->setFoto($_FILES['create_archivo'], null)) {
                                                if ($usuario->createUsuario()) {
                                                    if ($usuario->saveFile($_FILES['create_archivo'], $usuario->getRuta(), $usuario->getFoto())) {
                                                        $result['status'] = 1;
                                                    } else {
                                                        $result['status'] = 2;
                                                        $result['exception'] = 'No se guardó el archivo';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Operación fallida';
                                                }
                                            } else {
                                                $result['exception'] = $usuario->getImageError();;
                                            } 
                                        }   else {
                                            $result['exception'] = 'Seleccione una imagen';
                                        }   
                                    } else {
                                            $result['exception'] = 'Clave menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
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
                break;
                
            //Operación para saber el usuario que se va a modificar
            case 'get':
                if ($usuario->setId($_POST['id_usuario'])) {
                    if ($result['dataset'] = $usuario->getUsuario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            //Operación para actualizar un usuario
            case 'update':
				$_POST = $usuario->validateForm($_POST);
				if ($usuario->setId($_POST['id_usuario'])) {
					if ($usuario->getUsuario()) {
		                if ($usuario->setAlias($_POST['update_alias'])) {
							if ($usuario->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
                                if ($usuario->setTipo_usuario($_POST['update_tipo'])) {
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
                if ($_POST['id_usuario'] != $_SESSION['idUsuario']) {
                    if ($usuario->setId($_POST['id_usuario'])) {
                        if ($usuario->getUsuario()) {
                            if ($usuario->deleteUsuario()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'Usuario inexistente';
                        }
                    } else {
                        $result['exception'] = 'Usuario incorrecto';
                    }
                } else {
                    $result['exception'] = 'No se puede eliminar a sí mismo';
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
            //Operación para iniciar sesión
            case 'login':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setAlias($_POST['usuario'])) {
                    //Se comprueba que el alias exista en la base de datos
                    if ($usuario->checkAlias()) {
                        if ($usuario->checkEstado()){
                            //Se valida que la contraseña no sea menor a 6 caracteres
                            if ($usuario->setClave($_POST['clave'])) {
                                //Se comprueba que la contraseña coincida con el usuario a iniciar sesión
                                if ($usuario->checkPassword()) {
                                    //Si todo está correcto se inicia sesión y se llenan las variables de sesión con el id y el alias
                                    $_SESSION['idUsuario'] = $usuario->getId();
                                    $_SESSION['aliasUsuario'] = $usuario->getAlias();
                                    $result['status'] = 1;
                                } else {
                                    $result['exception'] = 'Clave inexistente';
                                }
                            } else {
                                $result['exception'] = 'Clave menor a 6 caracteres';
                            }
                        } else {
                            $result['exception'] = 'No tiene acceso al sistema';
                        }
                    } else {
                        $result['exception'] = 'Alias inexistente';
                    }
                } else {
                    $result['exception'] = 'Alias incorrecto';
                }
                break;
                //Operación para registrar el primer usuario
                case 'register':
                $_POST = $usuario->validateForm($_POST);
                    if ($usuario->setAlias($_POST['alias'])) {
                        if ($usuario->setEstado(isset($_POST['estado']) ? 1 : 0)) {
                            if ($usuario->setTipo_usuario($_POST['tipo'])) {
                                //Se comprueba que las claves sean iguales
                                if ($_POST['clave1'] == $_POST['clave2']) {
                                    if ($usuario->setClave($_POST['clave1'])) {
                                        //Se comprueba que se haya seleccionado una imagen anteriormente
                                        if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
                                            if ($usuario->setFoto($_FILES['archivo'], null)) {
                                                //Si todo está correcto se registra el primer usuario
                                                if ($usuario->createUsuario()) {
                                                    if ($usuario->saveFile($_FILES['archivo'], $usuario->getRuta(), $usuario->getFoto())) {
                                                        $result['status'] = 1;
                                                    } else {
                                                        $result['status'] = 2;
                                                        $result['exception'] = 'No se guardó el archivo';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Operación fallida';
                                                }
                                            } else {
                                                $result['exception'] = $usuario->getImageError();;
                                            } 
                                        }   else {
                                            $result['exception'] = 'Seleccione una imagen';
                                        }   
                                    } else {
                                            $result['exception'] = 'Clave menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
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
                break;
            default:
                exit('Acción no disponible 2');
        }
    }
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>