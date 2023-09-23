<?php
include("session.php");

// Verifique se o formulário foi enviado
if (isset($_POST['coluna1'])) {
    
    $NomeOrganizacao = $_POST['coluna1'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $imagem = $_FILES["imagem"];
        $nome = $imagem["name"];
        $caminho_temporario = $imagem["tmp_name"];
        $caminho_destino = "imagens/organizacoes/" . $nome;
    
        if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
        } else {
            echo "Erro ao enviar a imagem.";
        }
    }

    // Insere a nova temporada
    $query = "INSERT INTO `organizacao` (`nome_organizacao`,`caminho_imagem`) VALUES ('$NomeOrganizacao','$caminho_destino');";
    mysqli_query($db, $query);
   
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
            <h1 style="text-align: center;">Criar organizacao</h1>
            <form action="InserirOrganizacao.php" method="post" enctype="multipart/form-data">
                <div style="margin-top: 20px;" class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Nome</label>
                       <input type="text" class="form-control" name="coluna1" required>
                </div>
                <img id="previewImagem" src="#" alt="Preview da imagem" style="max-width: 300px;margin-bottom:10px; display: none;">
                <input type="file" name="imagem" accept="image/*" onchange="exibirPreviewImagem(this)">
                <div style="text-align: center; margin-top: 10px;">
                    <button id="btn-salvar" type="submit" class="btn btn-primary">Criar</button>
                </div>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        function exibirPreviewImagem(input) {
            var preview = document.getElementById('previewImagem');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>

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
<?php
// Feche a conexão com o banco de dados
mysqli_close($db);
?>