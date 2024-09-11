<?php include("session.php"); ?>
<html lang="en" dir="ltr">

<head>
    <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/csssite.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Perfil do piloto</title>
    <style>
        @font-face {
            font-family: "Teko";
            src: url("./fonts/Teko/Teko-Regular.ttf"), url("./fonts/Teko/Teko-Bold.ttf");
        }

        * {
            font-family: 'Teko', Arial, Helvetica, sans-serif;
            color: white;
            text-transform: uppercase;
        }

        h1 {
            letter-spacing: 2px;
            font-size: 78px;
        }

        h1,
        .sub-title {
            color: white;
            text-transform: uppercase;
        }

        p {
            font-family: sans-serif;
            text-transform: none;
        }

        .sub-title {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            height: fit-content;
        }

        .overall-container {
            position: relative;
            width: 300px;
            height: 40px;
            background-color: #eee;
            border-radius: 20px;
            overflow: hidden;
        }

        .overall-bar {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #f00;
            transition: width 0.5s ease;
        }

        .overall-number {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 40px;
            margin-top: 2px;
            font-weight: bold;
            color: #1e191f;
            text-align: center;
        }

        .overall-bar.orange {
            background-color: #f90;
        }

        .overall-bar.yellow {
            background-color: #ff0;
        }

        .overall-bar.light-green {
            background-color: #0f0;
        }

        .overall-bar.dark-green {
            background-color: #090;
        }


        @media screen and (max-width: 700px) {

            #imginthefooter img:first-child {
                margin-top: 1em;
            }
        }
    </style>
</head>

<body onload="piloto1Infos()">
    <div style="background-color:#1E191F; padding-bottom: 5em;">
        <div>
            <?php include("navbarfront.php"); ?>
            <div style="font-size:40px;height:100%;">
                <h1 style="text-align: center;margin-bottom:30px;">Perfil do Piloto</h1>

                <div style="text-align:center;margin-bottom:30px;">
                    <!-- Seletor de pilotos -->
                    <label for="piloto">Comparar com:</label>
                    <select name="piloto" id="piloto" style="background-color:#999999;text-align:center" onchange="pesquisarPiloto()">
                        <option value="">Selecione</option>
                        <!-- Aqui você pode adicionar as opções do seletor de acordo com seus dados de pilotos -->
                        <?php
                        $query = "SELECT nome FROM piloto WHERE nome != '$Username';";
                        $result = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $nomePiloto = $row['nome'];
                            echo "<option value='$nomePiloto'>$nomePiloto</option>";
                        }
                        ?>
                    </select>
                </div>

                <div style="display:grid;grid-template-columns: 1fr 1fr;">
                    <div style="margin-left:auto;margin-right:auto;">

                        <h1><?php echo ($Username); ?></h1>
                        <div class="overall-container">
                            <div id='overall_bar_piloto1' class="overall-bar"></div>
                            <div id="overall_num_piloto1" class="overall-number"></div>
                        </div>
                        <?php
                        $query = "SELECT id_piloto FROM piloto WHERE nome = '$Username'";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_array($result);
                        $id_piloto = $row['id_piloto'];

                        $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
                        $result = $db->query($query);
                        $row = $result->fetch_assoc();
                        $idTemporada = $row['id_temporada'];

                        // Numero total de corridas
                        $query = "SELECT COUNT(*) AS total FROM resultado WHERE id_piloto = '$id_piloto'";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_array($result);
                        $NumCorridas = $row['total'];

                        $query = "SELECT  p.id_temporada, e.nome_equipa, o.nome_organizacao, d.nome_divisao, p.pontos FROM pilotopontostemporada p LEFT JOIN equipa e ON p.id_equipa = e.id_equipa LEFT JOIN organizacao o ON p.id_organizacao = o.id_organizacao LEFT JOIN divisao d ON p.id_divisao = d.id_divisao WHERE id_piloto = '$id_piloto';";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_array($result);

                        switch ($row['nome_equipa']) {
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
                        if ($row['nome_equipa'] != "Nenhuma") {
                            echo ($row['nome_equipa'] . "<br>");
                        }

                        switch ($row['nome_organizacao']) {
                            case "Lights Out SimRacing":
                                echo ("<img src='imagens\LightsOut_SimRacing-01.webp' height='43px'>");
                                break;

                            case "For The Win":
                                echo ("<img src='imagens/ftw.webp' style='margin-right:5px;' height='35px'>");
                                break;
                        }
                        if ($row['nome_organizacao'] != "Nenhuma") {
                            echo ($row['nome_organizacao'] . "<br>");
                        }
                        echo "Divisao : <span id='piloto1Liga'>" . $row['nome_divisao'] . "</span><br>";
                        echo "-----------Stats----------- <br>";
                        echo "Pontos na PTRL: <span id='piloto1Pontos'>" . $row['pontos'] . "</span><br>";
                        echo "Corridas na PTRL: <span id='piloto1Corridas'>" . $NumCorridas . "</span><br>";

                        if ($NumCorridas != 0) {
                            echo "Média Pontos/Corrida: <span id='piloto1Media'>" . number_format(($row['pontos'] / $NumCorridas), 2)  . "</span><br>";
                        } else {
                            echo "Média Pontos/Corrida: <span id='piloto1Media'>" . $row['pontos'] . "</span><br>";
                        }
                        ?>
                    </div>
                    <div id="resultadoPiloto" style="margin-left: auto; margin-right: auto;"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
    <?php include("script_nav.php"); ?>
    <script>
        function pesquisarPiloto() {
            var select = document.getElementById("piloto");
            var pilotoSelecionado = select.value;

            var piloto1PontosElement = document.getElementById("piloto1Pontos");
            var piloto2PontosElement = document.getElementById("piloto2Pontos");

            if (pilotoSelecionado !== "") {
                // Faz a solicitação AJAX para buscar as informações do piloto selecionado
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        // Recebe a resposta e atualiza o conteúdo do div com as informações do piloto
                        var resultadoDiv = document.getElementById("resultadoPiloto");
                        resultadoDiv.innerHTML = this.responseText;

                        compararPontos();
                    }
                };
                xhttp.open("GET", "get_piloto_info.php?piloto=" + pilotoSelecionado, true);
                console.log("get_piloto_info.php?piloto=" + pilotoSelecionado);
                xhttp.send();
            } else {
                var resultadoDiv = document.getElementById("resultadoPiloto");
                resultadoDiv.innerHTML = "";

                piloto1PontosElement.style.color = "white";
                piloto2PontosElement.style.color = "white";
            }
        }

        function piloto1Infos() {
            var piloto1Divisao = document.getElementById("piloto1Liga").textContent;
            var piloto1Pontos = parseInt(document.getElementById("piloto1Pontos").textContent);
            var piloto1Corridas = parseInt(document.getElementById("piloto1Corridas").textContent);
            var piloto1Media = parseFloat(document.getElementById("piloto1Media").textContent);

            var piloto1PontosElement = document.getElementById("piloto1Pontos");
            var piloto1CorridasElement = document.getElementById("piloto1Corridas");
            var piloto1MediaElement = document.getElementById("piloto1Media");


            var peso1 = 9;
            var piloto1Media = parseFloat(document.getElementById("piloto1Media").textContent);
            var overall1;

            if (piloto1Media >= 25) {
                overall1 = 99;
            } else if (piloto1Media <= 0) {
                overall1 = 69;
            } else {
                var delta = 25 - 0; // Diferença entre os pontos máximos e mínimos
                var scale = (piloto1Media - 0) / delta; // Escala proporcional entre 0 e 1
                overall1 = 69 + Math.round(scale * (99 - 69)); // Cálculo proporcional do overall1
            }

            if (piloto1Divisao !== "Ultimate") {
                if (overall1 > 79) {
                    overall1 = 79;
                }
            }

            var overallBarElement1 = document.getElementById('overall_bar_piloto1');
            var overallNumberElement1 = document.getElementById('overall_num_piloto1');

            overallBarElement1.style.width = (overall1 + 1) + '%';
            overallNumberElement1.textContent = overall1;


            if (overall1 <= 60) {
                overallBarElement1.className = 'overall-bar';
            } else if (overall1 <= 69) {
                overallBarElement1.className = 'overall-bar orange';
            } else if (overall1 <= 79) {
                overallBarElement1.className = 'overall-bar yellow';
            } else if (overall1 <= 89) {
                overallBarElement1.className = 'overall-bar light-green';
            } else {
                overallBarElement1.className = 'overall-bar dark-green';
            }
        }

        function compararPontos() {

            var piloto1Pontos = parseInt(document.getElementById("piloto1Pontos").textContent);
            var piloto1Corridas = parseInt(document.getElementById("piloto1Corridas").textContent);
            var piloto1Media = parseFloat(document.getElementById("piloto1Media").textContent);

            var piloto2Divisao = document.getElementById("piloto2Liga").textContent;
            var piloto2Pontos = parseInt(document.getElementById("piloto2Pontos").textContent);
            var piloto2Corridas = parseInt(document.getElementById("piloto2Corridas").textContent);
            var piloto2Media = parseFloat(document.getElementById("piloto2Media").textContent);

            var piloto1PontosElement = document.getElementById("piloto1Pontos");
            var piloto1CorridasElement = document.getElementById("piloto1Corridas");
            var piloto1MediaElement = document.getElementById("piloto1Media");

            var piloto2PontosElement = document.getElementById("piloto2Pontos");
            var piloto2CorridasElement = document.getElementById("piloto2Corridas");
            var piloto2MediaElement = document.getElementById("piloto2Media");

            if (piloto1Pontos > piloto2Pontos) {
                piloto1PontosElement.style.color = "green";
                piloto2PontosElement.style.color = "red";
            } else if (piloto1Pontos < piloto2Pontos) {
                piloto1PontosElement.style.color = "red";
                piloto2PontosElement.style.color = "green";
            } else {
                piloto1PontosElement.style.color = "yellow";
                piloto2PontosElement.style.color = "yellow";
            }

            if (piloto1Corridas > piloto2Corridas) {
                piloto1CorridasElement.style.color = "green";
                piloto2CorridasElement.style.color = "red";
            } else if (piloto1Corridas < piloto2Corridas) {
                piloto1CorridasElement.style.color = "red";
                piloto2CorridasElement.style.color = "green";
            } else {
                piloto1CorridasElement.style.color = "yellow";
                piloto2CorridasElement.style.color = "yellow";
            }

            if (piloto1Media > piloto2Media) {
                piloto1MediaElement.style.color = "green";
                piloto2MediaElement.style.color = "red";
            } else if (piloto1Media < piloto2Media) {
                piloto1MediaElement.style.color = "red";
                piloto2MediaElement.style.color = "green";
            } else {
                piloto1MediaElement.style.color = "yellow";
                piloto2MediaElement.style.color = "yellow";
            }

            //calcula o overall do piloto 2
            var peso2 = 9;
            var piloto2Media = parseFloat(document.getElementById("piloto2Media").textContent);

            var overall2;

            if (piloto2Media >= 25) {
                overall2 = 99;
            } else if (piloto2Media <= 0) {
                overall2 = 69;
            } else {
                var delta = 25 - 0; // Diferença entre os pontos máximos e mínimos
                var scale = (piloto2Media - 0) / delta; // Escala proporcional entre 0 e 1
                overall2 = 69 + Math.round(scale * (99 - 69)); // Cálculo proporcional do overall2
            }

            if (piloto2Divisao !== "Ultimate") {
                if (overall2 > 79) {
                    overall2 = 79;
                }
            }

            var overallBarElement2 = document.getElementById('overall_bar_piloto2');
            var overallNumberElement2 = document.getElementById('overall_num_piloto2');

            overallNumberElement2.textContent = overall2;
            overall2 = overall2 + 1;
            overallBarElement2.style.width = overall2 + '%';
            overall2 = overall2 - 1;
            if (overall2 <= 60) {
                overallBarElement2.className = 'overall-bar';
            } else if (overall2 <= 69) {
                overallBarElement2.className = 'overall-bar orange';
            } else if (overall2 <= 79) {
                overallBarElement2.className = 'overall-bar yellow';
            } else if (overall2 <= 89) {
                overallBarElement2.className = 'overall-bar light-green';
            } else {
                overallBarElement2.className = 'overall-bar dark-green';
            }

        }
    </script>
</body>

</html>