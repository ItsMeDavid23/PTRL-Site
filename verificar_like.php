<?php
include("session.php");

$idNoticia = $_GET['id_noticia'];


// Verifica se o usuário já deu like
$hasLiked = verificarSeUsuarioJaDeuLike($IdUser, $idNoticia); // Implemente essa função para verificar no banco de dados

// Retorna a resposta como JSON
$response = array(
  'hasLiked' => $hasLiked
);
echo json_encode($response);
?>
