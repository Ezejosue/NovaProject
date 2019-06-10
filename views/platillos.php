<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Platillos');
?>
<!-- Contenido de lo que es la pantalla principal-->
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
                    <table class="table" id="tabla-platillos" width="100%">
                        <thead>
                            <tr>
                                <!-- Aqui es donde se ve los campos que tiene la tabla -->
                                <th>IMAGEN</th>
                                <th>NOMBRE</th>
                                <th>PRECIO</th>
                                <th>CATEGORIA</th>
                                <th>RECETA</th>
                                <th>ESTADO</th>
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
    <!-- Este modal es para agregar y manda a traer dos llaves la de categoria y receta de los
    demas cruds -->
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">AGREGAR PLATILLOS</h5>
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
                                <!--Aqui es donde se ingresa los datos en el primer campo del nombre del platillo  -->
                                <input id="create_platillos" type="text" name="create_platillos"
                                    class="validate form-control" placeholder="Nombre de Platillo" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                            <div class="col-sm-11">
                                <!-- Aqui se agrega el segundo campo que es el del precio con su validacion respectiva en la parte de abajo -->
                                <input id="create_precio" type="number" name="create_precio"
                                    class="validate form-control" max="999.99" min="0.01" step="any" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-sm-11">
                                <!-- aqui es donde se manda a traer el campo de categoria  -->
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
                                <!-- aqui es donde se manda a traer el campo de la llave id_receta -->
                                <select id="create_receta" name="create_receta" class="form-control" required>
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
                                    <!-- el campo el en cual se sube la imagen -->
                                    <input type="file" class="custom-file-input" id="create_archivo"
                                        name="create_archivo" required>
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
                                    <!-- el campo donde se controla el estado de los platillos 
                                si estan activos y desactivados -->
                                    <input type="checkbox" class="custom-control-input" id="estado" name="estado">
                                    <label class="custom-control-label" for="estado">
                                        <i class="fa fa-eye"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- los respectivos botones del modal  -->
                    <div class="modal-body text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary tooltipped" data-tooltip="Crear">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal de Modificar -->
    <!-- aqui se hace el modal de modificar del crud de platillos -->
    <div id="modal-update" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR PLATILLOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="was-validated" method="post" id="form-update" enctype="multipart/form-data">
                    <input type="hidden" id="imagen" name="imagen" />
                    <input type="hidden" id="id_platillo" name="id_platillo" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <!-- vemos el campo del nombre platillo para el modal de update -->
                                <input id="update_nombre_platillo" type="text" name="update_nombre_platillo"
                                    class="validate form-control" placeholder="Nombre del platillo" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                            <div class="col-sm-11">
                                <!-- vemos el campo del precio en el modal de update -->
                                <input id="update_precio" type="number" name="update_precio"
                                    class="validate form-control" placeholder="Precio de platillo" max="999.99"
                                    min="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-sm-11">
                                <!-- vemos el campo de actualizar la categoria en el modal de update -->
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
                                <!-- vemos el campo de actualizar la receta en el modal de update siempre de platillos -->
                                <select id="update_receta" name="update_receta" class="form-control">
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
                                    <!-- vemos el campo para poder cambiar la imagen siempre en el modal de update platillos -->
                                    <input type="file" class="custom-file-input" id="update_imagen"
                                        name="update_imagen">
                                    <label class="custom-file-label" for="update_imagen">Escoga un archivo</label>
                                    <div class="invalid-feedback">Tipo de archivo a subir invalido</div>
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
                                    <!-- aqui es donde actualizamos el estado del crud de platillos siempre en el modal de update -->
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
                        <!-- los botones del modal del update -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary tooltipped" data-tooltip="Crear">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
Dashboard::footerTemplate('platillos.js', '#tabla-platillos');
?>
    <!--aqui es donde se hace las validaciones del lado del cliente en el crud de platillos   -->
    <script>
        bootstrapValidate("#create_precio", "required:Ingrese un precio correcto")
    </script>
    <script>
        bootstrapValidate('#create_platillos', 'required:Ingrese un nombre de un platillo')
    </script>
    <script>
        bootstrapValidate('#create_platillos', 'min:3:Ingrese un platillo mayor de 3 caracteres',
            "max:80:Ingrese un platillo menor de 80 caracteres")
    </script>
    </body>

    </html>