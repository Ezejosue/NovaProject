<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Reportes');
?>
    <!-- Contenido-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <!-- Barra de búsqueda -->
            <h2 class="pb-2 display-5 text-center">REPORTES</h2>
            <br>
            <div class="col-lg-12">
                <div class="au-card m-b-30">
                    <div class="container">
                        <h3 class="title-2 m-b-40">Reportes</h3>
                        <a class="btn btn-primary" href="../core/report/reporte1.php" target="_blank" role="button">Platillos por categoría</a>
                        <a class="btn btn-primary" href="../core/report/reporte2.php"  target="_blank" role="button">Pedidos por fecha</a> 
                        <a class="btn btn-primary" href="../core/report/reporte3.php"  target="_blank" role="button">Materia prima por categoría</a>
                        <a class="btn btn-primary" href="../core/report/reporte4.php"  target="_blank" role="button">Ganancia por platillo</a>
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

    <!-- Jquery JS-->
    <script src="../resources/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../resources/extras/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS-->
    <script src="../resources/extras/animsition/animsition.min.js"></script>
    <script src="../resources/extras/perfect-scrollbar/perfect-scrollbar.js"></script>
    <!-- Main JS-->
    <script src="../resources/extras/chartjs/Chart.bundle.min.js"></script>
    <script src="../resources/js/main.js"></script>

    </body>

    </html>