<?php
include("session.php"); // Arquivo de configuração com a conexão ao banco de dados

$idNoticia = $_GET['id_noticia'];

// Remove o like da tabela noticias_likes
$queryDelete = "DELETE FROM noticias_likes WHERE id_user = $IdUser AND id_noticia = $idNoticia";
mysqli_query($db, $queryDelete);

// Retorna o número atualizado de likes
$queryLikes = "SELECT COUNT(*) AS totalLikes FROM noticias_likes WHERE id_noticia = $idNoticia";
$resultLikes = mysqli_query($db, $queryLikes);
$rowLikes = mysqli_fetch_assoc($resultLikes);
$totalLikes = $rowLikes['totalLikes'];

echo $totalLikes;
?>
