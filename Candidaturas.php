<?php
include('session.php');

//<!------------------- SITE PARA USERS -------------------->
if ($CargoUser == "User") {

	// Verifica se já fez uma candidatura
	$row = $db->query("SELECT Username FROM candidaturaspiloto WHERE IDUser = $IdUser");
	$result = $row->fetch_all();
	$count = $row->num_rows;

	if ($count == 1 || isset($_POST["Pergunta1"])) {
?>
		<html>

		<head>
			<link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Candidaturas</title>
			<link rel="icon" type="image/x-icon" href="imagens/PTRL.jpg">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link rel="stylesheet" href="css/formulario.css" />
		</head>

		<body style="padding:100px">
			<main>
				<div class="setinha">
					<A HREF="index.php"><i class="fa-solid fa-arrow-left"></i></A>
					<h1>Candidaturas para piloto</h1>
					<img style="width: 35px;" src="imagens\darkthemeicon\moon.webp" id="icon">
				</div>
				<div>
					<p style="text-align: center; font-size: 25px;">A sua candidatura encontra-se sobre analise dos administradores .</p>
				</div>
			</main>
		</body>
		<script>
			var icon = document.getElementById("icon");
			icon.onclick = function() {
				document.body.classList.toggle("dark-mode");

				if (document.body.classList.contains("dark-mode")) {
					icon.src = "imagens\darkthemeicon\sun.webp"
				} else {
					icon.src = "imagens\darkthemeicon\moon.webp"
				}
			}
		</script>

		</html>
		<?php
		if (isset($_POST["Pergunta1"])) {

			// Recebe o formulário
			$Pergunta1 = $_POST["Pergunta1"];
			$Pergunta2 = $_POST["Pergunta2"];
			$Pergunta3 = $_POST["Pergunta3"];
			$Pergunta4 = $_POST["Pergunta4"];
			$Pergunta5 = $_POST["Pergunta5"];
			$Pergunta6 = $_POST["Pergunta6"];
			$Pergunta7 = $_POST["Pergunta7"];
			$Pergunta8 = $_POST["Pergunta8"];

			// Envia o formulario do user para a db
			if (mysqli_connect_error()) {
				die("Database connection failed: " . mysqli_connect_error());
			} else {
				$stmt = $db->prepare("insert into candidaturaspiloto (IDUser, Username, Pergunta1, Pergunta2, Pergunta3, Pergunta4, Pergunta5,  Pergunta6, Pergunta7, Pergunta8) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("isssssssis", $IdUser, $Username, $Pergunta1, $Pergunta2, $Pergunta3, $Pergunta4, $Pergunta5, $Pergunta6, $Pergunta7, $Pergunta8);
				$stmt->execute();
				$stmt->close();
			}
		}
	} else {

		// Completa os campos "Discord" e "Steam" do formulário com informação que pode ja ter sido inserida na criação da conta 
		$query = $db->query("SELECT `SteamIdUser`,`DiscordUser` FROM `users` WHERE IdUser = $IdUser ");
		$result = $query->fetch_all();

		$TemSteam = $result[0][0];
		$TemDiscord = $result[0][1];

		if (empty($TemDiscord)) {
			$TemDiscord = "";
		}
		if (empty($TemSteam)) {
			$TemSteam = "";
		}
		?>
		<html>

		<head>
			<link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Candidaturas</title>
			<link rel="icon" type="image/x-icon" href="imagens/PTRL.jpg">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link rel="stylesheet" href="css/formulario.css" />
		</head>

		<body>
			<main style="margin-right: 350px;margin-left: 350px;margin-top: 40px;">
				<div class="setinha">
					<A HREF="index.php"><i class="fa-solid fa-arrow-left"></i></A>
					<h1>Candidaturas para piloto</h1>
					<img style="width: 35px;" src="imagens\darkthemeicon\moon.webp" id="icon">
				</div>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="max-width:1200px;margin-right:auto;margin-left:auto;">

					<div style="margin-bottom: 20px;">
						<label for="name" class="large-label">Steam ID:</label>
						<input id="name" type="text" name="Pergunta1" value="<?php echo ($TemSteam); ?>" required />
					</div>

					<div style="margin-bottom: 20px;">
						<label for="name" class="large-label">Discord:</label>
						<input id="name" type="text" name="Pergunta2" value="<?php echo ($TemDiscord); ?>" required />
					</div>

					<div style="margin-bottom: 20px;">
						<label for="name" class="large-label">Representa alguma organização?</label>
						<input id="name" type="text" name="Pergunta3" placeholder="Ex: LightsOut SimRacing" required />
					</div>

					<div style="margin-bottom: 20px;">
						<label for="name" class="large-label">País de residência:</label>
						<input id="name" type="text" name="Pergunta4" placeholder="Ex: Portugal" required />
					</div>

					<div style="margin-bottom: 20px;">
						<label for="name" class="large-label">Speedtest.net para servidor lisboa:</label>
						<input id="name" type="text" name="Pergunta5" placeholder="https://www.speedtest.net/pt/result/..." required />
					</div>

					<div style="margin-bottom: 20px;">
						<fieldset>
							<legend class="large-label">Que tipo de assists usas?</legend>
							<input type="radio" name="Pergunta6" id="Nenhuma" value="Nenhuma" />
							<label for="yes" class="small-label">Nenhuma</label>
							<input type="radio" name="Pergunta6" id="Linha" value="Linha" />
							<label for="no" class="small-label">Linha</label>
							<input type="radio" name="Pergunta6" id="Outras" value="Outras" />
							<label for="no" class="small-label">Outras</label>
						</fieldset>
					</div>

					<div style="margin-bottom: 20px;">
						<label for="name" class="large-label">Numero de Piloto:</label>
						<input id="name" type="text" name="Pergunta7" placeholder="Ex: 1" required />
					</div>

					<div style="margin-bottom: 20px;" class="full-width">
						<label for="message" class="large-label">Carta Motivacional , quais as suas ambições na PTRL?</label>
						<textarea id="message" style="resize: none;" name="Pergunta8" rows="5" placeholder="Fala um pouco sobre o que queres alcançar na PTRL..." required></textarea>
					</div>

					<div style="margin-bottom: 20px;" class="full-width">
						<button type="submit">Enviar Formulário</button>
						<button type="reset">Limpar </button>
					</div>
				</form>
			</main>
			<script>
				var icon = document.getElementById("icon");
				icon.onclick = function() {
					document.body.classList.toggle("dark-mode");

					if (document.body.classList.contains("dark-mode")) {
						icon.src = "imagens/darkthemeicon/sun.webp"
					} else {
						icon.src = "imagens/darkthemeicon/moon.webp"
					}
				}
			</script>
		</body>

		</html>
		<?php
	}
}
//<!------------------ SITE PARA ADMINS -------------------->
if ($CargoUser == "Admin") {

	// Vê se já foram introduzidos os resultados da analise da candidatura , aceita ou recusa a candidatura
	if (isset($_POST["Resultado"])) {

		$IdUserCandidatura = $_POST["IdUserCandidatura"];
		$SteamIDCandidatura = $_POST["SteamIDCandidatura"];
		$DiscordCandidatura = $_POST["DiscordCandidatura"];

		//aceita a candidatura e apaga 
		if ($_POST["Resultado"] == "Aceitar") {

			$username = $_POST['Username'];

			// Passar a piloto
			$sql = "UPDATE `users` SET `CargoUser` = 'Piloto' , `SteamIDUser` = '$SteamIDCandidatura' , `DiscordUser` = '$DiscordCandidatura' WHERE `users`.`IdUser` = '$IdUserCandidatura';";

			if ($db->query($sql) === TRUE) {

				// Apagar a candidatura apos ter sido aceite 
				$sql = "DELETE FROM candidaturaspiloto WHERE `IDUser` = '$IdUserCandidatura';";

				try {
					$db->query($sql);
				} catch (Exception $e) {
					echo 'erro ao aceitar a candidatura: ', $e->getMessage(), "\n";
				}
			} else {
				echo "Erro na analise: " . $db->error;
			}

			//ao ser aceite , verifica se anteior mente já foi membro da liga e portanto o campo na tabela piloto ja existe , se for novo cria o campo , se não for só muda o estado de 0 para 1
			$sql = "SELECT id_piloto FROM `piloto` WHERE nome = '$username';";
			$result = $db->query($sql);

			if ($result->num_rows == 0) {

				//cria o user na tabela piloto
				$sql = "INSERT INTO `piloto` (`id_piloto`, `nome`) VALUES (NULL,'$username');";
				$db->query($sql);

				// vai buscar o id piloto que inseriu
				$sql = "SELECT id_piloto FROM piloto WHERE nome = '$username';";
				$result = $db->query($sql);

				if ($result->num_rows > 0) {

					$row = $result->fetch_assoc();
					$idPiloto = $row['id_piloto'];

					// Segunda consulta para obter o ID da temporada com o maior valor
					$secondQuery = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
					$result = $db->query($secondQuery);

					if ($result->num_rows > 0) {

						$row = $result->fetch_assoc();
						$idTemporada = $row['id_temporada'];

						// Terceira consulta para inserir os valores na tabela pilotopontostemporada
						$thirdQuery = "INSERT INTO `pilotopontostemporada` (`id_piloto`, `id_temporada`, `pontos`, `id_equipa`, `id_organizacao`, `id_divisao`) VALUES ('$idPiloto', '$idTemporada', '0', '22', '8', '5');";
						$db->query($thirdQuery);
					} else {
						echo "Nenhuma temporada encontrada.";
					}
				} else {
					echo "Piloto não encontrado.";
				}
			} else {
				$sql = "UPDATE `piloto` SET estado_piloto = '1' WHERE nome = '$username';";
				$db->query($sql);
			}
		}

		// Apaga a candidatura recusada
		if ($_POST["Resultado"] == "Reprovar") {

			$sql = "DELETE FROM candidaturaspiloto WHERE `IDUser` = '$IdUserCandidatura';";
			try {
				$db->query($sql);
			} catch (Exception $e) {
				echo 'erro ao recusar a candidatura: ', $e->getMessage(), "\n";
			}
		}
	}

	// Verifica se há mais candidaturas para serem analisadas
	$row = $db->query("SELECT IDUser FROM candidaturaspiloto ");
	$result = $row->fetch_all();
	$count = $row->num_rows;

	if ($count >= 1) {

		// Se houver , vê quem tem a candidatura mais antiga , para ser a primeira a ser analisada
		$query = "SELECT * FROM `candidaturaspiloto` ORDER BY `candidaturaspiloto`.`DataCandidatura` DESC";

		if ($result = $db->query($query)) {
			while ($row = $result->fetch_assoc()) {

				$field0name = $row["IDUser"];
				$field1name = $row["Username"];
				$field2name = $row["Pergunta1"];
				$field3name = $row["Pergunta2"];
				$field4name = $row["Pergunta3"];
				$field5name = $row["Pergunta4"];
				$field6name = $row["Pergunta5"];
				$field7name = $row["Pergunta6"];
				$field8name = $row["Pergunta7"];
				$field9name = $row["Pergunta8"];
				$field13name = $row["DataCandidatura"];
			}
			$result->free();
		?>
			<html>

			<head>
				<link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
				<link rel="stylesheet" href="css/formulario.css" />
				<meta charset="UTF-8">
				<link rel="stylesheet" href="css/admin.css">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
				<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
			</head>

			<body>
				<?php include("navbarback.php"); ?>
				<section class="home-section">
					<div class="home-content">
						<i class='bx bx-menu'></i>
						<span class="text"></span>
					</div>
					<h1 style="font-size: 35px; text-align: center; margin-bottom:20px;">Analise de Candidaturas</h1>
					<div style="max-width:1200px;margin-right:auto;margin-left: auto;">

						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
							<div style="margin-bottom: 14px;">
								<label for="name" class="large-label">ID User</label>
								<input id="name" name="IdUserCandidatura" type="text" value="<?php echo ($field0name) ?> " readonly />
							</div>
							<div style="margin-bottom: 14px;">
								<label for="name" class="large-label">Candidatura realizada em:</label>
								<input id="name" type="text" value="<?php echo ($field13name) ?> " readonly />
							</div>
							<div style="margin-bottom: 14px;">
								<label for="name" class="large-label">Username:</label>
								<input id="name" type="text" name="Username" value="<?php echo ($field1name) ?>" readonly />
							</div>
							<div style="margin-bottom: 14px;">
								<label for="name" class="large-label">SteamID :</label>
								<input id="name" name="SteamIDCandidatura" type="text" value="<?php echo ($field2name) ?>" readonly />
							</div>
							<div style="margin-bottom: 14px;">
								<label for="name" class="large-label">Discord:</label>
								<input id="name" name="DiscordCandidatura" type="text" value="<?php echo ($field3name) ?>" readonly />
							</div>
							<div style="margin-bottom: 14px;">
								<label for="name" class="large-label">Representa alguma organização?</label>
								<input id="name" type="text" value="<?php echo ($field4name) ?>" readonly />
							</div>
							<div style="margin-bottom: 14px;">
								<label for="name" class="large-label">País de residência:</label>
								<input id="name" type="text" value="<?php echo ($field5name) ?>" readonly />
							</div>
							<div style="margin-bottom: 14px;">
								<label for="name" class="large-label">Speedtest.net para servidor lisboa:</label>
								<input id="name" type="text" value="<?php echo ($field6name) ?>" readonly />
							</div>
							<div style="margin-bottom: 14px;">
								<fieldset>
									<legend class="large-label">Que tipo de assists usas?</legend>
									<input type="radio" id="Nenhuma" value="Nenhuma" <?php if ($field7name == "Nenhuma") {
																							echo "checked";
																						} ?> disabled />
									<label for="yes" class="small-label">Nenhuma</label>
									<input type="radio" id="Linha" value="Linha" <?php if ($field7name == "Linha") {
																						echo "checked";
																					} ?> disabled />
									<label for="no" class="small-label">Linha</label>
									<input type="radio" id="Outras" value="Outras" <?php if ($field7name == "Outras") {
																						echo "checked";
																					} ?> disabled />
									<label for="no" class="small-label">Outras</label>
								</fieldset>
							</div>
							<div style="margin-bottom: 14px;">
								<label for="name" class="large-label">Numero de Piloto:</label>
								<input id="name" type="text" value="<?php echo ($field8name) ?>" readonly />
							</div>
							<div style="margin-bottom: 14px;" class="full-width">
								<label for="message" class="large-label">Carta Motivacional , quais as suas ambições na PTRL?</label>
								<textarea id="message" style="resize: none;height:170px;" maxlength="308" readonly><?php echo ($field9name) ?></textarea>
							</div>
							<div class="full-width butons">
								<button type="submit" name="Resultado" value="Aceitar">Aceitar</button>
								<button style="background-color: red;" type="submit" name="Resultado" value="Reprovar">Recusar</button>
							</div>
						</form>
					</div>
					</main>
				</section>
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
					console.log(sidebarBtn);
					sidebarBtn.addEventListener("click", () => {
						sidebar.classList.toggle("close");
					});
				</script>
			</body>

			</html>
		<?php
		}
	} else {
		//Caso não haja mais candidaturas a serem analisadas pelos admins
		?>
		<html>

		<head>
			<link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
			<meta charset="UTF-8">
			<link rel="stylesheet" href="css/admin.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		</head>

		<body>
			<?php include("navbarback.php"); ?>
			<section class="home-section">
				<div class="home-content">
					<i class='bx bx-menu'></i>
					<span class="text"></span>
				</div>
				<h1 style="font-size: 35px; text-align: center; margin-bottom:20px;">Analise de Candidaturas</h1>
				<p style="text-align: center; font-size: 25px;">Não há candidaturas para serem analisadas.</p>
			</section>
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
				var icon = document.getElementById("icon");
				icon.onclick = function() {
					document.body.classList.toggle("dark-mode");

					if (document.body.classList.contains("dark-mode")) {
						icon.src = "imagens/darkthemeicon/sun.webp"
					} else {
						icon.src = "imagens/darkthemeicon/moon.webp"
					}
				}
			</script>
		</body>

		</html>
<?php
	}
}
?>