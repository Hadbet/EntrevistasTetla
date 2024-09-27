<?php

include_once('db/db_RH.php');

Contador();

function Contador()
{
    $con = new LocalConector();
    $conex = $con->conectar();

    $datos = mysqli_query($conex, "SELECT `IdNomina`,`Nombre`,`APU`,`Puesto`,`Rol`,`Password`,CONCAT('<button class=\"primary\" onclick=\"llenarParametrosUsu(','\'',`IdNomina`,'\',\'',`Nombre`,'\',\'',`APU`,'\',\'',`Puesto`,'\',\'',`Rol`,'\',\'',`Password`,'\');\" style=\"background-color: #547fea\">Editar-Eliminar</button>') as boton FROM `UsuariosEntrevistas`");

    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data" => $resultado));
}


?>