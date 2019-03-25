<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>

    <link href="resources/css/font-face.css" rel="stylesheet" media="all">
    <link href="resources/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="resources/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="resources/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="resources/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="resources/css/theme.css" rel="stylesheet" media="all">
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
                    <h2 class="pb-2 display-5 text-center">REPORTES</h2>
                    <br>
                    <div class="col-lg-12">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Team Commits</h3>
                                <canvas id="team-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-12">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Bar chart</h3>
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Yearly Sales</h3>
                                <canvas id="sales-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <script src="resources/vendor/jquery-3.3.1.min.js"></script>
            <script src="resources/vendor/bootstrap-4.1/bootstrap.min.js"></script>
            <script src="resources/vendor/animsition/animsition.min.js"></script>
            <script src="resources/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="resources/vendor/chartjs/Chart.bundle.min.js"></script>
            <script src="resources/js/main.js"></script>
            <script src="resources/vendor/chartjs/Chart.bundle.min.js"></script>

</body>

</html>