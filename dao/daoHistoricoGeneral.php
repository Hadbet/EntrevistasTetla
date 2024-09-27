<?php

include_once('db/db_RH.php');

Contador();

function Contador(){
    $con = new LocalConector();
    $conex=$con->conectar();
    $datos = mysqli_query($conex, "SELECT * FROM `EntrevistasAusentismo`");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data"=>$resultado));
}


?>