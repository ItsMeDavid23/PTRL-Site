<?php include("session.php"); ?>
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
    <style>
        .card-img-top {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .card-footer {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #000;
            text-decoration: none;
            padding: 8px 16px;
            transition: background-color 0.3s;
        }

        .pagination a.active {
            background-color: #007bff;
            color: #fff;
        }

        .pagination a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body style="background-color: #e4e9f7;">
    <?php include("navbarback.php"); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"></span>
        </div>
        <div class="mx-auto w-50">
    <h2 style="text-align:center;">Listagem de Notícias</h2>
    <?php 
    // Definir o número de notícias por página
    $noticiasPorPagina = 2;

    // Obter a página atual da URL
    $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular o offset para a consulta
    $offset = ($paginaAtual - 1) * $noticiasPorPagina;

    // Consulta as notícias do banco de dados com limite e offset
    $sql = "SELECT * FROM noticias ORDER BY id_noticia DESC LIMIT $noticiasPorPagina OFFSET $offset";
    $result = $db->query($sql);

    // Verifica se há notícias encontradas
    if ($result->num_rows > 0) {
        // Loop para exibir cada notícia
        while ($row = $result->fetch_assoc()) {
            $titulo = $row['titulo'];
            $descricao = $row['descricao'];
            $caminhoImagem = $row['caminho_imagem'];
            $noticiaId = $row['id_noticia'];

            // Verificar se a descrição excede 210 caracteres
            if (strlen($descricao) > 210) {
                $descricao = substr($descricao, 0, 210) . '...';
            }

            // HTML do cartão de notícia
            echo '<div class="card mt-4">';
            echo '<img src="'.$caminhoImagem.'" class="card-img-top w-100" alt="Imagem de Capa" style="max-width: 300px; height: auto;">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">'.$titulo.'</h5>';
            echo '<p class="card-text">'.$descricao.'</p>';
            echo '</div>';
            echo '<div class="card-footer">';
            echo '<a href="EditarNoticia.php?id='.$noticiaId.'" class="btn btn-primary">Editar</a>';
            echo '<a href="DeleteNoticia.php?id='.$noticiaId.'" class="btn btn-danger ml-2">Excluir</a>';
            echo '</div>';
            echo '</div>';
        }
        
        // Calcular o número total de páginas
        $sqlCount = "SELECT COUNT(*) AS total FROM noticias";
        $resultCount = $db->query($sqlCount);
        $row = $resultCount->fetch_assoc();
        $totalNoticias = $row['total'];
        $totalPaginas = ceil($totalNoticias / $noticiasPorPagina);

        // Exibir a paginação
        echo '<div class="pagination">';
        if ($paginaAtual > 1) {
            echo '<a href="VerNoticias.php?pagina='.($paginaAtual - 1).'"><i class="fas fa-chevron-left"></i></a>';
        }
        for ($i = 1; $i <= $totalPaginas; $i++) {
            echo '<a href="VerNoticias.php?pagina='.$i.'"'.($i == $paginaAtual ? ' class="active"' : '').'>'.$i.'</a>';
        }
        if ($paginaAtual < $totalPaginas) {
            echo '<a href="VerNoticias.php?pagina='.($paginaAtual + 1).'"><i class="fas fa-chevron-right"></i></a>';
        }
        echo '</div>';
    } else {
        echo 'Nenhuma notícia encontrada.';
    }

    // Fecha a conexão
    $db->close();
    ?>
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
</body>
</html>
