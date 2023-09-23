<?php

include("session.php");

// Verifique se o email foi enviado
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // Verifique se o email já está em uso
    $query = "SELECT * FROM users WHERE EmailUser = '$email'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        echo 'true'; // O email já está em uso
    } else {
        echo 'false'; // O email não está em uso
    }
}
