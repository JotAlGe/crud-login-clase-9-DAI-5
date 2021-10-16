<?php
session_start();

if (empty($_SESSION['Usuario_Nombre'])) {
    header('Location: cerrarsesion.php');
    exit;
}
// conexión
require_once 'funciones/conexion.php';
$MiConexion = ConexionBD();

require_once 'funciones/insertar_pais.php';

$Mensaje = '';
$Estilo = 'danger';
if (!empty($_POST['BotonRegistrar'])) {

    # validar campo
    if (!empty($_POST['Nombre'])) {
        if (insertarPais($MiConexion)) {
            $Mensaje = 'Se ha registrado correctamente.';
            $_POST = array();
            $Estilo = 'success';
        }
    } else {
        $Mensaje = 'Complete el campo';
    }
}


require_once 'header.inc.php'; ?>

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Pagina inicial</a>
            </div>
            <!-- /.navbar-header -->

            <?php require_once 'user.inc.php'; ?>
            <!-- /.navbar-top-links -->

            <?php require_once 'menu.inc.php'; ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Formulario de Registración nuevo pais</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ingresa datos del nuevo pais
                        </div>
                        <div class="panel-body">
                            <form role="form" method='post'>

                                <div class="row">

                                    <div class="col-lg-6">

                                        <?php if (!empty($Mensaje)) { ?>
                                            <div class="alert alert-<?php echo $Estilo; ?> alert-dismissable">
                                                <?php echo $Mensaje; ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php } ?>

                                        <script>
                                            $(".alert").alert();
                                        </script>

                                        <div class="form-group">
                                            <label>Nombre:</label>
                                            <input class="form-control" type="text" name="Nombre" id="nombre" value="<?php echo !empty($_POST['Nombre']) ? $_POST['Nombre'] : ''; ?>">
                                        </div>


                                        <button type="submit" class="btn btn-default" value="Registrar" name="BotonRegistrar">Registrar</button>

                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                            </form>

                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php require_once 'footer.inc.php'; ?>