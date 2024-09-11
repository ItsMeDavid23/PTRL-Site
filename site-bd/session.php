<?php
include('config.php');
session_start();

$login_session = $_SESSION['login_session'];

$query = $db->query("SELECT * FROM users WHERE IdUser = '$login_session'");
$result = $query->fetch_all();

$IdUser = $result[0][0];
$NomeUser = $result[0][1];
$SobrenomeUser = $result[0][2];
$Username = $result[0][3];
$EmailUser = $result[0][5];
$CargoUser = $result[0][6];
$SteamIDUser = $result[0][7];
$DiscordUser = $result[0][8];
$DatanascimentoUser = $result[0][9];
$GeneroUser = $result[0][10];
$PistaFavoritaUser = $result[0][11];

if (!isset($_SESSION['login_session'])) {
   header("location:login.php");
   die();
}
