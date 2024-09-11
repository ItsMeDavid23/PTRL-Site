<?php include('config.php');

// Verificar se o parâmetro idDivisao foi definido
if (isset($_GET["piloto"])) {
    $pilotoSelecionado = $_GET["piloto"];

    // ID Piloto para outras Querys
    $query = "SELECT id_piloto FROM piloto WHERE nome = '$pilotoSelecionado'";
    $result = mysqli_query($db, $query);
    $row2 = mysqli_fetch_array($result);
    $id_piloto = $row2['id_piloto'];

    // Numero total de corridas
    $query = "SELECT COUNT(*) AS total FROM resultado WHERE id_piloto = '$id_piloto'";
    $result = mysqli_query($db, $query);
    $row2 = mysqli_fetch_array($result);
    $NumCorridas = $row2['total'];

    // ID Temporada
    $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
    $result = $db->query($query);
    $row2 = $result->fetch_assoc();
    $idTemporada = $row2['id_temporada'];

    $query = "SELECT  p.id_temporada, e.nome_equipa, o.nome_organizacao, d.nome_divisao, p.pontos FROM pilotopontostemporada p LEFT JOIN equipa e ON p.id_equipa = e.id_equipa LEFT JOIN organizacao o ON p.id_organizacao = o.id_organizacao LEFT JOIN divisao d ON p.id_divisao = d.id_divisao WHERE id_piloto = '$id_piloto' AND id_temporada = '$idTemporada';";
    $result = mysqli_query($db, $query);
    $row2 = mysqli_fetch_array($result);
?>
    <h1> <?php echo $pilotoSelecionado . "<br>"; ?> </h1>
    <div class="overall-container">
        <div id='overall_bar_piloto2' class="overall-bar"></div>
        <div id="overall_num_piloto2" class="overall-number"></div>
    </div>

<?php
    switch ($row2['nome_equipa']) {
        case "Mercedes":
            echo ("<img src='imagens\Mercedes.webp' style='margin-right:5px;' height='35px'>");
            break;

        case "Red Bull Racing":
            echo ("<img src='imagens/logo_red_bull.webp' style='margin-right:5px;' height='35px'>");
            break;

        case "Ferrari":
            echo ("<img src='imagens/scuderia-ferrari-logo.webp' style='margin-right:5px;' height='35px'>");
            break;

        case "Alpine":
            echo ("<img src='imagens/Alpine.webp' style='margin-right:5px;' height='35px'>");
            break;

        case "McLaren":
            echo ("<img src='imagens/McLaren.webp' style='margin-right:5px;' height='35px'>");
            break;

        case "Aston Martin":
            echo ("<img src='imagens/AstonMartin.webp' style='margin-right:5px;' height='35px'>");
            break;

        case "Williams":
            echo ("<img src='imagens/Williams.webp' style='margin-right:5px;' height='35px'>");
            break;

        case "AlphaTauri":
            echo ("<img src='imagens/AlphaTauri.webp' style='margin-right:5px;' height='35px'>");
            break;

        case "Hass F1 Team":
            echo ("<img src='imagens/Hass.webp' style='margin-right:5px;' height='35px'>");
            break;

        case "Alfa Romeo":
            echo ("<img src='imagens/AlfaRomeo.webp' style='margin-right:5px;' height='35px'>");
            break;
    }
    echo ($row2['nome_equipa'] . "<br>");

    switch ($row2['nome_organizacao']) {
        case "Lights Out SimRacing":
            echo ("<img src='imagens\LightsOut_SimRacing-01.webp' height='43px'>");
            break;

        case "For The Win":
            echo ("<img src='imagens/ftw.webp' style='margin-right:5px;' height='35px'>");
            break;
    }
    echo ($row2['nome_organizacao'] . "<br>");


    echo "Divisao : <span id='piloto2Liga'>" . $row2['nome_divisao'] . "</span><br>";
    echo "-----------Stats----------- <br>";
    echo "Pontos na PTRL: <span id='piloto2Pontos'>" . $row2['pontos'] . "</span><br>";
    echo "Corridas na PTRL: <span id='piloto2Corridas'>" . $NumCorridas . "</span><br>";
    if ($NumCorridas != 0) {
        echo "Média Pontos/Corrida: <span id='piloto2Media'>" . number_format(($row2['pontos'] / $NumCorridas), 2)  . "</span><br>";
    } else {
        echo "Média Pontos/Corrida: <span id='piloto2Media'>" . $row2['pontos'] . "</span><br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}
// Fechar a conexão com o banco de dados
$db->close();
