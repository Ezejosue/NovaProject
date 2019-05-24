<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>

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
                        <div class="login-logo">
                            <a href="#">
                                <img src="../resources/img/logo.png" alt="PizzaNova" />
                            </a>
                        </div>
                        <div class="login-form">
                            <form method="post" id="form-sesion">
                                <input type="text" id="usuario" name="usuario" class="validate form-control"
                                    placeholder="Usuario" required autofocus>
                                <br>
                                <input type="password" id="clave" name="clave" class="validate form-control"
                                    placeholder="Contraseña" required autofocus>
                                <br>
                                <button class="btn btn-lg btn-primary btn-block btn-signin tooltipped"
                                    data-tooltip="Ingresar" type="submit">Iniciar Sesión</button>
                            </form>
                            <div class="container text-center">
                                <p>
                                    ¿Olvidaste la contraseña?<br>
                                    <a href="#recuperar" class="btn btn-sm" data-toggle="modal">Recuperar</a>
                                </p>
                            </div>
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
    <script type="text/javascript" src="../core/controllers/index.js"></script>

</body>

</html>