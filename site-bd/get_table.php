<?php include('config.php'); 

// Verificar se o parâmetro idDivisao foi definido
if (isset($_GET["idDivisao"])) {
  $idDivisao = $_GET["idDivisao"];

  $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
  $result = $db->query($query);
  $row = $result->fetch_assoc();
  $idTemporada = $row['id_temporada'];

  // Consultar o banco de dados para obter os dados da tabela
  $query = "SELECT pista.nome_pista,data_corrida,estado_corrida FROM corrida INNER JOIN pista ON corrida.id_pista = pista.id_pista WHERE corrida.id_divisao = '$idDivisao' AND corrida.id_temporada = '$idTemporada' ORDER BY `corrida`.`data_corrida` ASC;";
  $result = $db->query($query);

  // Imprimir a tabela em formato HTML
  if ($result->num_rows > 0) {
      echo "<table class='table table-dark table-hover'>";
      echo "<tr>";
      echo"
      <td style='padding:10px;text-align: center;'>BANDEIRA</td>
      <td style='padding:10px;text-align: center;'>Nome</td>
      <td style='padding:10px;text-align: center;'>DATA</td>
      <td style='padding:10px;text-align: center;'>ESTADO</td>";
      echo "<tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo"<td style='padding:10px;'>";

        switch ($row['nome_pista']) {

            case "Bahrain International Circuit":
                echo '<img src="imagens\paises\bharein.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;

            case "Algarve International Circuit":
                echo '<img src="imagens\paises\portugal.webp" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
             
            case "Jeddah Corniche Circuit":
                echo '<img src="imagens\paises\jeddah.webp" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;

            case "Albert Park Circuit":
                echo '<img src="imagens\paises\australia.webp" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
    
            case "Imola Circuit":
                echo '<img src="imagens\paises\italia.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
             
            case "Miami International Autodrome":
                echo '<img src="imagens\paises\usa.webp" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
                 
            case "Circuit de Barcelona-Catalunya":
                echo '<img src="imagens\paises\espanha.webp" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
    
            case "Circuit de Monaco":
                echo '<img src="imagens\paises\monaco.webp" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
             
            case "Baku City Circuit":
                echo '<img src="imagens\paises\baku.webp" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
    
            case "Circuit Gilles Villeneuve":
                echo '<img src="imagens\paises\canada.webp" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
        
            case "Silverstone Circuit":
                echo '<img src="imagens\paises\inglaterra.svg" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
             
            case "Red Bull Ring":
                echo '<img src="imagens\paises\austria.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
                
            case "Circuit Paul Ricard":
                echo '<img src="imagens\paises\franca.webp" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
    
            case "Hungaroring":
                echo '<img src="imagens\paises\hungria.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
             
            case "Circuit de Spa-Francorchamps":
                echo '<img src="imagens\paises\belgica.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
    
            case "Circuit Sandvoort":
                echo '<img src="imagens\paises\holanda.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
        
            case "Monza Circuit":
                echo '<img src="imagens\paises\italia.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
             
            case "Marina Bay Street Circuit":
                echo '<img src="imagens\paises\usa.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
                 
            case "Suzuka International Racing Course":
                echo '<img src="imagens\paises\japao.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
        
            case "Circuit of the Americas":
                echo '<img src="imagens\paises\usa.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
             
            case "Autodromo Hermanos Rodriguez":
                echo '<img src="imagens\paises\mexico.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
        
            case "Interlagos Circuit":
                echo '<img src="imagens\paises\brazil.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
           
            case "Yas Marina Circuit":
                echo '<img src="imagens\paises\abudhabi.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;
             
            case "Shanghai International Circuit":
                echo '<img src="imagens\paises\china.png" style=" max-width:100px;margin-bottom:10px;" alt="">';
                break;    
          }
          echo"</td>";
          echo "<td style='padding:10px;'>" . $row['nome_pista'] . "</td>";
          echo "<td style='padding:10px;'>" . $row['data_corrida'] . "</td>";
          echo "<td style='padding:10px;'>" . $row['estado_corrida'] . "</td>";
          echo "</tr>";
      }
      echo "</table>";
  } else {
      echo "Nenhum resultado encontrado.";
  }
  // Fechar a conexão com o banco de dados
  $db->close();
}