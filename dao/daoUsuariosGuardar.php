<?php
include_once('db/db_RH.php');

$Nomina=$_POST['nomina'];
$Nombre=$_POST['nombre'];
$APU=$_POST['apu'];
$Puesto=$_POST['Puesto'];
$Password=$_POST['Password'];
$Rol=$_POST['Rol'];

actualizarVacas($Nomina,$Nombre,$APU,$Puesto,$Password,$Rol);

function actualizarVacas($Nomina,$Nombre,$APU,$Puesto,$Password,$Rol) {
    $con = new LocalConector();
    $conex = $con->conectar();

    $consulta = "SELECT * FROM `UsuariosEntrevistas` WHERE `IdNomina` = '$Nomina'";
    $resultado = mysqli_query($conex, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $updateQuery = "UPDATE `UsuariosEntrevistas` SET `Nombre`='$Nombre',`APU`='$APU',`Puesto`='$Puesto',`Rol`='$Rol',`Password`='$Password' WHERE `IdNomina` = '$Nomina'";
        $result = mysqli_query($conex, $updateQuery);
        echo 2;
    } else {
        $insertQuery = "INSERT INTO `UsuariosEntrevistas`(`Nombre`, `APU`, `Puesto`, `Rol`, `Password`,`IdNomina`) VALUES ('$Nombre','$APU','$Puesto','$Rol','$Password','$Nomina')";
        $result = mysqli_query($conex, $insertQuery);
        echo 1;
    }

    mysqli_close($conex);

    return $result;
}

?>