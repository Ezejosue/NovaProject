<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="../resources/css/font-face.css" rel="stylesheet" media="all">
    <link href="../resources/extras/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../resources/extras/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="../resources/extras/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="../resources/extras/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../resources/css/theme.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="../resources/extras/animsition/animsition.min.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <?php
                require "../core/helpers/menu.php";
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
                                <a href="inicio.php">
                                    <img src="../resources/img/logo.png" alt="PizzaNova" />
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
                        <img src="../resources/img/logo.png" alt="PizzaNova" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="../resources/img/icon/avatar-big-01.jpg" alt="John Doe" />
                        </div>
                        <h4 class="name">john doe</h4>
                        <a href="index.php">Cerrar Sesión</a>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li>
                                <a href="inicio.php">
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
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">688</h2>
                                    <span class="desc">Productos</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-shopping-basket"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">15</h2>
                                    <span class="desc">Categorías</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-view-list"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">10,368</h2>
                                    <span class="desc">Usuarios</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">$1,060,386</h2>
                                    <span class="desc">Ganancias</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <!-- RECENT REPORT-->
                                <div class="recent-report2">
                                    <h3 class="title-3">Productos por categorías</h3>
                                    <div class="chart-info">
                                    </div>
                                    <div class="au-card-inner">
                                        <canvas id="singelBarChart"></canvas>
                                    </div>
                                </div>
                                <!-- END RECENT REPORT 2 -->
                            </div>
                            <div class="col-xl-4">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="../resources/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../resources/extras/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS-->
    <script src="../resources/extras/animsition/animsition.min.js"></script>
    <script src="../resources/extras/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../resources/extras/chartjs/Chart.bundle.min.js"></script>
    <!-- Main JS-->
    <script src="../resources/js/main.js"></script>
</body>

</html>
<!-- end document-->