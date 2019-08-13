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
                    <div class="row">
                        <div class="col-md-3 col-lg-3"></div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <a class="btn btn-primary btn-lg btn-block active" href="../core/report/reporte1.php"
                                target="_blank" role="button">Platillos por categoría</a>
                            <a class="btn btn-primary btn-lg btn-block active" href="../core/report/reporte2.php"
                                target="_blank" role="button">Pedidos
                                por fecha</a>
                            <a class="btn btn-primary btn-lg btn-block active" href="../core/report/reporte3.php"
                                target="_blank" role="button">Materia
                                prima por categoría</a>
                            <a class="btn btn-primary btn-lg btn-block active" href="../core/report/reporte4.php"
                                target="_blank" role="button">Ganancia
                                por platillo</a>
                            <a class="btn btn-primary btn-lg btn-block active" href="../core/report/reporte5.php"
                                target="_blank" role="button">Ganancia
                                por categoría</a>
                        </div>
                        <div class="col-md-3 col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contenido-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <!-- Barra de búsqueda -->
        <h2 class="pb-2 display-5 text-center">REPORTES CON PARÁMETROS</h2>
        <br>
        <div class="col-lg-12">
            <div class="au-card m-b-30">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-lg-3"></div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h5 align="center">Ganancias de platillos por categoría</h5>
                            <br>
                            <div class="form-group">
                                <form id="form1" name="form1">
                                    <select id="id_categoria" name="id_categoria" class="form-control"
                                        title="Seleccione una categoría">
                                    </select>
                                    <br>
                                    <button class="btn btn-primary mx-auto " type="button"
                                        onclick="CategoriasClick_1()">Obtener reporte</button>
                            </div>
                            </form>
                            <br>
                            <h5 align="center">Ventas por fecha</h5>
                            <br>
                            <div class="form-group">
                            <form id="form2" name="form2">
                                <div class="form-group">
                                    <input type="hidden" id="fecha_escondida1" name="fecha_escondida">
                                    <input id="fecha_pedido" name="fecha_pedido" type="date"
                                        value="yyyy-mm-dd" class="form-control" require>
                                        <br>
                                    <br>
                                    <button class="btn btn-primary mx-auto " type="button"
                                    onclick="pegarFecha1() ,CategoriasClick_2()" >Obtener reporte</button>
                            </div>
                            </form>
                            <br>
                            <h5 align="center">Cantidad de materia prima por categoria</h5>
                            <br>
                            <form method="post" id="form3" name="form3">
                                <div class="form-group">

                                    <select id="id_materia" name="id_materia" class="form-control"
                                        title="Seleccione una categoría">
                                    </select>
                                    <br>
                                    <button class="btn btn-primary mx-auto " type="button"
                                        onclick="CategoriasClick_3()">Obtener reporte</button>
                                </div>
                            </form>
                                <br>
                            <form>
                                <h5 align="center">Cantidad de productos desperdiciados</h5>
                                <br>
                                <div class="form-group">
                                    <p>Fecha Inicial</p>
                                    <input type="hidden" id="fecha_escondida" name="fecha_escondida">
                                    <input id="fecha_desperdicio" name="fecha_desperdicio" type="date"
                                        value="yyyy-mm-dd" class="form-control" require>
                                    <br>
                                    <p>Fecha Final</p>
                                    <input type="hidden" id="fecha_escondida2" name="fecha_escondida2">
                                    <input id="fecha_desperdicio_final" name="fecha_desperdicio_final" type="date"
                                        value="yyyy-mm-dd" class="form-control" require>
                                    <br>
                                    <button class="btn btn-primary mx-auto " type="button"
                                        onclick="pegarFecha(), CategoriasClick_4()">Obtener reporte</button>
                                </div>
                            </form>
                            <br>
                            <h5 align="center">Ventas por mes</h5>
                            <br>
                            <div class="form-group">
                                <form method="post" id="form5" name="form5">
                                    <select id="idMes" name="idMes" class="form-control"
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
                                    <button class="btn btn-primary mx-auto " type="button"
                                        onclick="CategoriasClick_5()">Obtener reporte</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    Dashboard::footerTemplate('reportes.js', '');    
?>

</body>

</html>