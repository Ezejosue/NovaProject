<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar</title>

    <!-- Fontfaces CSS-->
    <link href="../resources/css/font-face.css" rel="stylesheet" media="all">
    <link href="../resources/extras/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="../resources/extras/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../resources/css/theme.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="../resources/extras/animsition/animsition.min.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-form text-center">
                            <form method="post" id="form-register">
                                <input id="alias" type="text" name="alias" class="validate form-control"
                                    placeholder="Nombre De Usuario" required>
                                <br>
                                <input id="clave1" type="password" name="clave1"
                                    class="validate form-control" placeholder="Contraseña" required>
                                <br>
                                <input id="clave2" type="password" name="clave2"
                                    class="validate form-control" placeholder="Repetir contraseña" required>
                                <br>
                                <select id="tipo" name="tipo" class="form-control"> </select>
                                <br>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="archivo"
                                        name="archivo">
                                    <label class="custom-file-label" for="archivo">Escoga un archivo</label>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="fa fa-eye-slash"></i>
                                    </div>
                                    <div class="col-sm-11">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="estado"
                                                name="estado">

                                            <label class="custom-control-label" for="estado">
                                                <i class="fa fa-eye"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-lg btn-primary" type="submit"
                                    data-tooltip="Registrar">Registrarse</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de Agregar -->
    <div class="modal fade" id="recuperar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recuperar contraseña</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="col-sm-11">
                            <input placeholder="Ingrese su correo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../resources/js/jquery-3.2.1.min.js"></script>
    <script src="../resources/extras/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
    <script src="../resources/extras/animsition/animsition.min.js"></script>
    <script type="text/javascript" src="../core/helpers/functions.js"></script>
    <script type="text/javascript" src="../core/controllers/account.js"></script>
    <script type="text/javascript" src="../core/controllers/register.js"></script>

</body>

</html>