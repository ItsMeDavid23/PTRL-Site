<!DOCTYPE html>
<?php include("session.php");

  // Verifica se o formulário foi submetido
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {

    $noticiaId = $_GET['id'];
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    // Verifica se uma nova imagem foi enviada
    if ($_FILES['imagem']['tmp_name']) {  
      $imagem = $_FILES['imagem']['name'];
      $imagem_tmp = $_FILES['imagem']['tmp_name'];

      // Move a nova imagem para a pasta de destino
      $caminhoImagem = 'imagens/noticias/'.$imagem;
      move_uploaded_file($imagem_tmp, $caminhoImagem);

      // Atualiza a notícia no banco de dados com a nova imagem
      $sql = "UPDATE noticias SET titulo='$titulo', descricao='$descricao', caminho_imagem='$caminhoImagem', DataNoticia = CURRENT_TIMESTAMP WHERE id_noticia='$noticiaId'";
    } else {
      // Atualiza a notícia no banco de dados sem a imagem
      $sql = "UPDATE noticias SET titulo='$titulo', descricao='$descricao', DataNoticia = CURRENT_TIMESTAMP  WHERE id_noticia='$noticiaId'";
    }

    // Executa a query de atualização
    if ($db->query($sql) === TRUE) {
      // Redireciona de volta para a página de visualização de notícias
      header('Location: VerNoticias.php');
      exit();
    } else {
      echo "Erro ao atualizar notícia: " . $db->error;
    }
  }
?>
<html>
<head>
    <title>Editar Notícia</title>
    <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background-color: #e4e9f7;">
<?php include("navbarback.php"); ?>
  <div class="container mt-5">
    <h2>Editar Notícia</h2>
<?php
    // Verifica se foi fornecido um ID de notícia válido
    if (isset($_GET['id'])) {
      $noticiaId = $_GET['id'];

      // Consulta a notícia do banco de dados pelo ID
      $sql = "SELECT * FROM noticias WHERE id_noticia = '$noticiaId'";
      $result = $db->query($sql);

      // Verifica se a notícia foi encontrada
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $titulo = $row['titulo'];
        $descricao = $row['descricao'];
        $caminhoImagem = $row['caminho_imagem'];

        // Exibe o formulário de edição preenchido com os dados da notícia
        echo '<form action="" method="POST" enctype="multipart/form-data">';
        echo '<div class="form-group">';
        echo '<label for="titulo">Título:</label>';
        echo '<input type="text" class="form-control" id="titulo" name="titulo" value="'.$titulo.'" maxlength="100">';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="descricao">Descrição:</label>';
        echo '<textarea class="form-control" id="descricao" name="descricao" rows="4" maxlength="2000">'.$descricao.'</textarea>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="imagem">Imagem de Capa:</label>';
        echo '<input type="file" class="form-control-file" id="imagem" name="imagem">';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary">Salvar</button>';
        echo '</form>';
      } else {
        echo 'Nenhuma notícia encontrada com o ID fornecido.';
      }
    } else {
      echo 'ID de notícia inválido.';
    }

    // Fecha a conexão
    $db->close();
    ?>
  </div>
</body>
</html>
