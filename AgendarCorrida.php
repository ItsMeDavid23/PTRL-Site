<?php
include("session.php");

// Verifique se o formulário foi enviado
if (isset($_POST['IdDivisaoInput']) && isset($_POST['IdPistaInput']) && isset($_POST['DataCorridaInput']) ) {
    
    $IdTemporadaInput = $_POST['IdTemporadaInput'];
    $IdDivisaoInput = $_POST['IdDivisaoInput'];
    $IdPistaInput = $_POST['IdPistaInput'];
    $DataCorridaInput = $_POST['DataCorridaInput'];
    
    // Atualize os dados da linha
    $query = "INSERT INTO `corrida` (`id_corrida`, `id_temporada`, `id_divisao`, `id_pista`, `data_corrida`, `estado_corrida`) VALUES ( NULL, '$IdTemporadaInput', '$IdDivisaoInput', '$IdPistaInput', '$DataCorridaInput', 'agendada');";
    mysqli_query($db, $query);

    // Volte para a página da tabela
    header('Location: admin.php');
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
<body style="background-color: #e4e9f7;">
    <?php include("navbarback.php"); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"></span>
        </div>
        <div class="mx-auto w-50">
            <h1 style="text-align: center;">Agendar Corrida</h1>
            <form action="AgendarCorrida.php" method="post">

                <div style="margin-top: 20px;" class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Pista</label>
                        <select name="IdTemporadaInput" class="form-select" id="inputGroupSelect01">
<?php
                        $query = ("SELECT * FROM `temporada` ORDER BY `temporada`.`nome_temporada` DESC LIMIT 1");
                        $result = $db->query($query);

                        if ($result->num_rows > 0) {
                            // imprime todas as pistas
                            while ($row = $result->fetch_assoc()) {
                                echo ("<option value='$row[id_temporada]'> $row[nome_temporada] </option>");
                            }
                        }
?>
                        </select>
                </div>

                <div style="margin-top: 20px;" class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Liga</label>
                        <select name="IdDivisaoInput" class="form-select" id="inputGroupSelect01">
<?php
                        //Select de todas as corridas em "Revisão"
                        $query = ("SELECT * FROM `divisao` WHERE  id_divisao != 5");
                        $result = $db->query($query);

                        if ($result->num_rows > 0) {
                            // imprime todas as divisoes
                            while ($row = $result->fetch_assoc()) {
                                echo ("<option value='$row[id_divisao]'>Divisão: $row[nome_divisao] </option>");
                            }
                        }
?>
                        </select>
                </div>

                <div style="margin-top: 20px;" class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Pista</label>
                        <select name="IdPistaInput" class="form-select" id="inputGroupSelect01">
<?php
                        $query = ("SELECT * FROM `pista`");
                        $result = $db->query($query);

                        if ($result->num_rows > 0) {
                            // imprime todas as pistas
                            while ($row = $result->fetch_assoc()) {
                                echo ("<option value='$row[id_pista]'> $row[nome_pista] </option>");
                            }
                        }
?>
                        </select>
                </div>

                <div style="margin-top: 20px;" class="input-group">
                    <span class="input-group-text">Hórario</span>
                    <input type="datetime-local" class="form-control" name="DataCorridaInput"  required>
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
mysqli_close($db);
?>