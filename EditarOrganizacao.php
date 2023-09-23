<?php
include("session.php");

// Verifique se o formulário foi enviado
if (isset($_POST['coluna1']) && isset($_POST['coluna2'])) {
    $coluna1 = $_POST['coluna1'];
    $coluna2 = $_POST['coluna2'];

    // Atualize os dados da linha
    $query = "UPDATE organizacao SET nome_organizacao = '$coluna2' WHERE id_organizacao = $coluna1";
    mysqli_query($db, $query);

    // Verifique se uma nova imagem foi enviada
    if ($_FILES['imagem']['name']) {
        $imagem = $_FILES["imagem"];
        $nome = $imagem["name"];
        $caminho_temporario = $imagem["tmp_name"];
        $caminho_destino = "imagens/organizacoes/" . $nome;

        if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
            // Adicione a extensão desejada ao caminho da imagem
            $extensao = pathinfo($nome, PATHINFO_EXTENSION);
            $novo_nome = $nome . "." . $extensao;
            $caminho_destino_final = "imagens/organizacoes/" . $novo_nome;

            // Atualize o caminho da imagem no banco de dados
            $query = "UPDATE organizacao SET caminho_imagem = '$caminho_destino_final' WHERE id_organizacao = $coluna1";
            mysqli_query($db, $query);
        } else {
            echo "Erro ao enviar a imagem.";
        }
    }

    // Volte para a página da tabela
    header('Location: VerOrganizacoes.php');
}

// Verifique se o ID da linha foi enviado
if (isset($_POST['id_organizacao'])) {
    $id = mysqli_real_escape_string($db, $_POST['id_organizacao']);

    // Selecione os dados da linha
    $query = "SELECT * FROM organizacao WHERE id_organizacao = $id";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);

    $nome = $row['nome_organizacao'];
    $imagem = $row['caminho_imagem'];
}
?>

<html lang="en" dir="ltr">

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
            <h1 style="text-align: center;">Alterar dados</h1>
            <form action="EditarOrganizacao.php" method="post" enctype="multipart/form-data">
                <div style="margin-top: 20px;" class="input-group">
                    <span class="input-group-text">ID Organização</span>
                    <input type="text" class="form-control" name="coluna1" value="<?php echo $id ?>" readonly>
                </div>
                <div style="margin-top: 20px;" class="input-group">
                    <span class="input-group-text">Nome Organização</span>
                    <input type="text" class="form-control" name="coluna2" value="<?php echo $nome ?>" required>
                </div>
                <div style="margin-top: 20px;" class="input-group">
                    <span class="input-group-text">Imagem</span>
                </div>
                <img id="previewImagem" src=<?php echo $imagem; ?> alt="Preview da imagem" style="max-width: 200px; display: <?php echo $imagem ? 'block' : 'none'; ?>">
                <input type="file" name="imagem" accept="image/*" onchange="exibirPreviewImagem(event)">

                <div style="text-align: center; margin-top: 10px;">
                    <button id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        function exibirPreviewImagem(event) {
            var input = event.target;
            var preview = document.getElementById('previewImagem');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
</body>

</html>

<?php
mysqli_close($db);
?>