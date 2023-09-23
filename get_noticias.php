<?php
include('config.php');

// Defina o número máximo de notícias a serem carregadas a cada clique
$noticiasPorPagina = 2;

// Obtém o número da página da solicitação GET
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$pontoPartida = ($paginaAtual - 1) * $noticiasPorPagina;

// Consulta para buscar as notícias limitadas por página
$query = "SELECT * FROM noticias ORDER BY id_noticia DESC LIMIT $pontoPartida, $noticiasPorPagina";
$result = mysqli_query($db, $query);

// Verificar se existem notícias para exibir
if ($result->num_rows > 0) {
   $alternador = 0;
   while ($row = $result->fetch_assoc()) {
      // Exibir as informações da notícia
      $idNoticia = $row['id_noticia'];
      $titulo = $row['titulo'];
      $descricao = $row['descricao'];
      $caminhoImagem = $row['caminho_imagem'];
      $dataNoticia = $row['DataNoticia'];
      $dataNoticia = date('d/m/Y', strtotime($dataNoticia));


      // Verificar o tamanho do corpo da notícia
      $showMoreButton = false;
      if (strlen($descricao) > 399) {
         $showMoreButton = true;
         $descricao = substr($descricao, 0, 399) . '... ';
      }

      if ($alternador == 0) {
         echo '<div class="noticia noticia-alternada" style="display:grid; grid-template-columns:35% 65%;grid-gap: 20px; margin-top:120px;">';
         echo '<div>';
         echo'<div class="zoom-image">';
         echo "<img src='$caminhoImagem' class='news-image' alt='$titulo' style='margin-right:auto;display:block;' >";
         echo'</div>';
         echo"<p class='news-description' style='font-size:16px;text-align:center;'>Noticia lançada dia " . $dataNoticia . "</p>";
         echo '</div>';
         echo '<div>';
         echo "<h1 class='news-title' style='font-size:40px;margin-bottom:20px;color:khaki;text-align:center;' >$titulo</h1>";
         echo "<p class='news-description'>". nl2br($descricao);
         if ($showMoreButton) {
            echo '<a href="pagina_noticia.php?id_noticia=' . $idNoticia . '" style="font-size: 27px;color:aquamarine;">Ver mais</a>'; // Substitua "pagina_noticia.php?id_noticia=' . $idNoticia . '" pelo link correto
         }
         echo"</p>";
         echo '</div>';
         echo '</div>';
         $alternador = 1;
      } else {
         echo '<div class="noticia noticia-alternada" style="display:grid; grid-template-columns: 65% 35% ;grid-gap: 20px; margin-top:120px;">';
         echo '<div>';
         echo "<h1 class='news-title' style='font-size:40px;margin-bottom:20px;color:khaki;text-align:center;' >$titulo</h1>";
         echo "<p class='news-description'>". nl2br($descricao);
         if ($showMoreButton) {
            echo '<a href="pagina_noticia.php?id_noticia=' . $idNoticia . '" style="font-size: 27px;color:aquamarine;">Ver mais</a>'; // Substitua "pagina_noticia.php?id_noticia=' . $idNoticia . '" pelo link correto
         }
         echo"</p>";
         echo '</div>';
         echo '<div>';
         echo'<div class="zoom-image">';
         echo "<img src='$caminhoImagem' class='news-image' alt='$titulo' style='margin-left:auto;display:block;'>";
         echo'</div>';
         echo"<p class='news-description' style='font-size:16px;text-align:center;'>Noticia lançada dia " . $dataNoticia . "</p>";
         echo '</div>';
         echo '</div>';
         $alternador = 0;
      }
   }
} else {
   echo '';
}
?>
