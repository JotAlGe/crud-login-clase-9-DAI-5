<?php 
function InsertarUsuarios($vConexion){
    
    $SQL_Insert="INSERT INTO Usuarios (Nombre, Apellido, Email, Clave, IdNivel, IdPais, FechaCreacion, Sexo, Activo)
    VALUES ('".$_POST['Nombre']."' , '".$_POST['Apellido']."' , '".$_POST['Email']."', '".$_POST['Clave']."' , 2, ".$_POST['Pais']." , NOW(), '".$_POST['Sexo']."' , 0)";


    if (!mysqli_query($vConexion, $SQL_Insert)) {
        //si surge un error, finalizo la ejecucion del script con un mensaje
        die('<h4>Error al intentar insertar el registro.</h4>');
    }

    return true;
}
?>