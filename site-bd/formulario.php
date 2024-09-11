<?php
include('config.php');

if (isset($_POST["Username"]) && isset($_POST["Nome"]) && isset($_POST["Sobrenome"]) && isset($_POST["PasswordUser"]) && isset($_POST["EmailUser"]) && isset($_POST["SteamIDUser"]) && isset($_POST["DiscordUser"]) && isset($_POST["DataNascimentoUser"]) && isset($_POST["GeneroUser"])) {

	$Username = $_POST["Username"];
	$Nome = $_POST["Nome"];
	$Sobrenome = $_POST["Sobrenome"];
	$EmailUser = $_POST["EmailUser"];
	$PasswordUser = md5($_POST["PasswordUser"]);
	$DataNascimentoUser = $_POST["DataNascimentoUser"];
	$SteamIDUser = $_POST["SteamIDUser"];
	$GeneroUser = $_POST["GeneroUser"];
	$DiscordUser = $_POST["DiscordUser"];

	// Database connection
	if (mysqli_connect_error()) {
		die("Database connection failed: " . mysqli_connect_error());
	} else {
		$stmt = $db->prepare("insert into users(Username, Nome, Sobrenome, PasswordUser, EmailUser, SteamIDUser, DiscordUser, DataNascimentoUser, GeneroUser) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssisss", $Username, $Nome, $Sobrenome, $PasswordUser, $EmailUser, $SteamIDUser, $DiscordUser, $DataNascimentoUser, $GeneroUser);
		$stmt->execute();
		$stmt->close();
		$db->close();

		header("location:index.php");
	}
}
?>
<html>
	<head>
		<link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Candidaturas</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
			integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
			crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="css/criarconta.css" />
	</head>
	<body>
		<h1>Criar Conta</h1>
		<p>Prencha os campos com a informação pedida.</p>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<fieldset>
				<label>Username: <input type="text" name="Username" required /></label>
				<label>Nome: <input type="text" name="Nome" required></label>
				<label>Sobrenome: <input type="text" name="Sobrenome" required /></label>
				<label>Enter Your Email: <input type="email" name="EmailUser" required /></label>
				<label>Password: <input type="password" name="PasswordUser"  required /></label>
				<label>Data de Nascimento : <input type="date" name="DataNascimentoUser" required /></label>
				<label>Steam ID : <input type="text" name="SteamIDUser"></label>
				<label>Discord : <input type="text" name="DiscordUser"></label>
				<label>Genero :
					<select name="GeneroUser" required><br>
						<option value="Masculino">Masculino</option>
						<option value="Femenino">Feminino</option>
						<option value="Outros">Outros</option>
						<option value="Prefiro não dizer">Prefiro não dizer</option>
					</select>
				</label>

			</fieldset>
			<input type="submit">

		</form>
		<A HREF="login.php">Login</A>
	</body>
</html>