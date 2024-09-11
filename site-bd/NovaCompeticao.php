<?php
include("session.php");

// Verifique se o formulário foi enviado
if (isset($_POST['coluna1'])) {
    
    $NomeCampeonato = $_POST['coluna1'];

    // Seleciona todas as corridas a serem canceladas antes de criar uma nova divisao
    $row = $db->query("SELECT id_corrida FROM corrida WHERE estado_corrida = 'revisao'");
    $result = $row->fetch_all();
    $count = $row->num_rows;

    // Atualiza o estado das corridas selecionadas para "cancelada"
    if ($count > 0) {
        foreach ($result as $row) {
            $idCorrida = $row[0];
            $db->query("UPDATE corrida SET estado_corrida = 'cancelada' WHERE id_corrida = $idCorrida");
        }
    }

    // Insere a nova temporada
    $query = "INSERT INTO `temporada` (`nome_temporada`) VALUES ('$NomeCampeonato');";
    mysqli_query($db, $query);
    
	// Obter o ID da temporada com o maior valor
	$query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
	$result = $db->query($query);

    //Se encontrar ...
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idTemporada = $row['id_temporada'];
    
        // vai buscar os ids de todos os pilotos ativos
        $query = "SELECT id_piloto FROM piloto WHERE estado_piloto = 1;";
        $result = mysqli_query($db, $query);

        // Verifica se a consulta retornou resultados
        if ($result) {
            // Loop pelos resultados da primeira consulta
            while ($row = mysqli_fetch_assoc($result)) {

                $idPiloto = $row['id_piloto'];
                
                // Insere todos os pilotos na nova temporada
                $query = "INSERT INTO `pilotopontostemporada` (`id_piloto`, `id_temporada`, `pontos`, `id_equipa`, `id_organizacao`, `id_divisao`) VALUES ('$idPiloto', '$idTemporada', '0', '22', '8', '5');";
                mysqli_query($db, $query);
            }
            // Se tudo correr bem 
            header('Location: admin.php');

        } else {
            echo "Nenhum piloto para inserir na nova temporada";
        }
    } else {
        echo "Nenhuma temporada encontrada.";
    }
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
            <h1 style="text-align: center;">Criar Competição</h1>
            <form action="NovaCompeticao.php" method="post">

                <div style="margin-top: 20px;" class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Nome</label>
                       <input type="text" class="form-control" name="coluna1" required>
                </div>

                <div style="text-align: center; margin-top: 10px;">
                    <button id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>
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
</body>
</html>
<?php
// Feche a conexão com o banco de dados
mysqli_close($db);
?>