<?php
include("session.php");

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);

    $query = "DELETE FROM users WHERE IdUser = $id";
    mysqli_query($db, $query);
}
header('Location: VerUsers.php');
