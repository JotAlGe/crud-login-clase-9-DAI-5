<?php 
require_once 'funciones/conexion.php';
$MiConexion=ConexionBD(); 

require_once 'funciones/select_paises.php';
$ListadoPaises = Listar_Paises($MiConexion);
$CantidadPaises= count($ListadoPaises);

require_once 'funciones/validacion_registro_usuario.php'; 
require_once 'funciones/insertar_usuarios.php';


$Mensaje='';
$Estilo='warning';
if (!empty($_POST['BotonRegistrar'])) {
    //estoy en condiciones de poder validar los datos
    $Mensaje=Validar_Datos();
    if (empty($Mensaje)) {
        if (InsertarUsuarios($MiConexion) != false) {
            $Mensaje = 'Se ha registrado correctamente.';
            $_POST = array(); 
            $Estilo = 'success'; 
        }
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
                <a class="navbar-brand" href="login.php">Ingresar al panel</a>
            </div>
            <!-- /.navbar-header -->
           
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Formulario de Registración</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ingresa tus datos
                        </div>
                        <div class="panel-body">
                            <form role="form" method='post'>

                                <div class="row">
                                    <div class="col-lg-4" style="text-align: center;">
                                        <img src="dist/img/register.png" />
                                        <br />
                                    </div>
                                    <div class="col-lg-6">
                                        
                                        <?php if (!empty($Mensaje)) { ?>
                                        <div class="alert alert-<?php echo $Estilo; ?> alert-dismissable">
                                        <?php echo $Mensaje; ?>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="form-group">
                                            <label>Nombre:</label>
                                            <input class="form-control" type="text" name="Nombre" id="nombre" 
                                            value="<?php echo !empty($_POST['Nombre']) ? $_POST['Nombre'] : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Apellido:</label>
                                            <input class="form-control" type="text" name="Apellido" id="apellido" 
                                            value="<?php echo !empty($_POST['Apellido']) ? $_POST['Apellido'] : ''; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input class="form-control" type="email" name="Email" id="email" 
                                            value="<?php echo !empty($_POST['Email']) ? $_POST['Email'] : ''; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Clave:</label>
                                            <input class="form-control" type="password" name="Clave" id="clave" value="">
                                        </div>

                                        <div class="form-group">
                                            <label>Reingresa la clave:</label>
                                            <input class="form-control" type="password" name="ReClave" id="reclave" value="">
                                        </div>

                                        <div class="form-group">
                                            <label>Pais</label>
                                            <select class="form-control" name="Pais" id="pais">
                                                <option value="">Selecciona...</option>
                                                <?php 
                                                $selected='';
                                                for ($i=0 ; $i < $CantidadPaises ; $i++) {
                                                    if (!empty($_POST['Pais']) && $_POST['Pais'] ==  $ListadoPaises[$i]['ID']) {
                                                        $selected = 'selected';
                                                    }else {
                                                        $selected='';
                                                    }
                                                    ?>
                                                    <option value="<?php echo $ListadoPaises[$i]['ID']; ?>" <?php echo $selected; ?>  >
                                                        <?php echo $ListadoPaises[$i]['NOMBRE']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Sexo:</label>
                                            <br />
                                            <label class="radio-inline">
                                                <input type="radio" name="Sexo" id="SexoF" 
                                                value="F" 
                                                <?php echo (!empty($_POST['Sexo']) && $_POST['Sexo'] == 'F') ? 'checked':''; ?>  >Femenino
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="Sexo" id="SexoM" 
                                                value="M" 
                                                <?php echo (!empty($_POST['Sexo']) && $_POST['Sexo'] == 'M') ? 'checked':''; ?>>Masculino
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="Sexo" id="SexoO" 
                                                value="O"
                                                <?php echo (!empty($_POST['Sexo']) && $_POST['Sexo'] == 'O') ? 'checked':''; ?>>Otro
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Condiciones del sitio:</label>
                                            <br />
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="Condiciones"  
                                                    value="SI"
                                                    <?php echo (!empty($_POST['Condiciones']) && $_POST['Condiciones'] == 'SI') ? 'checked':''; ?>
                                                    >Acepto los Términos y Condiciones.
                                                </label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-default" value="Registrar" name="BotonRegistrar" >Registrarme</button>
                                       
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

        <?php require_once 'footer.inc.php'; ?>