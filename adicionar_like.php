<?php
include("session.php"); // Arquivo de configuração com a conexão ao banco de dados

$idNoticia = $_GET['id_noticia'];

// Verifica se o usuário já deu like nesta notícia
$query = "SELECT * FROM noticias_likes WHERE id_user = $IdUser AND id_noticia = $idNoticia";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) == 0) {
    // Insere o like na tabela noticias_likes
    $queryInsert = "INSERT INTO noticias_likes (id_user, id_noticia) VALUES ($IdUser, $idNoticia)";
    mysqli_query($db, $queryInsert);
}

// Retorna o número atualizado de likes
$queryLikes = "SELECT COUNT(*) AS totalLikes FROM noticias_likes WHERE id_noticia = $idNoticia";
$resultLikes = mysqli_query($db, $queryLikes);
$rowLikes = mysqli_fetch_assoc($resultLikes);
$totalLikes = $rowLikes['totalLikes'];

echo $totalLikes;
?>
