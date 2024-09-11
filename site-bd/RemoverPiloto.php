<?php

include("session.php");

if (isset($_POST["id_piloto"])) {
    $idPiloto = $_POST["id_piloto"];

    $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $idTemporada = $row['id_temporada'];

    // Realizar a exclusão do piloto da tabela resultados
    $query = "UPDATE `pilotopontostemporada` SET `id_divisao` = '5' , id_equipa='22', pontos='0' WHERE id_piloto = $idPiloto AND id_temporada = '$idTemporada';";

    if (mysqli_query($db, $query)) {
        echo "Piloto removido com sucesso.";
    } else {
        echo "Ocorreu um erro ao remover o piloto: " . mysqli_error($db);
    }
}

?>
