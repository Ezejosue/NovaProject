<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Usuarios');
?>
<!-- Fin Menu Responsive-->
<br>
<!-- Contenido-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <!-- Barra de busqueda -->
        <h2 class="pb-2 display-5 text-center">GESTIÓN DE CATEGORIAS</h2>
        <br>
        <div class="row">
            <div class="col-sm-11 col-9">
                <input type="text" id="myInput" class="form-control" placeholder="Buscar">
            </div>
            <div class="col-sm-1 col-3">
                <a href="#modal-create" class="btn btn-success btn-md" data-toggle="modal">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                </a>
            </div>
        </div>
        <br>
        <div class="card strpied-tabled-with-hover">
            <div class="card-header">
                <p class="card-category">Categorias</p>
            </div>
            <div class="card-body table-full-width table-responsive" id="myTable">
                <table id="tabla_categorias" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>IMAGEN</th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCIÓN</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_categorias">
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
                    <h5 class="modal-title">AGREGAR CATEGORIA</h5>
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
                                        name="create_archivo">
                                    <label class="custom-file-label" for="create_archivo">Escoga un
                                        archivo</label>
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
                                <input placeholder="Nombre" class="form-control" id="create_nombre" name="create_nombre"
                                    for="nombre_categoria">
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
                                    name="create_descripcion" for="descripcion" rows="3"></textarea>
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
                    <div class="modal-body">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Modal de Modificar -->
    <div class="modal fade" id="modal-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR CATEGORIA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-image"></i>
                        </div>
                        <div class="col-sm-11">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="create_archivo" name="create_archivo">
                                <label class="custom-file-label" for="create_archivo">Escoga un
                                    archivo</label>
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
                            <input placeholder="Nombre" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-file-alt"></i>
                        </div>
                        <div class="col-sm-11">
                            <textarea placeholder="Descripción" class="form-control" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
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
                    <h5 class="modal-title">ELIMINAR CATEGORIA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>¿Está seguro de que desea eliminar esta categoria?</h6>
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

    <script src="../resources/js/sweetalert.min.js"></script>
    <!-- Vendor JS-->

    <script src="../core/helpers/functions.js"></script>
    <script src="../core/controllers/categorias.js"></script>
    <script src="../core/controllers/account.js"></script>
    <script src="../resources/extras/animsition/animsition.min.js"></script>
    <script src="../resources/extras/perfect-scrollbar/perfect-scrollbar.js"></script>
    <!-- Main JS-->
    <script src="../resources/js/main.js"></script>
    <script src="../resources/js/imagen.js"></script>
    </body>

    </html>