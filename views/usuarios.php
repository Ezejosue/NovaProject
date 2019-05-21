<body class="animsition">
    <div class="page-wrapper">
        <!-- SIDEBAR-->
        <?php
        require_once('../core/helpers/dashboard.php');
        Dashboard::headerTemplate('Usuarios');
        ?>
            
                <!-- Contenido-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="row">
                            <div class="col-sm-1 col-3">
                                <a href="#modal-create" class="btn btn-success tooltipped modal-trigger" data-toggle="modal" data-tooltip="Agregar">
                                    <span class="btn-label">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="container">
                                <table class="display" id="tabla-usuarios">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>NOMBRES</th>
                                            <th>APELLIDOS</th>
                                            <th>ALIAS</th>
                                            <th>TIPO DE USUARIO</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-read">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modals-->
                    <!-- Modal de Agregar -->
                    <div class="modal fade" id="modal-create">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">AGREGAR USUARIO</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" id="form-create" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_nombres" type="text" name="create_nombres" class="validate form-control" placeholder="Nombres" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_apellidos" type="text" name="create_apellidos" class="validate form-control" placeholder="Apellidos" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-user-shield"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_alias" type="text" name="create_alias" class="validate form-control" placeholder="Nombre De Usuario" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_clave1" type="password" name="create_clave1" class="validate form-control" placeholder="Contraseña" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_clave2" type="password" name="create_clave2" class="validate form-control" placeholder="Repetir contraseña"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-box-open"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <select id="create_tipo" name="create_tipo" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-image"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="create_archivo" name="create_archivo">
                                                    <label class="custom-file-label" for="create_archivo">Escoga un archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-eye-slash"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="create_estado" name="create_estado">

                                                    <label class="custom-control-label" for="create_estado">
                                                        <i class="fa fa-eye"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body text-center">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary tooltipped" data-tooltip="Crear">Aceptar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal de Modificar -->
                    <div class="modal fade" id="ventana2">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">MODIFICAR USUARIO</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="preview1">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4">
                                                    <button id="triggerUpload1" class="btn btn-primary">
                                                        <i class="fa fa-magic"></i>
                                                        Subir imagen</button>
                                                    <input type="file" id="filePicker1" />
                                                </div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Nombre" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Apellidos" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input type="email" id="inputEmail" class="form-control" placeholder="Correo" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input type="date" min="1950-01-01" max="2001-01-01" placeholder="Fecha de nacimiento" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Nombre de usuario" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Teléfono" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <select class="custom-select" id="inlineFormCustomSelectPref">
                                                <option selected>Género</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-map-marker-alt"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Dirección" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal de Eliminar -->
                    <div class="modal fade" id="ventana3">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ELIMINAR USUARIO</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h6>¿Está seguro de que desea eliminar este usuario?</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
Dashboard::footerTemplate('usuarios.js', '#tabla-usuarios');
?>