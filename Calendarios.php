<?php include('session.php'); 

//Verifica quais corridas estão a decorrer e passa o compo "estado_corrida" para "decorrer"
$query = "SELECT id_corrida FROM corrida WHERE estado_corrida = 'agendada' AND CURRENT_TIMESTAMP > data_corrida AND CURRENT_TIMESTAMP < data_corrida + INTERVAL 5400 HOUR_SECOND";
$result = $db->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $query = ("UPDATE `ptrlbd`.`corrida` SET `estado_corrida` = 'decorrer' WHERE `corrida`.`id_corrida` = $row[id_corrida];");
        $db->query($query);
    }
}

//Verifica quais corridas agendadas ou a decorrer e passa o compo "estado_corrida" para "revisao"
$query = "SELECT id_corrida FROM corrida WHERE estado_corrida = 'agendada' AND CURRENT_TIMESTAMP > data_corrida + INTERVAL 5400 HOUR_SECOND OR estado_corrida = 'decorrer' AND CURRENT_TIMESTAMP > data_corrida + INTERVAL 5400 HOUR_SECOND;";
$result = $db->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $query = ("UPDATE `ptrlbd`.`corrida` SET `estado_corrida` = 'revisao' WHERE `corrida`.`id_corrida` = $row[id_corrida];");
        $db->query($query);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/csssite.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calendários</title>
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
            @media screen and (max-width: 700px) {

                #imginthefooter img:first-child {
                    margin-top: 1em;
                }
            }
        </style>
    </head>
    <body style="background-color:#1A0E22" onload="atualizarTabela()">
        <div style="background-color:#1E191F ; padding-bottom: 5em;">
            <div>
                <?php include("navbarfront.php"); ?>
                <div style="text-align: center; font-size:40px;">
                    <h1>Calendários</h1>
                    <div class="sub-title">
                        <a style="text-decoration:none" href="index.php">Home</a><i class="fa-solid fa-angles-right" style="font-size:20px;" ></i> <span>Calendários</span>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 2.2svw; margin-right: 4svw; margin-left: 4svw; margin-bottom: 2.2svw; background-color:#1A0E22;">
        <h1 style="font-size:50px; text-align:center; margin-bottom:0.2em;">Escolha uma Liga</h1>
        <div style="font-size:30px;  text-align:center;" class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Liga</label>
            <select style="font-size:30px; text-align:center; background-color:#1A0E22;" name="coluna7" class="form-select" id="inputGroupSelect01" onchange="atualizarTabela()">
<?php
            $query = "SELECT * FROM `divisao` WHERE id_divisao != 5;";
            $result = $db->query($query);

            if ($result->num_rows > 0) {
                // imprime todas as divisoes
                while ($row = $result->fetch_assoc()) {
                    echo ("<option value='$row[id_divisao]'> $row[nome_divisao] </option>");
                }
            }
?>
            </select>
        </div>
        <div style="overflow-x: auto;">
            <div id="tabela" style="margin-top:30px; font-size:23px; text-align: -webkit-center;"></div>
        </div> 
        </div>
        <?php include("footer.php"); ?>
        <?php include("script_nav.php"); ?>
        <script src="https://kit.fontawesome.com/a48f2f209c.js" crossorigin="anonymous"></script>
        <script>
            function atualizarTabela() {
                // Obter o valor selecionado no select
                var idDivisao = document.getElementById("inputGroupSelect01").value;

                // Criar uma solicitação AJAX
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Atualizar a tabela com os dados recebidos
                        document.getElementById("tabela").innerHTML = this.responseText;
                    }
                };
                xhr.open("GET", "get_table.php?idDivisao=" + idDivisao, true);
                xhr.send();
            }
        </script>
    </body>
</html>