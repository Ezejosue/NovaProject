<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Poveedores');
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
                    <table class="table" id="tabla-proveedores" width="100%">
                        <thead>
                            <tr>
                                <th>PROVEEDOR</th>
                                <th>CONTACTO</th>
                                <th>TELÉFONO</th>
                                <th>RUBRO</th>
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
                    <h5 class="modal-title">AGREGAR PROVEEDOR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="tyrue">&times;</span>
                    </button>
                </div>
                <form class="was-validated" method="post" id="form-create" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_proveedor" type="text" name="create_proveedor"
                                    class="validate form-control" placeholder="Proveedor" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_contacto" type="text" name="create_contacto"
                                    class="validate form-control" placeholder="Nombre de contacto" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_telefono" type="number" name="create_telefono"
                                    class="validate form-control" placeholder="Teléfono" max="999999" min="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_categoria" name="create_categoria" class="form-control" required>
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
                                <select id="create_unidad" name="create_unidad" class="form-control" required>
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
                <form class="was-validated" method="post" id="form-update" enctype="multipart/form-data">
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

                                <input type="number" id="cantidad" name="cantidad" class="validate form-control"
                                    placeholder="Cantidad" max="999999" min="1" required>
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
                                    <label class="custom-file-label" for="foto">Escoge un archivo</label>
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

    <!-- validaciones del lado de cliente para agregar materias primas -->
    <script>
        bootstrapValidate("#create_nombre_materia", "min:3:Ingrese un nombre mayor a 3 caracteres");
        bootstrapValidate("#create_nombre_materia", "max:10:Ingrese un nombre menor a 10 caracteres");

        bootstrapValidate("#create_descripcion_materia", "min:6:Ingrese una descripción mayor de 6 caracteres");
        bootstrapValidate("#create_descripcion_materia", "max:80:Ingrese una descripción menor a 80 caracteres");

        bootstrapValidate("#create_cantidad", "min:1:Ingrese una cantidad válida");
        bootstrapValidate("#create_cantidad", "max:6:Ingrese una cantidad válida");

        bootstrapValidate("#nombre_materia", "min:3:Ingrese un nombre mayor a 3 caracteres");
        bootstrapValidate("#nombre_materia", "max:10:Ingrese un nombre menor a 10 caracteres");

        bootstrapValidate("#descripcion_materia", "min:6:Ingrese una descripción mayor de 6 caracteres");
        bootstrapValidate("#descripcion_materia", "max:80:Ingrese una descripción menor a 80 caracteres");

        bootstrapValidate("#cantidad", "min:1:Ingrese una cantidad válida");
        bootstrapValidate("#cantidad", "max:6:Ingrese una cantidad válida");
    </script>

    </body>

    </html>