<?php
include("session.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar o nome da foto antes de excluir a notícia
    $query = "SELECT caminho_imagem FROM noticias WHERE id_noticia = $id";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $caminhoImagem = $row['caminho_imagem'];

    // Excluir a notícia do banco de dados
    $deleteQuery = "DELETE FROM noticias WHERE id_noticia = $id";
    mysqli_query($db, $deleteQuery);

    // Excluir a foto da pasta
    if ($caminhoImagem && file_exists($caminhoImagem)) {
        unlink($caminhoImagem);
    }
}

header('Location: VerNoticias.php');
?>
