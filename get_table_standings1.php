<?php include('config.php'); 

// Verificar se o parâmetro idDivisao foi definido
if (isset($_GET["idDivisao"])) {
  $idDivisao = $_GET["idDivisao"];

  $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
  $result = $db->query($query);
  $row = $result->fetch_assoc();
  $idTemporada = $row['id_temporada'];

  // Consulta a bd para obter os dados da tabela
  $query = "SELECT p.nome AS nome_piloto, o.nome_organizacao, e.nome_equipa, ppt.pontos FROM pilotopontostemporada ppt INNER JOIN piloto p ON ppt.id_piloto = p.id_piloto LEFT JOIN equipa e ON ppt.id_equipa = e.id_equipa LEFT JOIN organizacao o ON ppt.id_organizacao = o.id_organizacao WHERE id_divisao = $idDivisao AND id_temporada = $idTemporada;";
  $result = $db->query($query);

  // Imprimir a tabela em formato HTML
  if ($result->num_rows > 0) {
?> 
        <table class="constructor-results" style="width:75%; margin-left:auto; margin-right:auto; border-spacing: 0 1em; ">
            <tbody>
                <tr>
                    <th></th>
                    <th> <h2 class="points-header">Equipa</h2></th>
                <th>
                <h2 class="points-header">Pontos</h2></th>
            </tr>					
<?php
        $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $idTemporada = $row['id_temporada'];

        $query = "SELECT e.nome_equipa, SUM(ppt.pontos) AS pontos FROM pilotopontostemporada ppt LEFT JOIN equipa e ON ppt.id_equipa = e.id_equipa WHERE ppt.id_temporada = $idTemporada AND id_divisao = $idDivisao GROUP BY ppt.id_equipa ORDER BY pontos DESC;";
            $posicao = 1; 
            if ($result = $db->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $field5name = $row["nome_equipa"];
                    $field6name = $row["pontos"];

                    switch ($field5name) {
                        case "Mercedes":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #00D2BE;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#00D2BE;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#00D2BE;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;
                        
                        case "Red Bull Racing":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #1510fc;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#1510fc;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#1510fc;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;
                        
                        case "Ferrari":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #DC0000;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#DC0000;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#DC0000;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;
                        
                        case "Alpine":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #2293D1;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#2293D1;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#2293D1;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;
                        
                        case "McLaren":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #FF8700;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#FF8700;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#FF8700;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;
                        
                        case "Alfa Romeo":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #C92D4B;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#C92D4B;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#C92D4B;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;
                        
                        case "Aston Martin":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #006f62;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#006f62;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#006f62;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;
                        
                        case "Hass F1 Team":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #949498;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#949498;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#949498;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;    

                        case "AlphaTauri":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #5E8FAA;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#5E8FAA;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#5E8FAA;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;
                        
                        case "Williams":
?>
                            <tr>
                                <td style="width: 57px;margin-bottom:7px!important;background-color: #37BEDD;">
                                    <h2 class="team-position"><?php echo $posicao; $posicao=$posicao+1;?></h2>
                                </td>
                                <td style="text-align:center;margin-bottom:7px!important;background-color:#37BEDD;">
                                    <div>
                                        <div>
                                            <h2 class="team-names" style="color:#000000; text-transform: uppercase;"><?php echo $field5name; ?></h2>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:#000000;background-color:#37BEDD;">
                                    <h2 class="constructor-points" style="padding-top:3px;"><?php echo $field6name; ?></h2>
                                </td>
                            </tr>
<?php
                        break;  
                        }
                    }
                } 
?>
            </tbody>
        </table>
<?php
  } else {
      echo "Nenhum resultado encontrado.";
  }

  // Fechar a conexão com o banco de dados
  $db->close();
}