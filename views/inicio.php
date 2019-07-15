<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Dashboard');
?>
<!-- Contenido-->
<br>
<br>
<!-- Contenedor donde se muestra el número de los registros de cada categoría-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="statistic__item" id="data-productos">
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="statistic__item" id="data-categorias">
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="statistic__item" id="data-usuarios">
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="statistic__item" id="data-empleados">
            </div>
        </div>
    </div>
</div>
<!-- Fin del contenedor-->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <!-- Contenedor para la gráfica-->
            <div class="recent-report2">
                <h3 class="title-3">Productos por categorías</h3>
                <div class="chart-info">
                </div>
                <div class="au-card-inner">
                    <canvas id="singelBarChart"></canvas>
                </div>
                <!-- Fin contenedor -->
            </div>
            <div class="col-xl-4">
            </div>
        </div>
        <div class="col-xl-4">
        </div>
    </div>
</div>

<?php
Dashboard::footerTemplate('account.js', '');
?>
