<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Pedidos');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="container">
                <table class="display" id="tabla-pedidos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>FECHA Y HORA DEL PEDIDO</th>
                            <th>USUARIO</th>
                            <th>DETALLE</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-read">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal de Modificar -->
    <div id="modal-update" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR MESA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-update">
                    <input type="hidden" id="id_mesa" name="id_mesa" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-list"></i>
                            </div>
                            <div class="col-sm-11">
                                <input class="form-control" id="update_nombre" name="update_nombre">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-eye-slash"></i>
                            </div>
                            <div class="col-sm-11">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="update_estado"
                                        name="update_estado">
                                    <label class="custom-control-label" for="update_estado">
                                        <i class="fa fa-eye"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary tooltipped" data-tooltip="Crear">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-detalle" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DETALLE DEL PEDIDO #</h5>
                    <h5 class="modal-title" id="id-pedido" name="id-pedido"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-detalle" enctype="multipart/form-data">
                    <div class="modal-body">
                        <table class="table" id="tabla-detalle">
                            <thead>
                                <tr>
                                    <th>PLATILLO</th>
                                    <th>CANTIDAD</th>
                                    <th>PRECIO UNITARIO</th>
                                    <th>SUBTOTAL</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-read-detalle">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-body">
                        <div id="total">
                        </div>
                        <div id="usuario">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
Dashboard::footerTemplate('pedidos.js', '#tabla-pedidos');
?>
</body>
</html>