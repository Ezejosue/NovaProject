<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
<<<<<<< HEAD
require_once('../../core/models/categorias.php');

// Se comprueba si existe una acción a realizar, de lo contrario se muestra un mensaje de error
if (isset($_GET['action'])) {
	session_start();
	$categoria = new Categorias;
	$result = array('status' => 0, 'exception' => '');
	// Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
	if (isset($_SESSION['idUsuario'])) {
		switch ($_GET['action']) {
			case 'read':
				if ($result['dataset'] = $categoria->readCategorias()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay categorías registradas';
				}
				break;
			case 'create':
				$_POST = $categoria->validateForm($_POST);
        		if ($categoria->setNombre($_POST['create_nombre'])) {
					if ($categoria->setDescripcion($_POST['create_descripcion'])) {
						if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
							if ($categoria->setImagen($_FILES['create_archivo'], null)) {
								if ($categoria->setEstado(isset($_POST['create_estado']) ? 1:0)) {
								if ($categoria->createCategoria()) {
									$result['id'] = conexion::getLastRowId();
									$result['status'] = 1;
									if ($categoria->saveFile($_FILES['create_archivo'], $categoria->getRuta(), $categoria->getImagen())) {
										$result['message'] = 'Categoría creada correctamente';
									} else {
										$result['message'] = 'Categoría creada. No se guardó el archivo';
									}
								}
								else {
									$result['exception'] = 'Operacion fallida';
								}
								} else {
									$result['exception'] = 'Estado incorrecto';
								}
							} else {
								$result['exception'] = $categoria->getImageError();
							}
						} else {
							$result['exception'] = 'Seleccione una imagen';
						}
					} else {
						$result['exception'] = 'Descripción incorrecta';
					}
				} else {
					$result['exception'] = 'Nombre incorrecto';
				}
            	break;
            case 'get':
                if ($categoria->setId($_POST['id_categoria'])) {
                    if ($result['dataset'] = $categoria->getCategoria()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Categoría inexistente';
                    }
                } else {
                    $result['exception'] = 'Categoría incorrecta';
                }
            	break;
			case 'update':
				$_POST = $categoria->validateForm($_POST);
				if ($categoria->setId($_POST['id_categoria'])) {
					if ($categoria->getCategoria()) {
		                if ($categoria->setNombre($_POST['update_nombre_categoria'])) {
							if ($categoria->setDescripcion($_POST['update_descripcion'])) {
								if ($categoria->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
								if (is_uploaded_file($_FILES['imagen_categoria']['tmp_name'])) {
									if ($categoria->setImagen($_FILES['imagen_categoria'], $_POST['foto_categoria'])) {
										$archivo = true;
									} else {
										$result['exception'] = $categoria->getImageError();
										$archivo = false;
									}
								} else {
									if (!$categoria->setImagen(null, $_POST['foto_categoria'])) {
										$result['exception'] = $categoria->getImageError();
									}
									$archivo = false;
								}
								if ($categoria->updateCategoria()) {
									$result['status'] = 1;
									if ($archivo) {
										if ($categoria->saveFile($_FILES['imagen_categoria'], $categoria->getRuta(), $categoria->getImagen())) {
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
							} else{
								$result['exception'] = 'Estado incorrecto';
							} 
						}else {
								$result['exception'] = 'Descripción incorrecta';
							}
						} else {
							$result['exception'] = 'Nombre incorrecto';
						}
					} else {
						$result['exception'] = 'Categoría inexistente';
					}
				} else {
					$result['exception'] = 'Categoría incorrecta';
				}
            	break;
            case 'delete':
				if ($categoria->setId($_POST['id_categoria'])) {
					if ($categoria->getCategoria()) {
						if ($categoria->deleteCategoria()) {
							$result['status'] = 1;
							if ($categoria->deleteFile($categoria->getRuta(), $_POST['foto_categoria'])) {
								$result['message'] = 'Categoría eliminada correctamente';
							} else {
								$result['message'] = 'Categoría eliminada. No se borró el archivo';
							}
						} else {
							$result['exception'] = 'Operación fallida';
						}
					} else {
						$result['exception'] = 'Categoría inexistente';
					}
				} else {
					$result['exception'] = 'Categoría incorrecta';
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
=======
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

            //Operación para crear nuevos platillos 
            case 'create':
                $_POST = $platillo->validateForm($_POST);
                    if ($platillo->setNombre($_POST['create_platillos'])) {
                            if ($platillo->setPrecio($_POST['create_precio'])) {
                                if ($platillo->setCategoria($_POST['create_categoria'])) {
                                    if ($platillo->setReceta($_POST['create_receta'])) {
                                        if ($platillo->setEstado(isset($_POST['estado']) ? 1:0)) {
                                            if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
                                                if ($platillo->setImagen($_FILES['create_archivo'], null)) {
                                                    if ($platillo->createPlatillo()) {
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
                                            $result['exception'] = 'Estado incorrecto';
                                        }  
                                    } else {
                                        $result['exception'] = 'Seleccione una receta';
                                    }  
                                } else {
                                $result['exception'] = 'Seleccione una categoria';
                            }  
                            } else {
                                $result['exception'] = 'Precio incorrecto';
                            }
                    } else {
                        $result['exception'] = 'Nombre incorrecto';
                    }                                     
                    break;
                
            //Operación para saber el platillo a modificar
            case 'get':
                if ($platillo->setId($_POST['id_platillo'])) {
                    if ($result['dataset'] = $platillo->getPlatillo()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Platillos inexistente';
                    }
                } else {
                    $result['exception'] = 'Platillo incorrecto';
                }
                break;
            //Operación para actualizar un platillo
            case 'update':
				$_POST = $platillo->validateForm($_POST);
				if ($platillo->setId($_POST['id_platillo'])) {
					if ($platillo->getPlatillo()) {
		                if ($platillo->setNombre($_POST['update_nombre_platillo'])) {
                            if ($platillo->setPrecio($_POST['update_precio'])) {
                                if ($platillo->setCategoria($_POST['update_categoria'])) {
                                     if ($platillo->setReceta($_POST['update_receta'])) {
                                    if ($platillo->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
                                            //Se comprueba que se haya subido una imagen
                                            if (is_uploaded_file($_FILES['update_imagen']['tmp_name'])) {
                                                if ($platillo->setImagen($_FILES['update_imagen'], $_POST['imagen'])) {
                                                    $archivo = true;
                                                } else {
                                                    $result['exception'] = $platillo->getImageError();
                                                    $archivo = false;
                                                }
                                            } else {
                                                if (!$platillo->setImagen(null, $_POST['imagen'])) {
                                                    $result['exception'] = $platillo->getImageError();
                                                }
                                                $archivo = false;
                                            }
                                        if ($platillo->updatePlatillo()) {
                                            $result['status'] = 1;
                                            if ($archivo) {
                                                if ($platillo->saveFile($_FILES['imagen'], $platillo->getRuta(), $platillo->getImagen())) {
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
                                                $result['exception'] = 'Estado incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione una receta';
                                            }
                                    }else {
                                        $result['exception'] = 'Seleccione una categoria';
                                    } 
                                }else {
                                    $result['exception'] = 'Precio incorrecto';
                                }
                            }else {
                                $result['exception'] = 'Nombre de platillo incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Platillos inexistente';
                        }
                    } else {
                        $result['exception'] = 'Platillo incorrecto';
                    }
                    break;
            //Operación para eliminar un usuario
            case 'delete':
            //El caso a elimiar es el de deleteplatillo
                    if ($platillo->setId($_POST['id_platillo'])) {
                        if ($platillo->getId()) {
                            if ($platillo->deletePlatillo()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'Platillo inexistente';
                        }
                    } else {
                        $result['exception'] = 'Platillo incorrecto';
                    }
                break;
            //Operación para mostrar los tipos de categorias en la tabla
            case 'readReceta':
                if ($result['dataset'] = $platillo->readReceta()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;
                //Operacion para mostrar los tipos de receta en el tabla
            case 'readCategoria':
                if ($result['dataset'] = $platillo->readCategoria()) {
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
>>>>>>> master
