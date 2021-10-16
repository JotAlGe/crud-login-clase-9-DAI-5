<?php 
session_start();

//si tengo vacio mi elemento de sesion me tiene q redireccionar al login.. 
//al cerrarsesion para que mate todo de la sesion y el se encarga de ubicar en el login
if (empty($_SESSION['Usuario_Nombre']) ) {
    header('Location: cerrarsesion.php');
    exit;
}


//voy a necesitar la conexion: incluyo la funcion de Conexion.
require_once 'funciones/conexion.php';

//genero una variable para usar mi conexion desde donde me haga falta
//no envio parametros porque ya los tiene definidos por defecto
$MiConexion = ConexionBD();

//ahora voy a llamar el script con la funcion que genera mi listado
require_once 'funciones/select_usuarios.php';


//voy a ir listando lo necesario para trabajar en este script: 
$ListadoUsuarios = Listar_Usuarios($MiConexion);
$CantidadUsuarios = count($ListadoUsuarios);


?>

<?php require_once 'header.inc.php'; ?>

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
                <a class="navbar-brand" href="index.php">
                Usuario:  <?php echo $_SESSION['Usuario_Nombre'].' '.$_SESSION['Usuario_Apellido']; ?>
                </a>
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
                    <h1 class="page-header">Listado de Usuarios Registrados</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listado de Usuarios desde mi BD
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Apellido</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Pais</th>
                                            <th>Acciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i=0; $i<$CantidadUsuarios; $i++) { ?>
                                            <tr>
                                            <td><?php echo $ListadoUsuarios[$i]['ID']; ?></td>
                                            <td><?php echo $ListadoUsuarios[$i]['APELLIDO']; ?></td>
                                            <td><?php echo $ListadoUsuarios[$i]['NOMBRE']; ?></td>
                                            <td><?php echo $ListadoUsuarios[$i]['EMAIL']; ?></td>
                                            <td><?php echo $ListadoUsuarios[$i]['PAIS']; ?></td>
                                            <td>
                                            <a class="btn btn-success btn-circle btn-info " href="#" role="button" title="Ver datos">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                            <a class="btn btn-success btn-circle btn-warning" href="#" role="button" title="Anular acceso">
                                                <i class="fa fa-lock"></i>
                                            </a>
                                            <a class="btn btn-success btn-circle btn-danger " href="#" role="button" title="Borrar">
                                                <i class="fa fa-times"></i>
                                            </a>
                                            </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php require_once 'footer.inc.php'; ?>