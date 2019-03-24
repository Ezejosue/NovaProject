<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categorias</title>

    <link href="resources/css/font-face.css" rel="stylesheet" media="all">
    <link href="resources/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="resources/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="resources/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="resources/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="resources/css/theme.css" rel="stylesheet" media="all">
    <link href="resources/css/imagen.css" rel="stylesheet" media="all">
    <link href="resources/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- SIDEBAR-->
        <?php
                require "core/models/menu.php";
                sitepack::menu();
        ?>
        <!-- Fin SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- Menu Responsive-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="resources/images/logo.png" alt="PizzaNova" />
                                </a>
                            </div>

                            <div class="header-button-item mr-0 js-sidebar-btn">
                                <i class="zmdi zmdi-menu"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="#">
                        <img src="resources/images/logo.png" alt="PizzaNova" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="resources/images/icon/avatar-big-01.jpg" alt="John Doe" />
                        </div>
                        <h4 class="name">john doe</h4>
                        <a href="login.php">Cerrar Sesión</a>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li>
                                <a href="index.php">
                                    <i class="fas fa-tachometer-alt"></i>Vista General
                                    <span class="arrow">

                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="perfil.php">
                                    <i class="fas fa-user-circle"></i>Perfil</a>

                            </li>
                            <li>
                                <a href="categorias.php">
                                    <i class="fas fa-list"></i>Categorías</a>
                            </li>
                            <li>
                                <a href="productos.php">
                                    <i class="fas fa-shopping-basket"></i>Productos</a>
                            </li>
                            <li>
                                <a href="usuarios.php">
                                    <i class="fas fa-users"></i>Usuarios</a>
                            </li>
                            <li>
                                <a href="empleados.php">
                                    <i class="fas fa-id-card"></i>Empleados</a>
                            </li>
                            </li>
                            <li>
                                <a href="reportes.php">
                                    <i class="fas fa-chart-bar"></i>Reportes</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
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
                            <p class="card-category">Categorias</p>
                        </div>
                        <div class="card-body table-full-width table-responsive" id="myTable">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
                                        <th>Descripción</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Harina</td>
                                        <th></th>
                                        <td></td>
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
                                        <td>Coca-Cola</td>
                                        <th></th>
                                        <td></td>
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
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jamón</td>
                                        <th> </th>
                                        <td></td>
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
                                <h5 class="modal-title">AGREGAR CATEGORIA</h5>
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
                                        <textarea placeholder="Descripción" class="form-control"
                                            id="exampleFormControlTextarea1" rows="3"></textarea>
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
                                <h5 class="modal-title">MODIFICAR CATEGORIA</h5>
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
                                        <textarea placeholder="Descripción" class="form-control"
                                            id="exampleFormControlTextarea1" rows="3"></textarea>
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

                <script src="resources/vendor/jquery-3.3.1.min.js"></script>
                <script src="resources/vendor/bootstrap-4.1/bootstrap.min.js"></script>
                <script src="resources/vendor/animsition/animsition.min.js"></script>
                <script src="resources/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
                <script src="resources/vendor/chartjs/Chart.bundle.min.js"></script>
                <script src="resources/js/main.js"></script>

</body>

</html>