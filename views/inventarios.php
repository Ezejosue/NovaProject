<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Facturas');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="alert alert-primary" role="alert" widht="80%">
                    <table class="display">
                        <thead>
                            <tr>
                                <b>ESTADO DE FACTURAS:</b>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr class="estados">
                                <div class="estados">
                                    <td class="estados">
                                        <button class="btn btn-info tooltipped" data-tooltip="Modificar"><i
                                                class="fa fa-edit"></i></button>
                                        <label for="enproceso"><b>EN PROCESO</b></label>
                                    </td>
                                    <td class="estados">
                                        <button class="btn btn-success tooltipped" data-tooltip="Modificar"><i
                                                class="fa fa-check-circle"></i></button>
                                        <label for="enproceso"><b>INGRESADA</b></label>
                                    </td>
                                    <td class="estados">
                                        <button class="btn btn-danger tooltipped" data-tooltip="Modificar"><i
                                                class="fas fa-backspace"></i></button>
                                        <label for="enproceso"><b>ANULADA</b></label>
                                    </td>
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-1 col-3">
                <a href="#modal-create" class="btn btn-success tooltipped modal-trigger" data-toggle="modal"
                    data-tooltip="Agregar">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                </a>
            </div>
            <div class="col-sm-1 col-3">
                <a href="#modal-create-factura" class="btn btn-success tooltipped modal-trigger" data-toggle="modal"
                    data-tooltip="Agregar">
                    <span class="btn-label">
                        AGREGAR FACTURA
                    </span>
                </a>
            </div>
        </div>
    </div>
    <br>
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
            <form  method="post" id="form-update-factura" enctype="multipart/form-data"
                autocomplete="off">
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
                    <input type="hidden" id="hestado" name="hestado" />
                    <input type="hidden" id="hid_factura" name="hid_factura" />
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



<!-- Modal de Agregar facturas -->
<div class="modal fade" id="modal-create-factura">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">AGREGAR FACTURA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="tyrue">&times;</span>
                </button>
            </div>
            <form  method="post" id="form-create-factura" enctype="multipart/form-data"
                autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="col-sm-11">
                            <input id="create_correlativo" type="text" name="create_correlativo"
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
                            <select id="create_proveedor" name="create_proveedor" class="form-control" required>
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
<!-- Modal de Agregar productos al inventario -->
<div id="modal-create" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">INGRESO AL INVENTARIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  method="post" id="form-create" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="col-sm-11">
                            <select id="create_factura" name="create_factura" class="form-control" required>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="col-sm-11">
                            <select id="create_materia" name="create_materia" class="form-control" required>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="col-sm-11">
                            <input id="create_cantidad" type="number" name="create_cantidad"
                                class="validate form-control" placeholder="Cantidad" required>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="col-sm-11">
                            <input id="create_precio" type="number" name="create_precio" class="validate form-control"
                                placeholder="0.00" max="999.99" min="0.01" required />
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
<!-- Modal de modificar productos del inventario -->
<div id="modal-update-producto" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MODIFICAR PRODUCTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  method="post" id="form-update-producto" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" id="id_inventario" name="id_inventario" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="col-sm-11">
                            <select id="update_materia" name="update_materia" class="form-control" required>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="col-sm-11">
                            <input id="update_cantidad" type="number" name="update_cantidad"
                                class="validate form-control" placeholder="Cantidad" required>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="col-sm-11">
                            <input id="update_precio" type="number" name="update_precio" class="validate form-control"
                                placeholder="0.00" max="999.99" min="0.01" required />
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
<?php
Dashboard::footerTemplate('inventarios.js', '#tabla-facturas');
?>
</body>

</html>