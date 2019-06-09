<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Unidades de medida');
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
        <div class="row">
            <div class="container">
                <table class="display" id="tabla-unidad">
                    <thead>
                        <tr>
                            <th>NOMBRE</th> 
                            <th>ABREVIATURA</th>
                            <th>ACCIONES</th>
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
                    <h5 class="modal-title">AGREGAR UNIDAD DE MEDIDA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-create">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-list"></i>
                            </div>
                            <div class="col-sm-11">
                                <input placeholder="Nombre de unidad" class="form-control" id="create_nombre" name="create_nombre"
                                    for="nombre_medida" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-cc"></i>
                            </div>
                            <div class="col-sm-11">
                                <input placeholder="Abreviatura. Ejm:(Kg)" class="form-control" id="create_descripcion" name="create_descripcion"
                                    for="descripcion" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
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
                    <h5 class="modal-title">MODIFICAR UNIDAD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-update">
                    <input type="hidden" id="id_unidad" name="id_unidad" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="update_unidad" type="text" name="update_unidad"
                                    class="validate form-control" placeholder="Unidad de medida" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">

                                <input id="update_descripcion" type="text" name="update_descripcion"
                                    class="validate form-control" placeholder="Abreviatura. Ejm:(Kg)" required>
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
    <!-- Modal de Eliminar -->
    <div class="modal fade" id="ventana3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ELIMINAR UNIDAD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>¿Está seguro de que desea eliminar esta unidad de medida?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
Dashboard::footerTemplate('unidadmedida.js', '#tabla-unidad');
?>


<script>
        bootstrapValidate("#create_nombre", "min:3:Ingrese un nombre mayor a 3 caracteres",
            "max:30:Ingrese un nombre menor de 30 caracteres")
    </script>
    <script>
        bootstrapValidate("#create_descripcion", "min:1:Ingrese una abreviación mayor de 0 caracteres",
            "max:30:Ingrese una descripción menor a 30 caracteres")
    </script>
    <script>
        bootstrapValidate('#create_nombre', 'required:Ingrese una unidad de medida')
    </script>
    <script>
        bootstrapValidate("#update_unidad", "min:3:Ingrese un nombre mayor a 3 caracteres",
            "max:30:Ingrese un nombre menor de 30 caracteres")
    </script>
    <script>
        bootstrapValidate("#update_descripcion", "min:1:Ingrese una abreviación mayor de 0 caracteres",
            "max:30:Ingrese una descripción menor a 30 caracteres")
    </script>
    <script>
        bootstrapValidate('#update_unidad', 'required:Ingrese una categoria')
    </script>

    </body>

    </html>