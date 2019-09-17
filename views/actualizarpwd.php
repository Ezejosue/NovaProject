<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar cont</title>

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
                        <div class="recuperar-form">
                            <form method="post" id="form-recuperar-contrasena">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="col-sm-11">
                                        <input type="email" id="correo" name="correo" placeholder="Ingrese su correo"
                                            class="form-control" autocomplete="off">
                                        <br>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="alert alert-info text-center" role="alert">
                                            Se le enviará un correo con las instrucciones para actualizar su contraseña
                                        </div>
                                    </div>

                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                    <br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../resources/js/jquery-3.2.1.min.js"></script>
    <script src="../resources/extras/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
    <script src="../resources/extras/animsition/animsition.min.js"></script>
    <script type="text/javascript" src="../core/helpers/functions.js"></script>
    <script type="text/javascript" src="../core/controllers/login.js"></script>

</body>

</html>