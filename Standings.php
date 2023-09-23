<?php include('session.php'); ?>
<!DOCTYPE html>
<html>
<head> 
    <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/csssite.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Standings</title>
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
                <h1>Standings</h1>
                <div class="sub-title">
                    <a style="text-decoration:none; color:white;" href="index.php">Home</a><i class="fa-solid fa-angles-right" style="font-size:20px;"></i><span>Standings</span>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 2.2svw; margin-right: 4svw; margin-left: 4svw; margin-bottom: 2.2svw;">
        <h1 style="font-size:50px; margin-bottom:0.3em;margin-bottom:0.2em;text-align:center;">Escolha uma Liga</h1>
        <div class="input-group mb-3">
            <label style="margin-left:auto;font-size: 26px;" class="input-group-text" for="inputGroupSelect01">Liga</label>
            <select style="margin-right:auto;font-size:30px;background-color:#1a0e22;text-align:center;color:white;text-transform:uppercase;max-width:250px;" name="coluna7" class="form-select" id="inputGroupSelect01" onchange="atualizarTabela()">                        
<?php
            $query = ("SELECT * FROM `divisao` WHERE id_divisao != 5;");
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
        <h1 style="text-align: center; margin-top:0.6em;">Championship</h1>              
        <div style="overflow-x: auto;"> 
            <div id="tabela" style="margin-top:10px; font-size:23px; text-align: -webkit-center;"></div>
        </div>
        <h1 style="margin-top:0.6em; text-align:center;">Construtores</h1>                
        <div id="tabela1" style="font-size:23px; text-align: -webkit-center;"></div>
    </div>
    <?php include("footer.php"); ?>
    <?php include("script_nav.php"); ?>
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
            xhr.open("GET", "get_table_standings.php?idDivisao=" + idDivisao, true);
            xhr.send();

            // Criar uma solicitação AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Atualizar a tabela com os dados recebidos
                    document.getElementById("tabela1").innerHTML = this.responseText;
                }
            };
            xhr.open("GET", "get_table_standings1.php?idDivisao=" + idDivisao, true);
            xhr.send();
        }
    </script>
    <script src="https://kit.fontawesome.com/a48f2f209c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>