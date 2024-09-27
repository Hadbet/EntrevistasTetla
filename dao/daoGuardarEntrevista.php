<?php
include_once('db/db_RH.php');

$Nomina=$_POST['nomina'];
$Area=$_POST['area'];
$FechaAusencia=$_POST['fechaAusencia'];
$TipoAusentismo=$_POST['tipoAusentismo'];
$Encargado=$_POST['encargado'];
$Motivo=$_POST['motivo'];
$NominaEntrevistador=$_POST['nominaEntrevistador'];
$ShiftLeader=$_POST['shiftLeader'];
$Supervisor=$_POST['supervisor'];
$Tag=$_POST['tag'];

registroUsu($Nomina,$Area,$FechaAusencia,$TipoAusentismo,$Encargado,$Motivo,$NominaEntrevistador,$ShiftLeader,$Supervisor,$Tag);
function registroUsu($Nomina,$Area,$FechaAusencia,$TipoAusentismo,$Encargado,$Motivo,$NominaEntrevistador,$ShiftLeader,$Supervisor,$Tag){

    $con = new LocalConector();
    $conex=$con->conectar();

    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Denver'));
    $DateAndTime = $Object->format("Y/m/d h:i:s");

    $insertRegistro= "INSERT INTO `EntrevistasAusentismo`(`NominaEntrevistador`, `NominaEntrevistado`, `FechaRegistro`, `FechaAusentismo`, `TipoAusencia`, `Motivo`, `Area`, `Encargado`,`ShiftLeader`,`Supervisor`,`Tag`) VALUES ('$NominaEntrevistador','$Nomina','$DateAndTime','$FechaAusencia','$TipoAusentismo','$Motivo','$Area','$Encargado','$ShiftLeader','$Supervisor','$Tag')";

    $rsinsertUsu=mysqli_query($conex,$insertRegistro);
    mysqli_close($conex);

    if(!$rsinsertUsu){
        echo "0";
    }else{
        return 1;
    }
}

?>