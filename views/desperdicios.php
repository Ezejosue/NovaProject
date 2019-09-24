<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Desperdicios');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-3">
                <a href="#modal-create" class="btn btn-success tooltipped modal-trigger" data-toggle="modal"
                    data-tooltip="Agregar">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                </a>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="tabla-desperdicios" width="100%">
                        <thead>
                            <tr>
                                <th>RECETA</th>
                                <th>CANTIDAD</th>
                                <th>USUARIO</th>
                                <th>EMPLEADO</th>
                                <th>FECHA</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-read">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals-->
    <!-- Modal de Agregar -->
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">AGREGAR DESPERDICIOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="tyrue">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-create" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_cantidad" type="text" name="create_cantidad"
                                    class="validate form-control" placeholder="Cantidad" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_id_receta" name="create_id_receta" class="form-control" required>
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
                                <select id="create_id_usuario" name="create_id_usuario" class="form-control" required>
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
                                <select id="create_id_empleado" name="create_id_empleado" class="form-control" required>
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
                    <h5 class="modal-title">MODIFICAR DESPERDICIOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-update" enctype="multipart/form-data">
                    <input type="hidden" id="id_desperdicios" name="id_desperdicios" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="update_cantidad" type="text" name="update_cantidad"
                                    class="validate form-control" placeholder="Cantidad" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="col-sm-11">
                                <!-- Aquí es donde se manda a traer el campo de categoria  -->
                                <select id="update_id_receta" name="update_id_receta" class="form-control" required>
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
                                <!-- Aquí es donde se manda a traer el campo de categoria  -->
                                <select id="update_id_usuario" name="update_id_usuario" class="form-control" required>
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
                                <!-- Aquí es donde se manda a traer el campo de la llave id_receta -->
                                <select id="update_id_empleado" name="update_id_empleado" class="form-control" required>
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
    <?php
Dashboard::footerTemplate('desperdicios.js', '#tabla-desperdicios');
?>
    </body>
    </html>