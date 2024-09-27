<?php

include_once('db/db_RH.php');
function obtenerRol($Nomina, $contra) {
    $con = new LocalConector();
    $conexion = $con->conectar();

    $consP = "SELECT `Rol` FROM `UsuariosEntrevistas` WHERE `IdNomina` = '$Nomina' and `Password` = '$contra'";
    $rsconsPro = mysqli_query($conexion, $consP);
    mysqli_close($conexion);

    if(mysqli_num_rows($rsconsPro) == 1){
        $usuario = mysqli_fetch_assoc($rsconsPro);
        return $usuario['Rol'];
    } else {
        return null;
    }
}

?>