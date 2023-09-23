<?php
include("session.php");

if (isset($_POST['Username'])) {

    $Username = mysqli_real_escape_string($db, $_POST['Username']);
    
    $query = "UPDATE users SET `CargoUser` = 'User' WHERE `users`.`Username` = '$Username';";
    mysqli_query($db, $query);

    $query = "UPDATE piloto SET `estado_piloto` = '0' WHERE `piloto`.`nome` = '$Username';";
    mysqli_query($db, $query);

    $query = "SELECT id_piloto FROM piloto WHERE nome = '$Username';";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $idPiloto = $row['id_piloto'];

    $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $idTemporada = $row['id_temporada'];

    $query = "UPDATE `pilotopontostemporada` SET `id_equipa` = '22' , id_divisao = '5' , pontos = '0' WHERE `pilotopontostemporada`.`id_piloto` ='$idPiloto' AND `pilotopontostemporada`.`id_temporada` = '$idTemporada';";
    mysqli_query($db, $query);

}
header('Location: VerPilotos.php');
