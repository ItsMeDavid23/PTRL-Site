<?php
include('session.php');

// Receber os dados enviados via POST
$data = json_decode(file_get_contents('php://input'), true);

// Verificar se os dados foram recebidos corretamente
if ($data) {

  // Obtém a lista de id_piloto e id_divisao do array recebido
  $id_pilotos = array_column($data, 'id_piloto');
  $id_divisao = $data[0]['id_divisao'];

  // Verifica o comprimento do array
  $num_pilotos = count($id_pilotos);

  // Monta a query com base nos id_piloto e id_divisao
  $query = "UPDATE `pilotopontostemporada` SET `id_divisao` = $id_divisao WHERE ";
  for ($i = 0; $i < $num_pilotos; $i++) {
    $id_piloto = $id_pilotos[$i];
    $query .= "id_piloto = $id_piloto";
    if ($i < $num_pilotos - 1) {
      $query .= " OR ";
    }
  }

  // Executa a query no banco de dados
  mysqli_query($db, $query);

  // Retornar uma resposta, se necessário
  $response = ['success' => true, 'message' => 'Dados atualizados com sucesso'];
  echo json_encode($response);
} else {
  // Retornar uma resposta de erro, se necessário
  $response = ['success' => false, 'message' => 'Falha ao receber os dados'];
  echo json_encode($response);
}
?>
