<?php
include("session.php");

if (isset($_POST["corrida_id"]) && isset($_POST["Num_Pilotos"])  && isset($_POST['VoltaRapidaRadio'])) {

    //Recebe todos os POSTs
    $VoltaRapidaRadio = $_POST['VoltaRapidaRadio'];
    $corrida_id = $_POST["corrida_id"];
    $Nu_Pilotos =  $_POST["Num_Pilotos"];

    //cria todas as variaveis dinamicas e recebe os posts
    for ($i = 0; $i < $_POST["NumPilotos"]; $i++) {
        $NomeVar = "P" . ($i + 1);
        ${$NomeVar} = $_POST[$NomeVar];
    }

    //Verifica se todos os lugares foram preenchidos
    $VarVazia = 0;
    $i = 1;
    do {
        if (${"P" . ($i)} == "") {
            echo "P" . $i . " Não tem valor";
            $VarVazia = 1;
        }
        $i++;
    } while ($i <= $Nu_Pilotos && $VarVazia == 0);
    if ($VarVazia == 0) {

        //Monta a query para inserir os resultados
        $query = "INSERT INTO `resultado` ( `id_corrida`, `id_piloto`, `posicao`, `volta_mais_rapida`) VALUES";
        for ($i = 1; $i <= $Nu_Pilotos; $i++) {

            if ($VoltaRapidaRadio == "P" . ($i)) {
                $query .= "( '$corrida_id' , '" . ${'P' . ($i)} . "', '$i', '1'),";
            } else {
                $query .= "( '$corrida_id' , '" . ${'P' . ($i)} . "', '$i', '0'),";
            }
        }
        $query[strlen($query) - 1] = ";";
        mysqli_query($db, $query);

        //Inserção dos pontos
        $querypontos = $db->query("SELECT id_piloto FROM `resultado` WHERE `id_corrida` = $corrida_id AND `Estado_Resultado` = 'Terminou' ORDER BY `resultado`.`posicao` ASC LIMIT 10");
        $resulta = $querypontos->fetch_all();
        if (!$querypontos) {
            // Output the MySQL error
            echo "Error: " . $db->error;
        } else {
            if ($querypontos->num_rows > 0) {
                            
            //vai buscar o id_temporada e id_divisao da corrida
            $query = "SELECT id_temporada, id_divisao FROM corrida WHERE id_corrida = '$corrida_id'; ";
            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $id_temporada = $row['id_temporada'];
            $id_divisao = $row['id_divisao'];

            //monta a query  para inserir os pontos na bd
            $querypontos = "UPDATE `ptrlbd`.`pilotopontostemporada` SET `pontos` = CASE ";

            for ($i = 1; $i <= 10 && $i <= $Nu_Pilotos; $i++) {
                switch ($i) {
                    case 1:
                        $pontos = 25;
                        break;
                    case 2:
                        $pontos = 18;
                        break;
                    case 3:
                        $pontos = 15;
                        break;
                    case 4:
                        $pontos = 12;
                        break;
                    case 5:
                        $pontos = 10;
                        break;
                    case 6:
                        $pontos = 8;
                        break;
                    case 7:
                        $pontos = 6;
                        break;
                    case 8:
                        $pontos = 4;
                        break;
                    case 9:
                        $pontos = 2;
                        break;
                    case 10:
                        $pontos = 1;
                        break;
                }
                $querypontos .= "WHEN `id_piloto` = " . $resulta[$i - 1][0] . " THEN `pontos` + $pontos ";
            }
            $querypontos .= "ELSE `pontos` END WHERE `id_temporada` = $id_temporada AND `id_divisao` = $id_divisao;";
            mysqli_query($db, $querypontos);

            //vai buscar o id do piloto com volta rapida
            $queryvoltarapida = "SELECT id_piloto FROM `resultado` WHERE posicao <= 10 AND volta_mais_rapida = 1 AND Estado_Resultado = 'Terminou' AND id_corrida = $corrida_id;";
            $result = $db->query($queryvoltarapida);
            $row = $result->fetch_assoc();

            //atribui os pontos ao piloto com volta rapida
            $querypontosvoltarapida = "UPDATE pilotopontostemporada SET `pontos` = `pontos` + 1 WHERE `id_piloto` = " . $row['id_piloto'] . "  AND  `id_temporada` = $id_temporada ;";
            $db->query($querypontosvoltarapida);         
            
            //Da a corrida como concluida
            $query = "UPDATE `ptrlbd`.`corrida` SET `estado_corrida` = 'concluida' WHERE `corrida`.`id_corrida` = $corrida_id;";
            mysqli_query($db, $query);
            }
        }
        header('Location: admin.php');
    } else {
        echo "ERRO , não foram inseridos todos os pilotos;";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
    <title>Inserir Resultados</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include("navbarback.php"); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"></span>
        </div>
        <!--Inserção dos resultados da corrida-->
        <h1 style="text-align: center;">Inserir Corrida</h1>
        <form action="InserirResultados.php" method="post">

            <input type="hidden" name="corrida_id" value="<?php echo ($_POST['corrida_id']); ?>">
            <div class="mx-auto w-50">
<?php   
                if(isset($_POST['corrida_id'])){
                    $id_corrida  = $_POST['corrida_id'];
                }
                $query = "SELECT id_divisao FROM corrida WHERE id_corrida = $id_corrida ;";
                $result = $db->query($query);
                $row = $result->fetch_assoc();
                $idDivisao = $row['id_divisao'];

                $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
                $result = $db->query($query);
                $row = $result->fetch_assoc();
                $idTemporada = $row['id_temporada'];

                // Vai buscar os Pilotos daquela corrida
                $query = $db->query("SELECT piloto.nome, pilotopontostemporada.id_piloto FROM piloto INNER JOIN pilotopontostemporada ON piloto.id_piloto = pilotopontostemporada.id_piloto WHERE pilotopontostemporada.id_divisao = $idDivisao and pilotopontostemporada.id_temporada = $idTemporada;");
                $result = $query->fetch_all();
                $numPilotos = count($result);

                for ($i = 0; $i < $numPilotos; $i++) {
                    $varName = "pilotoP" . ($i + 1); // Cria o nome da variável dinâmica
                    ${$varName} = $result[$i][0]; // Atribui o valor da bd à variável dinâmica
                    $varidname = "pilotoP" . ($i + 1) . "id";
                    ${$varidname} = $result[$i][1];
                }

                echo ('<input type="hidden" name="NumPilotos" value="' . $numPilotos . '">');

                for ($i = 1; $i <= $numPilotos; $i++) {
                    echo ('
                    <div style="margin-top: 20px;" class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">P' . $i . '</label>
                        <select name="P' . $i . '" class="form-select" >
                            <option selected></option>');
                    //Escreve as variaves dinamicas com todos os nomes dos pilotos        
                    for ($ii = 1; $ii < $numPilotos + 1; $ii++) { ?>
                        <option value="<?php echo (${"pilotoP" . ($ii) . "id"}); ?>"><?php echo (${"pilotoP" . ($ii)}); ?></option>
<?php               }
                    echo ('</select>
                        <select name="EstadoPilotoP' . $i . '" class="form-select">
                            <option selected value="Masculino">Acabou a Corrida</option>
                            <option value="Femenino">Não terminou </option>
                            <option value="Outros">Desqualificado</option>
                            <option value="Outros">Faltou</option>
                        </select>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="VoltaRapidaRadio" value="P' . $i . '" id="VoltaRapidaRadio">
                            <label class="form-check-label" for="VoltaRapidaRadio">
                                Volta Rápida
                            </label>
                        </div>
                    ');
                }
?>
            </div>
            <input type="hidden" name="Num_Pilotos" value="<?php echo ($numPilotos); ?>">
            <div style="text-align: center; margin-top: 10px;">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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
    </script>
</body>
</html>
<?php
mysqli_close($db);
?>