<?php

include_once('db/db_RH.php');

Contador();

function Contador()
{
    $con = new LocalConector();
    $conex = $con->conectar();

    $datos = mysqli_query($conex, "SELECT `IdEncargado`,`APU`,`Supervisor`,`ShiftLeader`,CONCAT('<button class=\"primary\" onclick=\"llenarParametros(','\'',`IdEncargado`,'\',\'',`APU`,'\',\'',`Supervisor`,'\',\'',`ShiftLeader`,'\');\" style=\"background-color: #547fea\">Editar o Eliminar</button>') as boton FROM `Encargados` WHERE 1;");

    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data" => $resultado));
}


?>