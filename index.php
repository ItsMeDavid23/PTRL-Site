<?php include('session.php'); ?>
<html>
<head>
   <style>
    .zoom-image {
        position: relative;
        overflow: hidden;
    }

    .zoom-image img {
        transition: transform 0.3s ease;
    }

    .zoom-image:hover img {
        transform: scale(1.1);
    }
</style>
   <style>
      @media screen and (max-width: 700px) {
         #imginthefooter img:first-child {
            margin-top: 1em;
         }
      }

      @font-face {
         font-family: "Teko";
         src: url("./fonts/Teko/Teko-Regular.ttf"), url("./fonts/Teko/Teko-Bold.ttf");
      }

      * {
         font-family: 'Teko', Arial, Helvetica, sans-serif;
         color: white;
         text-transform: uppercase;
      }

      h1 {
         letter-spacing: 2px;
         font-size: 78px;
      }

      h1,
      .sub-title {
         color: white;
         text-transform: uppercase;
      }

      .sub-title {
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: row;
         height: fit-content;
      }
   </style>
   <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
   <link rel="stylesheet" href="CSS/csssite.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>PTRL</title>
   <style> 
    
      .news-container {
         display: flex;
         flex-wrap: wrap;
         margin-bottom: 50px;
      }

      .news-item {
         display: flex;
         width: 100%;
         margin-right: 20px;
      }

      .news-image {
         width: 100%;
      }

      .news-content {
         max-width: 50%;
      }

      .news-title {
         font-size: 24px;
         font-weight: bold;
      }

      .news-description {
         max-width: 100%;
         word-wrap: break-word;
      }

      @media screen and (max-width: 700px) {
         .news-item {
            flex-direction: column;
         }
      }

      #noticias {
         scroll-behavior: smooth;
      }

      /* Estilos para o botão */

      #buttonContainer {
      display: flex;
      justify-content: center;
      align-items: center;
      /* Defina a altura desejada para o contêiner */
      }

      .scroll-button {
         position: fixed;
         bottom: 30px;
         left: 50%;
         transform: translateX(-50%);
         background-color: #ffcc00;
         color: black;
         border: none;
         padding: 15px 30px;
         font-size: 18px;
         font-weight: bold;
         text-transform: uppercase;
         cursor: pointer;
         transition: opacity 0.3s;
         border-radius: 4px; /* Adicionando bordas arredondadas */
         margin: 0 auto; /* Centraliza horizontalmente o botão */
      }

      .scroll-button:hover {
         opacity: 0.8;
      }

      .scroll-button.hide {
         display: none;
      }
      .hide {
         display: none;
      }

      #verMaisButton {
         background-color: #ffcc00;
         border: none;
         color: white;
         padding: 15px 30px;
         color:black;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 18px;
         font-weight: bold;
         text-transform: uppercase;
         margin-bottom:10px;
         cursor: pointer;
         transition-duration: 0.4s;
         border-radius: 4px; /* Adicionando bordas arredondadas */
      }

      #verMaisButton:hover {
         opacity: 0.8;
      }

      p {
      text-transform: none;
      font-size: 25px!important;
      }

   </style>
</head>
<body style="background-color: #1e191f;">
   <div class="imagemfundo">
      <?php include("navbarfront.php"); ?>
      <div style="padding: 6svw 6svw 2svw 6svw;">
         <h1>Estas pronto para te<br>por à prova ?</h1><br>
         <p> <?php echo ("Olá $Username , voce tem permissoes de $CargoUser "); ?></p>
      </div>
   </div>
   <div id="noticias" data-page="2" style=" padding-left: 3%; padding-right: 3%;">
      
<?php
         // Defina o número máximo de notícias a serem carregadas a cada clique
         $noticiasPorPagina = 2;

         // Verifique a página atual para calcular o ponto de partida
         $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
         $pontoPartida = ($paginaAtual - 1) * $noticiasPorPagina;

         // Consulta para buscar as notícias limitadas por página
         $query = "SELECT * FROM noticias ORDER BY id_noticia DESC LIMIT $pontoPartida, $noticiasPorPagina";
         $result = mysqli_query($db, $query);
         $result = $db->query($query);
         $alternador = 0;
         // Verificar se existem notícias para exibir
         if ($result->num_rows > 0) {
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
            echo "Nenhuma notícia encontrada.";
         }

         // Fechar a conexão com o banco de dados
         $db->close();
      ?>
   </div> 
   <button id="scrollButton" class="scroll-button">Ver Notícias</button>
   <div id="buttonContainer">
      <button id="verMaisButton">Ver mais</button>
   </div>

   <?php include("footer.php"); ?>
   <?php include("script_nav.php"); ?>
   <script>
      document.getElementById("verMaisButton").addEventListener("click", function() {
         var page = document.getElementById("noticias").getAttribute("data-page");
         
         var xhr = new XMLHttpRequest();
         xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
               var response = xhr.responseText;
               var noticiasContainer = document.getElementById("noticias");
               noticiasContainer.innerHTML += response;
               noticiasContainer.setAttribute("data-page", parseInt(page) + 1);

               // Rolar o scroll por 850 pixels suavemente
               var currentScroll = window.pageYOffset;
               var targetScroll = currentScroll + 870;
               var scrollOptions = {
                  top: targetScroll,
                  behavior: 'smooth'
               };
               window.scrollTo(scrollOptions);
            }
         };
         
         xhr.open("GET", "get_noticias.php?pagina=" + page, true);
         xhr.send();
      });
   </script>
   <script>
      // Função para rolar suavemente até a seção das notícias
      function scrollToNews() {
         const newsSection = document.getElementById('noticias');
         if (newsSection) {
            newsSection.scrollIntoView({ behavior: 'smooth' });
         }
      }

      // Função para verificar a posição da página e ocultar o botão de scroll
      function checkScrollPosition() {
         const scrollButton = document.getElementById('scrollButton');
         if (scrollButton) {
            if (window.scrollY > 90) {
               scrollButton.style.display = 'none';
            } else {
               scrollButton.style.display = 'block';
            }
         }
      }

      // Adicionar evento de clique ao botão de rolagem
      const scrollButton = document.getElementById('scrollButton');
      if (scrollButton) {
         scrollButton.addEventListener('click', function() {
            scrollToNews();
            scrollButton.style.display = 'none';
         });

         // Verificar a posição da página ao carregar e ao rolar
         window.addEventListener('load', checkScrollPosition);
         window.addEventListener('scroll', checkScrollPosition);
      }
   </script>
</body>
</html>
