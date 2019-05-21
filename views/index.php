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
    <link href="../resources/extras/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="../resources/extras/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="../resources/extras/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../resources/css/theme.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="../resources/extras/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../resources/css/imagen.css" rel="stylesheet" media="all">
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
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Correo electronico</label>
                                    <input class="au-input au-input--full" type="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input class="au-input au-input--full" type="password" name="password">
                                </div>
                                <a href="inicio.php" class="au-btn au-btn--block au-btn--green m-b-20 text-center"
                                    type="submit">Iniciar
                                    Sesión</a>

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
    <!-- Jquery JS-->
    <script src="../resources/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../resources/extras/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS-->
    <script src="../resources/extras/animsition/animsition.min.js"></script>
    <script src="../resources/extras/perfect-scrollbar/perfect-scrollbar.js"></script>
    <!-- Main JS-->
    <script src="../resources/js/main.js"></script>
    <script src="../resources/js/imagen.js"></script>

</body>

</html>