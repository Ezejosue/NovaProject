<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Empleados');
?>
    <!-- Contenido-->
    <div class="main-content">
        <div class="container">
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
                    <table class="display" id="tabla-empleados">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>DUI</th>
                                <th>DIRECCIÓN</th>
                                <th>TELEFONO</th>
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
                        <h5 class="modal-title">AGREGAR EMPLEADO</h5>
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
                                    <input id="create_nombre" type="text" name="create_nombre" class="validate form-control" placeholder="Nombre De Empleado"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="create_apellido" type="text" name="create_apellido" class="validate form-control" placeholder="Apellido" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-id-badge"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="create_dui" type="number" name="create_dui" class="validate form-control" placeholder="00000000-0" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-street-view"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="create_direccion" type="text" name="create_direccion" class="validate form-control" placeholder="Dirección" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-id-badge"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="create_telefono" type="number" name="create_telefono" class="validate form-control" placeholder="00000000" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-venus-mars"></i>
                                </div>
                                <div class="col-sm-11">
                                    <select id="create_genero" name="create_genero" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fab fa-font-awesome-flag"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="create_nacionalidad" type="text" name="create_nacionalidad" class="validate form-control" placeholder="Nacionalidad"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-at"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="create_email" type="text" name="create_email" class="validate form-control" placeholder="@mail.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div class="col-sm-11">
                                    <select id="create_cargo" name="create_cargo" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="col-sm-11">
                                    <select id="create_usuario" name="create_usuario" class="form-control">
                                    </select>
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
        <div id="modal-update" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">MODIFICAR PRODUCTO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="form-update" enctype="multipart/form-data">
                        <input type="hidden" id="foto_usuario" name="foto_usuario" />
                        <input type="hidden" id="id_usuario" name="id_usuario" />
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="col-sm-11">

                                    <input id="update_alias" type="text" name="update_alias" class="validate form-control" placeholder="Nombre De Usuario" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="col-sm-11">
                                    <select id="update_tipo" name="update_tipo" class="form-control">
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
                                        <input type="file" class="custom-file-input" id="update_archivo" name="update_archivo">
                                        <label class="custom-file-label" for="update_archivo">Escoga un archivo</label>
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
                                        <input type="checkbox" class="custom-control-input" id="update_estado" name="update_estado">

                                        <label class="custom-control-label" for="update_estado">
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
        <?php
Dashboard::footerTemplate('empleados.js', '#tabla-empleados');
?>