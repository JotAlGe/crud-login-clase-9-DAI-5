<?php
function insertarNivel($con)
{
    $sql = "INSERT INTO `niveles`(`denominacion`) VALUES ('" . $_POST['Nombre'] . "')";
    if (!mysqli_query($con, $sql)) {
        die('<h4>No se ha podido insertar el registro</h4>');
    }

    return true;
}
