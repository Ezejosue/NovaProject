<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Categorias');
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
                    <table class="table" id="tabla-categorias" width="100%">
                        <thead>
                            <tr>
                                <th>IMAGEN</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
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
                    <h5 class="modal-title">AGREGAR CATEGORÍA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-create" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-image"></i>
                            </div>
                            <div class="col-sm-11">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="create_archivo"
                                        name="create_archivo" required>
                                    <label class="custom-file-label" for="create_archivo">Escoge un archivo</label>
                                    <div class="invalid-feedback">Por favor seleccione una imagen 500 x 500</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-list"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_nombre" name="create_nombre" class="form-control" placeholder="Nombre" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-file-alt"></i>
                            </div>
                            <div class="col-sm-11">
                                <textarea placeholder="Descripción" class="form-control" id="create_descripcion"
                                    name="create_descripcion" for="descripcion" rows="3" required></textarea>
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
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Modal de Modificar -->
    <div id="modal-update" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR CATEGORÍA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-update" enctype="multipart/form-data">
                    <input type="hidden" id="foto_categoria" name="foto_categoria"/>
                    <input type="hidden" id="id_categoria" name="id_categoria"/>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-image"></i>
                            </div>
                            <div class="col-sm-11">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagen_categoria"
                                        name="imagen_categoria">
                                    <label class="custom-file-label" for="imagen_categoria">Escoge un archivo</label>
                                    <div class="invalid-feedback">Por favor seleccione una imagen 500 x 500</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-list"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="update_nombre_categoria" type="text" name="update_nombre_categoria"
                                    class="validate form-control" placeholder="Nombre de categoria" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-file-alt"></i>
                            </div>
                            <div class="col-sm-11">
                                <textarea class="form-control" id="update_descripcion"
                                    name="update_descripcion" for="descripcion" rows="3" required>
                                </textarea>
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
Dashboard::footerTemplate('categorias.js', '#tabla-categorias');
?>
    <script>
        bootstrapValidate("#create_nombre", "required:Campo obligatorio");
        bootstrapValidate("#create_nombre", "max:30:Ingrese un nombre menor a 30 caracteres");

        bootstrapValidate("#create_descripcion", "required:Campo obligatorio");
        bootstrapValidate("#create_descripcion", "max:80:Ingrese una descripción menor a 80 caracteres");


        bootstrapValidate("#update_nombre_categoria", "required:Campo obligatorio");
        bootstrapValidate("#update_nombre_categoria", "max:30:Ingrese un nombre válido");

        bootstrapValidate("#update_descripcion", "required:Campo obligatorio");
        bootstrapValidate("#update_descripcion", "max:80:Ingrese una descripción menor a 80 caracteres");
    </script>

    </body>

    </html>