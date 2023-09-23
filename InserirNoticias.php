<?php
include('session.php');
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtém os dados do formulário
  $titulo = $_POST['titulo'];
  $descricao = $_POST['descricao'];

  // Diretório de upload para as imagens
  $uploadDir = 'imagens\noticias/'; // Defina o caminho correto para o diretório

  // Verifica se um arquivo de imagem foi enviado
  if (isset($_FILES['imagem'])) {
    $imagemTemp = $_FILES['imagem']['tmp_name'];
    $imagemNome = $_FILES['imagem']['name'];

    // Gera um nome único para a imagem
    $imagemNomeUnico = uniqid() . '_' . $imagemNome;

    // Move a imagem para o diretório de upload
    $caminhoImagem = $uploadDir . $imagemNomeUnico;
    move_uploaded_file($imagemTemp, $caminhoImagem);

    // Prepara a query de inserção
    $stmt = $db->prepare("INSERT INTO noticias (titulo, descricao, caminho_imagem) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $descricao, $caminhoImagem);

    // Executa a query
    $stmt->execute();

    // Verifica se a inserção foi bem-sucedida
    if ($stmt->affected_rows > 0) {
    } else {
      echo "Ocorreu um erro ao inserir a notícia.";
    }

    // Fecha a declaração e a conexão
    $stmt->close();
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php include("navbarback.php"); ?>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <span class="text"></span>
    </div>
    <div class="mx-auto w-50">
      <h1 style="text-align: center;margin-bottom:10px;">Inserir Noticia</h1>
      <form action="InserirNoticias.php" method="POST" enctype="multipart/form-data">
        <div class="form-group" style="margin-bottom:10px;">
          <label for="titulo">Título:</label>
          <input type="text" class="form-control" name="titulo" maxlength="100" required>
          <small class="form-text text-muted">Máximo de 100 caracteres.</small>
        </div>
        <div class="form-group" style="margin-bottom:10px;">
          <label for="descricao">Descrição:</label>
          <textarea class="form-control" name="descricao" maxlength="2000" required></textarea>
          <small class="form-text text-muted">Máximo de 2000 caracteres.</small>
        </div>
        <div class="form-group" style="margin-bottom:10px;">
          <label for="imagem">Imagem de Capa:</label>
          <input type="file" class="form-control-file" name="imagem" id="imagemInput" required>
        </div>
        <!-- Adicione o elemento <img> abaixo -->
        <div class="form-group" style="margin-bottom:10px;">
          <label for="imagem-preview">Pré-visualização:</label>
          <img id="imagemPreview" src="#" alt="Pré-visualização da imagem" style="max-width: 200px; display: none;">
        </div>
        <div style="text-align:center;">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </form>

    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script>
    var arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
      arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
      });
    }
    var sidebar = document.querySelector(".sidebar");
    var sidebarBtn = document.querySelector(".bx-menu");
    sidebarBtn.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });
  </script>
  <script>
    // Obtém referências aos elementos HTML
    const imagemInput = document.getElementById('imagemInput');
    const imagemPreview = document.getElementById('imagemPreview');

    // Adiciona um ouvinte de evento para o evento 'change' do input de arquivo
    imagemInput.addEventListener('change', function() {
      // Verifica se um arquivo de imagem foi selecionado
      if (imagemInput.files && imagemInput.files[0]) {
        // Cria um objeto URL para a imagem selecionada
        const reader = new FileReader();
        reader.onload = function(e) {
          // Define a imagem de pré-visualização com a URL da imagem selecionada
          imagemPreview.src = e.target.result;
          imagemPreview.style.display = 'block'; // Exibe a pré-visualização da imagem
        }
        reader.readAsDataURL(imagemInput.files[0]); // Lê o arquivo de imagem como uma URL
      } else {
        // Caso nenhum arquivo seja selecionado, limpa a pré-visualização
        imagemPreview.src = '#';
        imagemPreview.style.display = 'none'; // Oculta a pré-visualização da imagem
      }
    });
  </script>

</body>

</html>