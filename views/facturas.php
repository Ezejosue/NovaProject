<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Facturas');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="container">
                <table class="display" id="tabla-facturas">
                    <thead>
                        <tr>
                            <th>CORRELATIVO</th>
                            <th>PROVEEDOR</th>
                            <th>FECHA DE INGRESO</th>
                            <th>RESPONSABLE</th>
                            <th>ACCIONES</th>
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
    <!-- Modal de modificar facturas -->
    <div class="modal fade" id="modal-update-factura">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR FACTURA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="tyrue">&times;</span>
                    </button>
                </div>
                <form class="was-validated" method="post" id="form-update-factura" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" id="id_factura" name="id_factura" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="update_correlativo" type="text" name="update_correlativo"
                                    class="validate form-control" placeholder="Correlativo Ej.(000000001)" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="update_proveedor" name="update_proveedor" class="form-control" required>
                                </select>
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



    <div id="modal-factura" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DETALLE DE FACTURA </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-estado" enctype="multipart/form-data">
                    <!-- <input type="hidden" id="id_factura" name="id_factura" /> -->
                    <div class="modal-body">
                        <div id="correlativo">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div id="fecha_ingreso">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div id="estado">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div id="responsable">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div id="total">
                        </div>
                    </div>
                    <div class="modal-body" id='estado_btn'>
                        <div class="row">
                            <div class="col-sm-11">
                                <div class="custom-control custom-switch">
                                    <button type="submit" class="btn btn-primary tooltipped" data-tooltip="Crear">CAMBIAR ESTADO</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" id="form-factura" enctype="multipart/form-data">
                    <div class="modal-body">
                        <table class="table" id="tabla-detalle-factura">
                            <thead>
                                <tr>
                                    <th>MATERIA PRIMA</th>
                                    <th>CANTIDAD</th>
                                    <th>PRECIO</th>
                                    <th>SUBTOTAL</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-read-detalle-factura">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-body">
                        <div id="total">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
Dashboard::footerTemplate('facturas.js', '#tabla-facturas');
?>
    </body>

    </html>