<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Dashboard');
?>
    <!-- Contenido-->
    <br>
    <br>
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
    <!-- END STATISTIC-->
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
                    <!-- END RECENT REPORT 2 -->
                </div>
                <div class="col-xl-4">
                </div>
                <!-- END RECENT REPORT 2 -->
            </div>
            <div class="col-xl-4">
            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->

<?php
Dashboard::footerTemplate('account.js', '');
?>
<!-- end document-->