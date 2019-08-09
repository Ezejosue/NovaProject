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
                <h3 align="center" class="title-1">Existencias.</h3>
                <div class="chart-info">
                </div>
                <div class="au-card-inner">
                    <h5 align="center">existencias por categoria</h5>
                    <canvas id="existencia_categoria"></canvas>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Contenedor para la gráfica-->
                    <div>
                        <div class="recent-report2">
                            <h3 align="center" class="title-1">Ventas.</h3>
                            <div class="chart-info">
                            </div>
                            <div class="au-card-inner">
                                <h5 align="center">Platillos más vendidos</h5>
                                <canvas id="venta_platillo"></canvas>
                                <hr>
                                <h5 align="center">Platillos menos vendidos</h5>
                                <canvas id="venta_platillo_menor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Contenedor para la gráfica-->
                            <div>
                                <div class="recent-report2">
                                    <h3 align="center" class="title-1">Precios de platillos.</h3>
                                    <div class="chart-info">
                                    </div>
                                    <h5 align="center">Platillos más caros.</h5>
                                    <canvas id="mayor_platillo"></canvas>
                                    <hr>
                                    <h5 align="center">Platillos más baratos.</h5>
                                    <canvas id="menor_platillo"></canvas>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>


                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <!-- Contenedor para la gráfica-->
                                <div>
                                    <div class="recent-report2">
                                        <h3 align="center" class="title-1">Graficas con parametros.</h3>
                                        <div class="chart-info">
                                        </div>
                                        <h5 align="center">Platillos más vendidos por categoria.</h5>
                                        <canvas id="grafica_ventas"></canvas>
                                        <div class="form-group">
                                            <form>
                                                <select id="id_categoria" class="form-control" title="Seleccione una categoria">
                                                </select>
                                                <br>
                                                <button id="bloqueo" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Refresque la pagina en caso de querer una segunda grafica."
                                                    type="button" onclick="CategoriaClick()">Obtener grafico</button>
                                        </div>
                                    </form>

                                <hr>
                                <h5 align="center">Platillos más vendidos del mes.</h5>
                                        <canvas id="grafica_ventas"></canvas>
                                        <div class="form-group">
                                            <form>
                                                <select id="id_categoria" class="form-control">
                                                </select>
                                                <br>
                                                <button class="btn btn-primary tooltipped" data-tooltip="Crear" title="hola"
                                                   id="bloqueo" type="button"  onclick="CategoriaClick(this.id)">Obtener grafico</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>


                    <?php
        Dashboard::footerTemplate('index.js', '');
        ?>