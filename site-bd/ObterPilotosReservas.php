<?php
include("session.php");

$query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
$result = $db->query($query);
$row = $result->fetch_assoc();
$idTemporada = $row['id_temporada'];

$queryReservas = 'SELECT pt.id_piloto, p.nome FROM pilotopontostemporada pt JOIN piloto p ON pt.id_piloto = p.id_piloto WHERE pt.id_divisao = 5 AND p.estado_piloto = 1 AND id_temporada = '. $idTemporada .';';
$resultReservas = mysqli_query($db, $queryReservas);

$options = '';
while ($rowReservas = mysqli_fetch_assoc($resultReservas)) {
    $id_piloto_reserva = $rowReservas["id_piloto"];
    $nome_reserva = $rowReservas["nome"];
    $options .= '<option value="' . $id_piloto_reserva . '">' . $nome_reserva . '</option>';
}

echo $options;
?>
