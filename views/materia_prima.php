<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Materia Prima');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-1 col-3">
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
                    <table class="table" id="tabla-materia_prima" width="100%">
                        <thead>
                            <tr>
                                <th>IMAGEN</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>CANTIDAD</th>
                                <th>CATEGORIA</th>
                                <th>UNIDAD DE MEDIDA</th>
                                <th>ESTADO</th>
                                <th>ACCIÓN</th>
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
                    <h5 class="modal-title">AGREGAR MATERIA PRIMA</h5>
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

                                <input id="create_nombre_materia" type="text" name="create_nombre_materia"
                                    class="validate form-control" placeholder="Nombre de materia prima" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">

                                <textarea placeholder="Descripción" class="form-control" id="create_descripcion_materia"
                                    name="create_descripcion_materia" for="create_descripcion_materia"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">

                                <input id="create_cantidad" type="number" name="create_cantidad"
                                    class="validate form-control" placeholder="Cantidad" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_categoria" name="create_categoria" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_unidad" name="create_unidad" class="form-control">
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
                                    <input type="file" class="custom-file-input" id="create_archivo"
                                        name="create_archivo">
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
                                    <input type="checkbox" class="custom-control-input" id="create_estado"
                                        name="create_estado">

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
    <div id="modal-update" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR MATERIA PRIMA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-update" enctype="multipart/form-data">
                    <input type="hidden" id="foto_materia" name="foto_materia" />
                    <input type="hidden" id="id_materia" name="id_materia" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">

                                <input id="nombre_materia" type="text" name="nombre_materia"
                                    class="validate form-control" placeholder="Nombre de materia prima" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">

                                <textarea placeholder="Descripción" class="form-control" id="descripcion_materia"
                                    name="descripcion_materia" for="descripcion_materia" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">

                                <input id="cantidad" type="number" name="cantidad"
                                    class="validate form-control" placeholder="Cantidad" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="update_categoria" name="update_categoria" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="update_unidad" name="update_unidad" class="form-control">
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
                                    <input type="file" class="custom-file-input" id="foto" name="foto">
                                    <label class="custom-file-label" for="foto">Escoga un archivo</label>
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
                                    <input type="checkbox" class="custom-control-input" id="update_estado"
                                        name="update_estado">

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
Dashboard::footerTemplate('materia_prima.js', '#tabla-materia_prima');
?>