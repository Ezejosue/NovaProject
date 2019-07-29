<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Ordenes');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-sm-12 col-md-10 recent-report2 text-center">
                <h3 class="title-3 text-center">Seleccione una mesa</h3>
                <br>
                <form action="post" id="data-mesas">

                    <br>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>
<!-- Modal de Agregar -->
<div class="modal fade" id="modal-orden">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ORDEN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-orden">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            <a href="#modal-agregar" class="btn btn-success modal-trigger" data-toggle="modal"
                                style="border-radius: 20px; margin: 15px;"><i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-6">
                        <input type="text" id="pre-pedido" name="pre-pedido">
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="row">
                                <h6 class="">MESA: #</h6>
                                <h6 id="mesa"> </h6>
                            </div>

                            <div class="row">
                                <h6 class="">TOTAL A PAGAR: $</h6>
                                <h6 id="total"> </h6>
                            </div>
                            <div class="row" id="boton-pago">
                                
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>IMAGEN</th>
                                    <th>PRODUCTO</th>
                                    <th>PRECIO</th>
                                    <th>CANTIDAD</th>
                                    <th>SUBTOTAL</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody id="prepedido">
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    </form>
</div>

<div class="modal fade" id="modal-agregar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PRODUCTOS A AGREGAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-agregar">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="idmesaxd" name="idmesaxd">
                        <div class="col-sm-4 col-md-4">
                            <div id="lista" class="list-group">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div data-spy="scroll" data-target="#lista">
                                <div class="row" id="productos">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-modificar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MODIFICAR CANTIDAD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-modificar">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <input type="number" class="form-control" id="nueva_cantidad" name="nueva_cantidad" max="999" min="1">
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 text-center" id="ingresar_cantidad">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
Dashboard::footerTemplate('ordenes.js', '');
?>
</body>

</html>