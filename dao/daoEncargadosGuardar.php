<?php
include_once('db/db_RH.php');

$Id=$_POST['id'];
$APU=$_POST['apu'];
$Supervisor=$_POST['supervisor'];
$ShiftLeader=$_POST['shiftLeader'];

actualizarVacas($Id,$APU,$Supervisor,$ShiftLeader);

function actualizarVacas($Id,$APU,$Supervisor,$ShiftLeader) {
    $con = new LocalConector();
    $conex = $con->conectar();

    if ($Id != "n") {
        $updateQuery = "UPDATE `Encargados` SET `APU`='$APU',`Supervisor`='$Supervisor',`ShiftLeader`='$ShiftLeader' WHERE `IdEncargado` = '$Id'";
        $result = mysqli_query($conex, $updateQuery);
        echo 2;
    } else {
        $insertQuery = "INSERT INTO `Encargados`(`APU`, `Supervisor`, `ShiftLeader`) VALUES ('$APU','$Supervisor','$ShiftLeader')";
        $result = mysqli_query($conex, $insertQuery);
        echo 1;
    }

    mysqli_close($conex);

    return $result;
}

?>