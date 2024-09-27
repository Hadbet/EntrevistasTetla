<?php
include_once('db/db_RH.php');

$Id = $_POST['id'];

actualizarVacas($Id);

function actualizarVacas($Id)
{
    $con = new LocalConector();
    $conex = $con->conectar();
    $insertQuery = "DELETE FROM `UsuariosEntrevistas` WHERE `IdNomina` = '$Id'";
    $result = mysqli_query($conex, $insertQuery);
    echo 1;

    mysqli_close($conex);

    return $result;
}

?>