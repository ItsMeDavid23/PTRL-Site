<?php include('config.php'); 

// Verificar se o parâmetro idDivisao foi definido
if (isset($_GET["idDivisao"])) {

    $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $idTemporada = $row['id_temporada'];

    // Consultar o banco de dados para obter os dados da tabela  
    $idDivisao = $_GET["idDivisao"];
    $query = "SELECT p.nome AS nome_piloto, o.nome_organizacao, e.nome_equipa, ppt.pontos FROM pilotopontostemporada ppt INNER JOIN piloto p ON ppt.id_piloto = p.id_piloto LEFT JOIN equipa e ON ppt.id_equipa = e.id_equipa LEFT JOIN organizacao o ON ppt.id_organizacao = o.id_organizacao WHERE id_divisao = $idDivisao AND id_temporada = $idTemporada ORDER BY `ppt`.`pontos` DESC; ";
    $result = $db->query($query);

  // Imprimir a tabela em formato HTML
  if ($result->num_rows > 0) {
?> 
            <table class="table table-dark table-hover">
                <tr style="font-size: 25px;">
                    <td></td>
                    <td style="text-align: center;">Username</td>
                    <td style="text-align: center;">Organização</td>
                    <td style="text-align: center;">Equipa</td>
                    <td style="text-align: center;">Pontos</td>
                </tr>
<?php
                if ($result = $db->query($query)) {
                    $posicao = 1;
                    while ($row = $result->fetch_assoc()) {
                        $field1name = $row["nome_piloto"];
                        $field2name = $row["nome_equipa"];
                        $field3name = $row["nome_organizacao"];
                        $field4name = $row["pontos"];
?>
                        <tr style="vertical-align: middle;">
                            <td style=" text-align: center; font-size: 23;">
<?php
                                echo ($posicao);
                                $posicao = $posicao + 1;
?>
                            </td>
                            <td style=" text-align: center; font-size: 23;">
                                <?php echo ($field1name); ?>
                            </td>
                            <td style=" text-align: center;  font-size: 23" >
<?php
                            switch ($field3name) {
                                case "Lights Out SimRacing":
                                    echo ("<img src='imagens\LightsOut_SimRacing-01.webp' height='43px'>");
                                break;
                                
                                case "For The Win":
                                    echo ("<img src='imagens/ftw.webp' style='margin-right:5px;' height='35px'>");
                                break;
                                }
                                if ($field3name != "Nenhuma") {
                                    echo ($field3name);
                                }
?>
                            </td>
                            <td style=" text-align: center;  font-size: 23;">
<?php
                            switch ($field2name) {
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
                                if ($field2name != "Nenhuma") {
                                    echo ($field2name);
                                }                             
?>
                            </td>
                            <td style=" text-align: center;  font-size: 26;">
                                <?php echo ($field4name); ?>
                            </td>
                        </tr>
<?php
                    }
                    $result->free();
                }
?>
            </table>
<?php
  } else {
      echo "Nenhum resultado encontrado.";
  }
  // Fechar a conexão com o banco de dados
  $db->close();
}