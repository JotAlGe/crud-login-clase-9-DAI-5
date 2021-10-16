<?php
session_start();
//print_r($_SESSION);
require_once 'funciones/conexion.php';
$MiConexion = ConexionBD();



$Mensaje = '';
if (!empty($_POST['BotonLogin'])) {

    require_once 'funciones/login.php';
    $UsuarioLogueado = DatosLogin($_POST['email'], $_POST['password'], $MiConexion);

    //la consulta con la BD para que encuentre un usuario registrado con el usuario y clave brindados
    if (!empty($UsuarioLogueado)) {
        // $Mensaje ='ok! ya puedes ingresar';

        //generar los valores del usuario (esto va a venir de mi BD)
        $_SESSION['Usuario_Nombre']     =   $UsuarioLogueado['NOMBRE'];
        $_SESSION['Usuario_Apellido']   =   $UsuarioLogueado['APELLIDO'];
        $_SESSION['Usuario_Nivel']      =   $UsuarioLogueado['NIVEL'];
        $_SESSION['Usuario_Img']        =   $UsuarioLogueado['IMG'];
        $_SESSION['Usuario_Saludo']     =   $UsuarioLogueado['SALUDO'];

        // evalúa si la cuenta está activa o no
        if ($UsuarioLogueado['ACTIVO'] == 0) {
            $Mensaje = 'Ud. no se encuentra activo en el sistema.';
        } else {
            header('Location: index.php'); // manda al panel principal del usuario
            exit;
        }
    } else {
        $Mensaje = 'Datos incorrectos, ingresa nuevamente.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login al panel! </title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingresa tus datos</h3>
                    </div>
                    <div class="panel-body">

                        <div>
                            <img src='dist/img/login.png' />
                        </div>
                        <form role="form" method='post'>
                            <?php if (!empty($Mensaje)) { ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <?php echo $Mensaje; ?>
                                </div>
                            <?php } ?>

                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus value=''>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <div class="form-group text-center">
                                    Si no tienes cuenta, puedes registrarte <a href="registro.php"> aqui</a>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-default" value="Login" name="BotonLogin">Ingresar</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>