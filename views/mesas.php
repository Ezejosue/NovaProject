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
            <div class="col-sm-12 col-md-10 recent-report2">
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
            <form class="was-validated" method="post" id="form-orden">
                <div class="modal-body">
                    <div class="table-responsive">

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>IMAGEN</th>
                                    <th>PRODUCTO</th>
                                    <th>PRECIO</th>
                                    <th>CANTIDAD</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>
                                        <a href="" class="btn btn-danger" style="border-radius: 20px"><i
                                                class="fas fa-times"></i></a>
                                        <a href="" class="btn btn-primary" style="border-radius: 20px"><i
                                                class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <br>
                        <a href="#modal-agregar" class="btn btn-success modal-trigger" data-toggle="modal"
                            style="border-radius: 20px"><i class="fas fa-plus"></i></a>
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
                        <div class="col-sm-4 col-md-4">
                            <div id="lista" class="list-group">
                                
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div data-spy="scroll" data-target="#lista" data-offset="0"
                                class="scrollspy-example" id="productos">
                                
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </form>
</div>



<?php
Dashboard::footerTemplate('mesas.js', '');
?>
</body>

</html>