<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Tipo de usuarios');
?>
<!-- Contenido-->
            <!-- Contenido-->
            <div class="main-content">
                <div class="container">
                    <!-- Barra de busqueda -->
                    <h2 class="pb-2 display-5 text-center">GESTIÓN DE EMPLEADOS</h2>
                    <br>
                    <div class="row">
                        <div class="col-sm-11 col-9">
                            <input type="text" id="myInput" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="col-sm-1 col-3">
                            <a href="#ventana1" class="btn btn-success btn-md" data-toggle="modal">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <p class="card-category">Empleados</p>
                        </div>
                        <div class="card-body table-full-width table-responsive" id="myTable">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Gerardo</td>
                                        <td>Ramirez</td>
                                        <td>gerardogo145@gmail.com</td>
                                        <td>77075797</td>
                                        <td>
                                            <div clas="col-sm-1">
                                                <a href="#ventana2" class="btn btn-info" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div clas="col-sm-1">
                                                <a href="#ventana3" class="btn btn-danger" data-toggle="modal">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Gerardo</td>
                                        <td>Ramirez</td>
                                        <td>gerardogo145@gmail.com</td>
                                        <td>77075797</td>
                                        <td>
                                            <div clas="col-sm-1">
                                                <a href="#ventana2" class="btn btn-info" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div clas="col-sm-1">
                                                <a href="#ventana3" class="btn btn-danger" data-toggle="modal">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Gerardo</td>
                                        <td>Ramirez</td>
                                        <td>gerardogo145@gmail.com</td>
                                        <td>77075797</td>
                                        <td>
                                            <div clas="col-sm-1">
                                                <a href="#ventana2" class="btn btn-info" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div clas="col-sm-1">
                                                <a href="#ventana3" class="btn btn-danger" data-toggle="modal">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modals-->
                <!-- Modal de Agregar -->
                <div class="modal fade" id="ventana1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">AGREGAR EMPLEADO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="preview">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-4">
                                                <button id="triggerUpload" class="btn btn-primary"> <i
                                                        class="fa fa-magic"></i>
                                                    Subir imagen</button>
                                                <input type="file" id="filePicker" />
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
                                        <input type="email" id="inputEmail" class="form-control" placeholder="Correo"
                                            required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="col-sm-11">
                                        <input type="date" min="1950-01-01" max="2001-01-01"
                                            placeholder="Fecha de nacimiento" class="form-control">
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
                                        <i class="fa fa-address-card"></i>
                                    </div>
                                    <div class="col-sm-11">
                                        <input placeholder="DUI" class="form-control">
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
                <!-- Modal de Modificar -->
                <div class="modal fade" id="ventana2">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">MODIFICAR EMPLEADO</h5>
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
                                                <button id="triggerUpload1" class="btn btn-primary"> <i
                                                        class="fa fa-magic"></i>
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
                                        <input type="email" id="inputEmail" class="form-control" placeholder="Correo"
                                            required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="col-sm-11">
                                        <input type="date" placeholder="Fecha de nacimiento" class="form-control">
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
                                        <i class="fa fa-address-card"></i>
                                    </div>
                                    <div class="col-sm-11">
                                        <input placeholder="DUI" class="form-control">
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
                                <h5 class="modal-title">ELIMINAR EMPLEADO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h6>¿Está seguro de que desea eliminar este empleado?</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Jquery JS-->
                <script src="../resources/js/jquery-3.2.1.min.js"></script>
                <!-- Bootstrap JS-->
                <script src="../resources/extras/bootstrap-4.1/bootstrap.min.js"></script>
                <!-- Vendor JS-->
                <script src="../resources/extras/animsition/animsition.min.js"></script>
                <script src="../resources/extras/perfect-scrollbar/perfect-scrollbar.js"></script>
                <!-- Main JS-->
                <script src="../resources/js/main.js"></script>
                <script src="../resources/js/imagen.js"></script>



</body>

</html>