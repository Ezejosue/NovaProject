<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/usuarios.php');

//Librerias necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../core/libraries/PHPMailer/src/Exception.php';
require '../../core/libraries/PHPMailer/src/PHPMailer.php';
require '../../core/libraries/PHPMailer/src/SMTP.php';
$mail = new PHPMailer();
$mail->CharSet = "UTF-8";

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
                    if ($usuario->setId($_SESSION['idUsuario'])) {
                       if ($usuario->UpdateLogout()) { 
                            header('location: ../../views/');
                        } else {
                            $result['exception'] = 'No hemos podido destruir su sesion';
                        }
                    } else {
                        $result['exception'] = 'No encontramos su usuario';
                    } 
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
            case 'readMenu':
                if ($usuario->setTipo_usuario($_SESSION['tipoUsuario'])){
                     if ($result['dataset'] = $usuario->readMenu()) {
                            $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Usuario incorrecto 55';
                    }
                }
                
                break;
            case 'readDataProducts':
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
            case 'readDataCategories':
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    if ($result['dataset'] = $usuario->getCantidadCategorias()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = '';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'readDataUsers':
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    if ($result['dataset'] = $usuario->getCantidadUsuarios()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = '';
                    }
                } else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'readDataEmployees':
                if ($usuario->setId($_SESSION['idUsuario'])) {
                    if ($result['dataset'] = $usuario->getCantidadEmpleados()) {
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
                        $alias = $usuario->checkContra();
                        if($_POST['clave_nueva_1'] != $_POST['clave_actual_1']){
                            if ($alias != $_POST['clave_actual_1']) {
                                $contrasenia = $usuario->setClave($_POST['clave_actual_1']);
                                if ($contrasenia[0]) {
                                    if ($usuario->checkPassword()) {
                                        //Se comprueba que las nuevas claves sean iguales
                                        if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                            $alias = $usuario->checkContra();
                                            if ($alias != $_POST['clave_actual_1']) {
                                                $contrasenia = $usuario->setClave($_POST['clave_nueva_1']);
                                                    if ($contrasenia[0]) {
                                                        //Si todo está correcto se ejecuta el método para cambiar la contraseña, de lo contrario se muestra el mensaje de error
                                                        if ($usuario->changePassword()) {
                                                            $result['status'] = 1;
                                                        } else {
                                                            $result['exception'] = 'Operación fallida';
                                                        }
                                                    } else {
                                                        $result['exception'] = $contrasenia[1];
                                                    }
                                                }else {
                                                    $result['exception'] = 'La clave debe ser diferente al usuario';
                                                }
                                            } else {
                                                $result['exception'] = 'Claves nuevas diferentes';
                                            }
                                        } else {
                                            $result['exception'] = 'Clave actual incorrecta';
                                        }
                                    } else {
                                        $result['exception'] = $contrasenia[1];
                                    }
                                } else {
                                    $result['exception'] = 'La clave debe ser diferente al usuario';
                                }
                            } else {
                                $result['exception'] = 'La clave nueva es igual a la clave actual';
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
                        $alias = $usuario->checkContra();
                        if ($alias != $_POST['clave_actual_1']) {
                            $contrasenia = $usuario->setClave($_POST['clave_actual_1']);
                            if ($contrasenia[0]) {
                                if ($usuario->checkPassword()) {
                                    //Se comprueba que las nuevas claves sean iguales
                                    if ($_POST['clave_nueva'] == $_POST['clave_nueva1']) {
                                        $alias = $usuario->checkContra();
                                        if ($alias != $_POST['clave_nueva']) {
                                            $contrasenia = $usuario->setClave($_POST['clave_nueva']);
                                            if ($contrasenia[0]) {
                                                //Si todo está correcto se ejecuta el método para cambiar la contraseña, de lo contrario se muestra el mensaje de error
                                                if ($usuario->changePassword()) {
                                                $result['status'] = 1;
                                                } else {
                                                    $result['exception'] = 'Operación fallida';
                                                }
                                            } else {
                                                $result['exception'] = $contrasenia[1];
                                            }
                                        } else {
                                            $result['exception'] = 'La clave no puede ser igual al alias';
                                        }
                                    } else {
                                        $result['exception'] = 'Claves nuevas diferentes';
                                    }
                                } else {
                                    $result['exception'] = 'Clave actual incorrecta';
                                }
                            } else {
                                $result['exception'] = $contrasenia[1];
                            }
                        } else {
                            $result['exception'] = 'La contraseña no puedes ser igual al alias';
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
                        if ($usuario->checkAlias()){
                            $result['exception'] = 'El nombre de usuario ya existe';
                        } else {
                            if($usuario->setCorreo($_POST['create_correo'])){
                                if($usuario->checkCorreo()){
                                    $result['exception'] = 'El correo ya existe';
                                } else {
                                    if ($usuario->setEstado(isset($_POST['create_estado']) ? 1 : 0)) {
                                        if ($usuario->setTipo_usuario($_POST['create_tipo'])) {
                                            //Se comprueba que las claves sean iguales
                                            if ($_POST['create_clave1'] == $_POST['create_clave2']) {
                                                if ($_POST['create_alias'] != $_POST['create_clave1']) {
                                                    $contrasenia = $usuario->setClave($_POST['create_clave1']);
                                                    if ($contrasenia[0]) {
                                                        //Se comprueba que se haya subido una imagen
                                                        if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
                                                            if ($usuario->setFoto($_FILES['create_archivo'], null)) {
                                                                if ($usuario->saveFile($_FILES['create_archivo'], $usuario->getRuta(), $usuario->getFoto())) {
                                                                    $correo = $usuario->getCorreo();
                                                                    $token_activacion = uniqid();
                                                                    if($usuario->setToken($token_activacion)){
                                                                        if($usuario->updateToken()){
                                                                            if ($usuario->createUsuario()) {
                                                                                try {
                                                                                $mail->isSMTP();                                            // Set mailer to use SMTP
                                                                                $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                                                                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                                                                $mail->Username   = 'test503sv@gmail.com';                             // SMTP username
                                                                                $mail->Password   = '71096669';                             // SMTP password
                                                                                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                                                                                $mail->Port       = 587;
                                                                                //Recipients
                                                                                $mail->setFrom('test503sv@gmail.com', 'Activar cuenta');
                                                                                $mail->addAddress($correo);
                                                                                // Content
                                                                                $mail->isHTML(true);                                  // Set email format to HTML
                                                                                $mail->Subject = 'Activar cuenta';
                                                                                $mail->Body    = 'Haga click <a href="http://localhost/admin/views/activacion.php?token='.$token_activacion.'">aquí</a> para activar su cuenta';
                                                                                $mail->send();
                                                                                $result['status'] = 1;
                                                                                } catch (Exception $e) {
                                                                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                                                                }
                                                                            } else {
                                                                                $result['exception'] = 'Operación fallida';
                                                                            }
                                                                        } else{
                                                                            $result['exception'] = 'Error al actualizar el token';
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'Error al setear el token';
                                                                    }
                                                                } else {
                                                                    $result['status'] = 2;
                                                                    $result['exception'] = 'No se guardó el archivo';
                                                                }
                                                            } else {
                                                                $result['exception'] = $usuario->getImageError();;
                                                            } 
                                                        }else {
                                                            $result['exception'] = 'Seleccione una imagen';
                                                        }   
                                                    } else {
                                                            $result['exception'] = $contrasenia[1];
                                                    }
                                                } else {
                                                    $result['exception'] = 'La contraseña no puede ser igual al alias';
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
                                }
                            } else {
                                $result['exception'] = 'Correo incorrecto';
                            }
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
                            if($usuario->setCorreo($_POST['update_correo'])){
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
                            } else{
                                $result['exception'] = 'Correo incorrecto';
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
                case 'activacion':
                $_POST = $usuario->validateForm($_POST);
                if($usuario->setToken($_POST['token'])) {
                    if($usuario->getDatosToken()) {
                        if($usuario->activarCuenta()) {
                            if($usuario->deleteToken()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Error al borrar el token';
                            }
                        } else {
                            $result['exception'] = 'Error al activar la cuenta';
                        }
                    } else {
                        $result['exception'] = 'Error al obtener los datos del usuario';
                    }
                } else {
                    $result['exception'] = 'Error al obtener el token';
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
/* 
                case 'intentos':
                $_POST = $usuario->validateForm($_POST);
                    if ($usuario->setAlias($_POST['usuario'])) {
                        if ($result['dataset'] = $usuario->SumarIntentos()) {
                            $result['status'] = 1;
                            $result['exception'] = 'Tiene 3 intentos, si no su usuario se bloqueara indefinidamente MUERASE';
                        if ($result['dataset'] = $usuario->BloquearIntentos()) {
                            $result['status'] = 2;
                            $result['exception'] = 'Su usuario ha sido bloqueado';
                        } else {
                            $result['exception'] = 'No hemos podido bloquear su usuario';
                        }
                    } else {
                        $result['exception'] = 'No pudimos sumar intentos';
                    }
                } else {
                    $result['exception'] = 'Alias incorrecto';
                }
                break;
      
            case 'BloquearIntentos':
                $_POST = $usuario->validateForm($_POST);
                 if ($usuario->setAlias($_POST['usuario'])) {
                    if ($result['dataset'] = $usuario->BloquearIntentos()) {
                        $result['status'] = 1;
                        $result['exception'] = 'Hemos bloqueado el usuario';
                    } else {
                        $result['exception'] = 'No hemos podido bloquear usuario';
                        } 
                    } else {
                        $result['exception'] = 'Alias incorrecto';
                }
                break;
 */
            //Operación para iniciar sesión
            case 'login':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setAlias($_POST['usuario'])) {
                    //Se comprueba que el alias exista en la base de datos
                    if ($usuario->checkAlias()) {
                        if ($usuario->checkActivacion()) {
                            $result['exception'] = 'Su cuenta no ha sido activada';
                        } else {
                            //Se comprueba que el estado del usuario este activo
                            if ($usuario->checkEstado()){
                                //Se valida que la contraseña no sea menor a 6 caracteres
                                $contrasenia = $usuario->setClave($_POST['clave']);
                                if ($contrasenia[0]) {
                                    //Se comprueba que la contraseña coincida con el usuario a iniciar sesión
                                    if ($usuario->checkPassword()) {
                                        if ($usuario->UpdateLogin()) {
                                            if ($usuario->checkLogin()) {
                                                /* //Si todo está correcto se inicia sesión y se llenan las variables de sesión con el id y el alias
                                                $_SESSION['idUsuario'] = $usuario->getId();
                                                $_SESSION['aliasUsuario'] = $usuario->getAlias();
                                                $_SESSION['tiempo'] = time(); */
                                                $token_autenticacion = mt_rand(100000, 999999);
                                                if($usuario->setToken($token_autenticacion)) {
                                                    if($usuario->updateTokenAutenticacion()) {
                                                        if($usuario->getDatosToken()) {
                                                            $correo = $usuario->getCorreo();
                                                            try {
                                                                $mail->isSMTP();                                            // Set mailer to use SMTP
                                                                $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                                                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                                                $mail->Username   = 'test503sv@gmail.com';                             // SMTP username
                                                                $mail->Password   = '71096669';                             // SMTP password
                                                                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                                                                $mail->Port       = 587;
                                                                //Recipients
                                                                $mail->setFrom('test503sv@gmail.com', 'Pizza Nova');
                                                                $mail->addAddress($correo);
                                                                // Content
                                                                $mail->isHTML(true);                                  // Set email format to HTML
                                                                $mail->Subject = 'Código de inicio de sesión';
                                                                $mail->Body    = 'Tu código de activación es: '.$token_autenticacion;
                                                                $mail->send();
                                                                $result['status'] = 1;
                                                                $_SESSION['aliasUsuario'] = $usuario->getAlias();
                                                                } catch (Exception $e) {
                                                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                                                }
                                                            } else {

                                                            }
                                                        } else {
                                                            $result['exception'] = 'Error al asignar el token';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Error al setear el token';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Este usuario ya esta logueado';
                                                }
                                            } else {
                                                $result['exception'] = 'No hemos podido actualizar sus intentos';
                                            } 
                                        } else {
                                        if ($usuario->setAlias($_POST['usuario'])) {
                                           if ($usuario->ConsultarIntentos()) {
                                            if ($usuario->SumarIntentos()) {
                                                $result['exception'] = 'Tenga cuidado su sesion se puede bloquear si se equivoca mas de 3 veces';
                                               }
                                           } else {
                                               if ($usuario->BloquearIntentos()) {
                                                   $result['exception'] = 'Su usuario ha sido bloqueado';
                                               }
                                           }
                                        } else {
                                            $result['exception'] = 'Alias incorrecto';
                                        }
                                    }
                                    } else {
                                        $result['exception'] = $contrasenia[1];
                                    }
                                } else {
                                    $result['exception'] = 'No tiene acceso al sistema';
                                }
                            }
                        } else {
                            $result['exception'] = 'Alias inexistente';
                        }
                    } else {
                        $result['exception'] = 'Alias incorrecto';
                    }
                break;
                case 'autenticacion':
                $_POST = $usuario->validateForm($_POST);
                    if($usuario->setToken($_POST['codigo'])) {
                        if($usuario->getDatosToken()) {
                            if($usuario->deleteToken()) {
                                if ($usuario->UpdateLogin1()) {
                                    $_SESSION['idUsuario'] = $usuario->getId();
                                    $_SESSION['aliasUsuario'] = $usuario->getAlias();
                                    $_SESSION['tipoUsuario'] = $usuario->getTipo_usuario();
                                    $_SESSION['vistas'] = $usuario->readMenu();
                                    $_SESSION['tiempo'] = time();
                                    $result['status'] = 1;
                                } else {
                                    $result['exception'] = 'No pudimos actualizar su sesion';
                                }
                            } else {
                                $result['exception'] = 'Error al eliminar el token';
                            }
                            
                        } else {
                            $result['exception'] = 'Código incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Error al setear el token';
                    }
                break;
                //Operación para registrar el primer usuario
                case 'register':
                $_POST = $usuario->validateForm($_POST);
                if($usuario->readUsuarios()){
                    $result['exception'] = 'Ya existe un usuario registrado';
                } else {
                    if ($usuario->setAlias($_POST['alias'])) {
                        if($usuario->setCorreo($_POST['correo'])) {
                            if ($usuario->setEstado(isset($_POST['estado']) ? 1 : 0)) {
                                if ($usuario->setTipo_usuario($_POST['tipo'])) {
                                    //Se comprueba que las claves sean iguales
                                    if ($_POST['clave1'] == $_POST['clave2']) {
                                        if ($_POST['clave1'] != $_POST['alias']) {
                                            $contrasenia = $usuario->setClave($_POST['clave1']);
                                            if ($contrasenia[0]) {
                                                //Se comprueba que se haya seleccionado una imagen anteriormente
                                                if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
                                                    if ($usuario->setFoto($_FILES['archivo'], null)) {
                                                        if ($usuario->saveFile($_FILES['archivo'], $usuario->getRuta(), $usuario->getFoto())) {
                                                            $correo = $usuario->getCorreo();
                                                            $token_activacion = uniqid();
                                                            if($usuario->setToken($token_activacion)){
                                                                if($usuario->updateToken()){
                                                                    if ($usuario->createUsuario()) {
                                                                        try {
                                                                        $mail->isSMTP();                                            // Set mailer to use SMTP
                                                                        $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                                                                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                                                        $mail->Username   = 'test503sv@gmail.com';                             // SMTP username
                                                                        $mail->Password   = '71096669';                             // SMTP password
                                                                        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                                                                        $mail->Port       = 587;
                                                                        //Recipients
                                                                        $mail->setFrom('test503sv@gmail.com', 'Activar cuenta');
                                                                        $mail->addAddress($correo);
                                                                        // Content
                                                                        $mail->isHTML(true);                                  // Set email format to HTML
                                                                        $mail->Subject = 'Activar cuenta';
                                                                        $mail->Body    = 'Haga click <a href="http://localhost/admin/views/activacion.php?token='.$token_activacion.'">aquí</a> para activar su cuenta';
                                                                        $mail->send();
                                                                        $result['status'] = 1;
                                                                        } catch (Exception $e) {
                                                                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                                                        }
                                                                    } else {
                                                                        $result['exception'] = 'Operación fallida';
                                                                    }
                                                                } else{
                                                                    $result['exception'] = 'Error al actualizar el token';
                                                                }
                                                            } else {
                                                                $result['exception'] = 'Error al setear el token';
                                                            }
                                                        } else {
                                                            $result['status'] = 2;
                                                            $result['exception'] = 'No se guardó el archivo';
                                                        }
                                                    } else {
                                                        $result['exception'] = $usuario->getImageError();;
                                                    } 
                                                }   else {
                                                    $result['exception'] = 'Seleccione una imagen';
                                                }   
                                            } else {
                                                $result['exception'] = $contrasenia[1];
                                            }
                                        } else {
                                                $result['exception'] = 'La clave no puede ser igual al alias';
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
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Alias incorrecto';
                    }   
                }
                break;
                case 'activacion':
                $_POST = $usuario->validateForm($_POST);
                if($usuario->setToken($_POST['token'])) {
                    if($usuario->getDatosToken()) {
                        if($usuario->activarCuenta()) {
                            if($usuario->deleteToken()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Error al borrar el token';
                            }
                        } else {
                            $result['exception'] = 'Error al activar la cuenta';
                        }
                    } else {
                        $result['exception'] = 'Error al obtener los datos del usuario';
                    }
                } else {
                    $result['exception'] = 'Error al obtener el token';
                }
                break;
                
                case 'recuperarContrasena':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setCorreo($_POST['correo'])) {
                    if($usuario->checkCorreo()){
                        $correo = $usuario->getCorreo();
                        $token = uniqid();
                        if($usuario->setToken($token)){
                            if($usuario->updateToken()){
                                try {
                                $mail->isSMTP();                                            // Set mailer to use SMTP
                                $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                $mail->Username   = 'test503sv@gmail.com';                             // SMTP username
                                $mail->Password   = '71096669';                             // SMTP password
                                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                                $mail->Port       = 587;
                                //Recipients
                                $mail->setFrom('test503sv@gmail.com', 'Recuperar contraseña');
                                $mail->addAddress($correo);
                                // Content
                                $mail->isHTML(true);                                  // Set email format to HTML
                                $mail->Subject = 'Recuperar contraseña';
                                $mail->Body    = 'Haga click <a href="http://localhost/admin/views/nueva_contrasena.php?token='.$token.'">aquí</a> para recuperar su contraseña';
                            
                                $mail->send();
                                $result['status'] = 1;
                                } catch (Exception $e) {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
                            } else{
                                $result['exception'] = 'Error al actualizar el token';
                            }
                            
                        } else {
                            $result['exception'] = 'Error al setear el token';
                        }
                        
                    } else{
                        $result['exception'] = 'El correo no coincide con ningún usuario';
                    }
                } else {
                    $result['exception'] = 'Correo incorrecto';
                }
                break;
                case 'nuevaPassword':
                $_POST = $usuario->validateForm($_POST);
                if($usuario->setToken($_POST['token'])){
                    if ($_POST['nueva_contrasena'] == $_POST['nueva_contrasena2']) {
                        $contrasenia = $usuario->setClave($_POST['nueva_contrasena']);
                            if ($contrasenia[0]) {
                                if ($usuario->changePassword()) {
                                    if($usuario->deleteToken()){
                                        $result['status'] = 1;
                                    } else {
                                        $result['exception'] = 'Error al borrar el token';
                                    }
                                } else {
                                    $result['exception'] = 'Operación fallida';
                                }
                            } else {
                                $result['exception'] = $contrasenia[1];
                            }
                        } else {
                            $result['exception'] = 'Claves diferentes';
                        } 
                    } else {
                        $result['exception'] = 'Error al obtener los datos del usuario';
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