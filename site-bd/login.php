<?php
include("config.php");
session_start();

function getRealIpAddr(){

	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	{
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
	  $ip='93.108.241.227';
	  //$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;

}

if (isset($_POST['EmailUser']) && isset($_POST['PasswordUser'])) {

	// EmailUser and PasswordUser sent from form 
	$EmailUser = mysqli_real_escape_string($db, $_POST['EmailUser']);
	$PasswordUser = md5(mysqli_real_escape_string($db, $_POST['PasswordUser']));

	$row = $db->query("SELECT IdUser FROM users WHERE EmailUser = '$EmailUser' and PasswordUser = '$PasswordUser'");
	$result = $row->fetch_all();
	$count = $row->num_rows;

	// If result matched $EmailUser and $PasswordUser, table row must be 1 row
	if ($count == 1) {

		//Cria a sessão
		$IdUser = $result[0][0];
		$_SESSION["login_session"] = $IdUser;

		//Insere um novo registo na tabela access_logs na base de dados com o seu ip, pais, hora.
		$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".getRealIpAddr());
		$country = $xml->geoplugin_countryName;	
		$sigla =  $xml->geoplugin_countryCode;
		$latitude = $xml->geoplugin_latitude;
		$longitude = $xml->geoplugin_longitude;

		$accessTime = date('Y-m-d H:i:s');
		//$userIP = $_SERVER['REMOTE_ADDR'];
		
		$sql = "INSERT INTO access_logs (access_time, country, sigla, latitude, longitude, id_user) VALUES ('$accessTime', '$country', '$sigla', '$latitude', '$longitude', '$IdUser')";
		if ($db->query($sql) === FALSE) {
		   echo "Erro ao registrar acesso: " . $db->error;
		} 

		header("location:index.php");
	} else {
		$error = "Your Email or Password is invalid";
	}
}
?>
<html lang="en">

<head>
	<link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">Bem-Vindo</span>
				<form action="login.php" method="post" class="login100-form validate-form p-b-33 p-t-5">

					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="EmailUser" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="PasswordUser" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button type="submit" value=" Submit " class="login100-form-btn"> Login </button>
					</div>
					<?php if (isset($error)) { ?>
						<div style="font-size:17px; text-align:center; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					<?php } ?>
				</form>
				<A HREF="formulario.php">Criar conta</A>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
</body>

</html>