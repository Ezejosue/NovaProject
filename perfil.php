<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="resources/css/font-face.css" rel="stylesheet" media="all">
    <link href="resources/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="resources/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="resources/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="resources/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="resources/css/theme.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="resources/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <!--Preview CSS-->
    <link href="resources/css/preview.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <?php
                require "core/models/menu.php";
                sitepack::menu();
        ?>
        <!-- END MENU SIDEBAR-->

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
            <section class="statistic">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>EDITAR PERFIL</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                                    <div class="preview img-wrapper"></div>
                                    <div class="file-upload-wrapper">
                                        <input type="file" name="file" class="file-upload-native" accept="image/*"/>
                                        <h3 align="center">Subir imagen</h3>
                                        <input type="text" class="file-upload-text" />
                                    </div>
                                    <div class="col col-md-2"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" id="input1-group1" name="input1-group1"
                                                placeholder="Nombre" class="form-control" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" id="input1-group1" name="input1-group1"
                                                placeholder="Apellidos" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input type="email" id="inputEmail" class="form-control"
                                                placeholder="Correo">
                                        </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" id="input1-group1" name="input1-group1"
                                                placeholder="Fecha de nacimiento" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" id="input1-group1" name="input1-group1"
                                                placeholder="Nombre de usuario" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <input type="password" id="inputPassword5" class="form-control" placeholder="Contraseña"
                                                aria-describedby="passwordHelpBlock">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" id="input1-group1" name="input1-group1"
                                                placeholder="Teléfono" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <select class="custom-select" id="inlineFormCustomSelectPref">
                                                <option selected>Género</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker-alt"></i>
                                            </div>
                                            <input type="text" id="input1-group1" name="input1-group1"
                                                placeholder="Dirección" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa fa-check"></i> Editar
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="resources/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="resources/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS-->
    <script src="resources/vendor/animsition/animsition.min.js"></script>
    <script src="resources/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="resources/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="resources/vendor/vector-map/jquery.vmap.min.js"></script>
    <!-- Main JS-->
    <script src="resources/js/main.js"></script>
    <!-- preview JS-->
    <script src="resources/js/preview.js"></script>

</body>

</html>
<!-- end document-->