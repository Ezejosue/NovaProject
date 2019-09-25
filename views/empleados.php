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
                    <table class="table" id="tabla-empleados" width="100%">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>DUI</th>
                                <th>DIRECCIÓN</th>
                                <th>CORREO</th>
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
    <div class="modal fade" id="modal-empleado">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">INFORMACIÓN DEL EMPLEADO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-sm-5 md-5">
                            <div class="row">
                                <strong>Nombre:</strong>
                                <p id="info-nombre"></p>
                            </div>
                            <div class="row">
                                <strong>Apellido:</strong>
                                <p id="info-apellido"></p>
                            </div>
                            <div class="row">
                                <strong>DUI:</strong>
                                <p id="info-dui"></p>
                            </div>
                            <div class="row">
                                <strong>Direccion:</strong>
                                <p id="info-direccion"></p>
                            </div>
                            <div class="row">
                                <strong>Teléfono:</strong>
                                <p id="info-telefono"></p>
                            </div>
                            <div class="row">
                                <strong>Genero</strong>
                                <p id="info-genero"></p>
                            </div>
                        </div>
                        <div class="col-sm-5 md-5">
                            <div class="row">
                                <strong>Fecha de nacimiento:</strong>
                                <p id="info-nacimiento"></p>
                            </div>
                            <div class="row">
                                <strong>Nacionalidad:</strong>
                                <p id="info-nacionalidad"></p>
                            </div>
                            <div class="row">
                                <strong>Correo</strong>
                                <p id="info-correo"></p>
                            </div>
                            <div class="row">
                                <strong>Cargo:</strong>
                                <p id="info-cargo"></p>
                            </div>
                            <div class="row">
                                <strong>Usuario:</strong>
                                <p id="info-usuario"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                <input id="create_nombre" type="text" name="create_nombre" autocomplete="off"
                                    class="validate form-control" placeholder="Nombre" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_apellido" type="text" name="create_apellido" autocomplete="off"
                                    class="validate form-control" placeholder="Apellido" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-id-badge"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_dui" type="text" name="create_dui" autocomplete="off"
                                    class="validate form-control" validate min="00000000" placeholder="DUI (00000000-0)"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-street-view"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_direccion" type="text" name="create_direccion" autocomplete="off"
                                    class="validate form-control" placeholder="Dirección" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-phone-volume"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_telefono" type="text" name="create_telefono" autocomplete="off"
                                    class="validate form-control" placeholder="Teléfono (0000-0000)" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-venus-mars"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_genero" type="text" name="create_genero" class="validate form-control"
                                    placeholder="M/F" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div class="col-sm-11">
                                <label for="create_fecha">Fecha de nacimiento</label>
                                <input id="create_fecha" type="date" min="01/01/1952" max="01/01/2001"
                                    name="create_fecha" autocomplete="off" class="validate form-control" required>

                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fab fa-font-awesome-flag"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_nacionalidad" type="text" name="create_nacionalidad"
                                    autocomplete="off" class="validate form-control" placeholder="Nacionalidad"
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
                                <input id="create_email" type="text" name="create_email" autocomplete="off"
                                    class="validate form-control" placeholder="correo" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-male"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_cargo" name="create_cargo" class="form-control" required>
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
                                <select id="create_usuario" name="create_usuario" class="form-control" required>
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
    <div class="modal fade" id="modal-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR EMPLEADO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-update" enctype="multipart/form-data">
                    <input type="hidden" id="id_empleado" name="id_empleado" />
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_nombre" type="text" name="update_nombre"
                                        class="validate form-control" placeholder="Nombre de empleado" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_apellido" type="text" name="update_apellido"
                                        class="validate form-control" placeholder="Apellido" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-id-badge"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_dui" type="text" name="update_dui" class="validate form-control"
                                        placeholder="00000000-0" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-street-view"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_direccion" type="text" name="update_direccion"
                                        class="validate form-control" placeholder="Dirección" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_telefono" type="text" name="update_telefono"
                                        class="validate form-control" validate placeholder="Teléfono (0000-0000)"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-venus-mars"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_genero" type="text" name="update_genero"
                                        class="validate form-control" placeholder="M/F" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_fecha" type="date" name="update_fecha"
                                        class="validate form-control" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fab fa-font-awesome-flag"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_nacionalidad" type="text" name="update_nacionalidad"
                                        class="validate form-control" placeholder="Nacionalidad" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-at"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_email" type="text" name="update_email"
                                        class="validate form-control" placeholder="ejemplo@mail.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div class="col-sm-11">
                                    <select id="update_cargo" name="update_cargo" class="form-control">
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
                                    <select id="update_usuario" name="update_usuario" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary tooltipped"
                                data-tooltip="Crear">Aceptar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <?php
Dashboard::footerTemplate('empleados.js', '#tabla-empleados');
?>
    <!-- validaciones del lado del cliente en el modal de agregar empleados -->

    <script>
        bootstrapValidate("#create_dui", "min:9:Ingrese su DUI completo");
        bootstrapValidate("#create_dui", "max:10:El DUI debe contener solo 9 caracteres incluido el (-)");

        bootstrapValidate("#create_nombre", "required:Campo obligatorio");
        bootstrapValidate("#create_apellido", "required:Campo obligatorio");
        bootstrapValidate("#create_genero", "min:1:Coloca F o M según corresponda");
        bootstrapValidate("#create_fecha", "min:10:Ingresa un fecha válida");
        bootstrapValidate("#create_direccion", "required:Ingrese una dirección");
        bootstrapValidate("#create_telefono", "min:9:Ingrese un número de teléfono válido");
        bootstrapValidate("#create_nacionalidad", "required:Ingrese nacionalidad");
        bootstrapValidate('#create_email', 'email:Ingrese un email válido');

        /*   <!-- validaciones del lado del cliente en el modal de modificar empleados --> */

        bootstrapValidate("#update_dui", "min:9:Ingrese su DUI completo");
        bootstrapValidate("#update_dui", "max:10:El DUI lleva solo 9 caracteres incluido el (-)");
        bootstrapValidate("#update_nombre", "required:Campo obligatorio");
        bootstrapValidate("#update_apellido", "required:Campo obligatorio");
        bootstrapValidate("#update_genero", "min:1:Coloca F o M según corresponda");
        bootstrapValidate("#update_fecha", "min:10:Ingresa un fecha válida");
        bootstrapValidate("#update_direccion", "required:Ingrese una dirección");
        bootstrapValidate("#update_telefono", "min:9:Ingrese un número de teléfono válido");
        bootstrapValidate("#update_nacionalidad", "required:Ingrese nacionalidad");
        bootstrapValidate('#update_email', 'email:Ingrese un email válido');
    </script>
    </body>

    </html>