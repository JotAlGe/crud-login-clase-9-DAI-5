<?php
function insertarPais($con)
{
    $sql = "INSERT INTO `paises`(`denominacion`) VALUES ('" . $_POST['Nombre'] . "')";

    $rs = mysqli_query($con, $sql);
    if (!$rs) {
        die('<h4>Error al intentar insertar el registro</h4>');
    }

    return true;
}
