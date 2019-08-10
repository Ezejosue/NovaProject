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
                    <h5 align="center">Existencias por categoría</h5>
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
                                        <h3 align="center" class="title-1">Gráficas con parámetros.</h3>
                                        <div class="chart-info">
                                        </div>
                                        <h5 align="center">Platillos más vendidos por categoría.</h5>
                                        <canvas id="grafica_ventas"></canvas>
                                        <div class="form-group">
                                            <form>
                                                <select id="id_categoria" class="form-control"
                                                    title="Seleccione una categoría">
                                                </select>
                                                <br>
                                                <button id="bloqueo" class="btn btn-primary mx-auto "
                                                    title="Refresque la pagina en caso de querer una segunda gráfica."
                                                    type="button" onclick="CategoriaClick()">Obtener gráfico</button>
                                        </div>
                                        </form>

                                        <hr>
                                        <h5 align="center">Platillos más vendidos del mes.</h5>
                                        <canvas id="grafica_mes"></canvas>
                                        <div class="form-group">
                                            <form>
                                                <select id="idMes" class="form-control"
                                                    title="desee el mes que desea consultar">
                                                    <option value="1">Enero</option>
                                                    <option value="2">Febrero</option>
                                                    <option value="3">Marzo</option>
                                                    <option value="4">Abril</option>
                                                    <option value="5">Mayo</option>
                                                    <option value="7">Junio</option>
                                                    <option value="6">Julio</option>
                                                    <option value="8">Agosto</option>
                                                    <option value="9">Septiembre</option>
                                                    <option value="10">Octubre</option>
                                                    <option value="11">Noviembre</option>
                                                    <option value="12">Diciembre</option>
                                                </select>
                                                <br>
                                                <button class="btn btn-primary" data-tooltip="Crear"
                                                    title="Si desea una segunda gráfica recargue la pagina"
                                                    id="botonMes" type="button" onclick="MesClick()">Obtener
                                                    gráfico</button>
                                        </div>
                                        </form>
                                        <hr>
                                        <h5 align="center">Desperdicios por mes.</h5>
                                        <canvas id="grafica_desperdicios_mes"></canvas>
                                        
                                        <div class="form-group">
                                            <form>
                                                <select id="idMesDesperdicios" class="form-control"
                                                    title="desee el mes que desea consultar">
                                                    <option value="1">Enero</option>
                                                    <option value="2">Febrero</option>
                                                    <option value="3">Marzo</option>
                                                    <option value="4">Abril</option>
                                                    <option value="5">Mayo</option>
                                                    <option value="7">Junio</option>
                                                    <option value="6">Julio</option>
                                                    <option value="8">Agosto</option>
                                                    <option value="9">Septiembre</option>
                                                    <option value="10">Octubre</option>
                                                    <option value="11">Noviembre</option>
                                                    <option value="12">Diciembre</option>
                                                </select>
                                                <br>
                                                <button class="btn btn-primary" data-tooltip="Crear"
                                                    title="Si desea una segunda gráfica recargue la pagina"
                                                    id="botonMesDesperdicios" type="button" onclick="MesDesperdiciosClick()">Obtener
                                                    gráfico</button>
                                        </div>
                                        </form>
                                        <hr>
                                        <h5 align="center">Cantidad de materia prima por categoria.</h5>
                                        <canvas id="existencia_categoria_materia"></canvas>
                                        <div class="form-group">
                                            <form>
                                                <select id="id_categoria_materia" class="form-control"
                                                    title="Seleccione una categoría">
                                                </select>
                                                <br>
                                                <button id="botonmateria" class="btn btn-primary mx-auto "
                                                    title="Refresque la pagina en caso de querer una segunda gráfica."
                                                    type="button" onclick="MateriaClick()">Obtener gráfico</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                    <?php
        Dashboard::footerTemplate('index.js', '');
        ?>