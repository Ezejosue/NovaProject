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
                            <h5 align="center">Platillos más vendidos por categoría.</h5>
                            <div class="form-group">
                                <form id="form1" name="form1">
                                    <select id="id_categoria" name="id_categoria" class="form-control" title="Seleccione una categoría">
                                    </select>
                                    <br>  
                                    <button id="bloqueo" class="btn btn-primary mx-auto "
                                     type="button"
                                        onclick="CategoriasClick_1()">Obtener reporte</button>
                            </div>
                            </form>
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