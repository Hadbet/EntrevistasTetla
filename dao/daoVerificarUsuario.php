<?php

include_once('db/db_Empleado.php');

$Nomina=$_GET['nomina'];

Contador($Nomina);

function Contador($Nomina){
    $con = new LocalConector();
    $conex=$con->conectar();
    $datos = mysqli_query($conex, "SELECT `NomUser`,`IdTag`,`NombreWC` FROM `Empleados` WHERE `IdUser` = '$Nomina';");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data"=>$resultado));
}


?>