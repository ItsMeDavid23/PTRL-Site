<?php
include("session.php");

$query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
$result = $db->query($query);
$row = $result->fetch_assoc();
$idTemporada = $row['id_temporada'];

// Verifique se o ID da linha foi enviado
if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
} 

// Verifique se o formulário foi enviado
if (isset($_POST['coluna1']) && isset($_POST['coluna3'])) {

    //ve se a pessoa fazia parte de uma liga para poder alterar a equipa ou não
    if(isset($_POST['coluna2'])){

        $coluna1 = mysqli_real_escape_string($db, $_POST['coluna1']);
        $coluna2 = mysqli_real_escape_string($db, $_POST['coluna2']);
        $coluna3 = mysqli_real_escape_string($db, $_POST['coluna3']);

        // Atualize os dados da linha
        $query = "UPDATE pilotopontostemporada SET id_equipa = '$coluna2', id_organizacao = '$coluna3'  WHERE id_piloto = $coluna1 AND id_temporada = $idTemporada";
        mysqli_query($db, $query);

    }else{

        $coluna1 = mysqli_real_escape_string($db, $_POST['coluna1']);
        $coluna3 = mysqli_real_escape_string($db, $_POST['coluna3']);

        // Atualize os dados da linha
        $query = "UPDATE pilotopontostemporada SET  id_organizacao = '$coluna3'  WHERE id_piloto = $coluna1 AND id_temporada = $idTemporada";
        mysqli_query($db, $query);

    }
    // Volte para a página da tabela
    header('Location: VerPilotos.php');
}
?>
<html lang="en" dir="ltr">
    <head>
        <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .error-message {
                color: red;
                font-size: 12px;
                margin-top: 4px;
            }

            .input-error {
                border: 1px solid red;
            }
        </style>
    </head>
    <body>
<?php 
        include("navbarback.php"); 
        
        // Selecione os dados da linha
        $query = "SELECT ppt.id_piloto, p.nome AS nome_piloto, ppt.id_equipa, e.nome_equipa, ppt.id_organizacao, o.nome_organizacao, ppt.id_divisao, d.nome_divisao FROM pilotopontostemporada ppt LEFT JOIN piloto p ON p.id_piloto = ppt.id_piloto LEFT JOIN equipa e ON e.id_equipa = ppt.id_equipa LEFT JOIN organizacao o ON o.id_organizacao = ppt.id_organizacao LEFT JOIN divisao d ON d.id_divisao = ppt.id_divisao WHERE p.id_piloto = $id AND id_temporada = $idTemporada";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);

        $EquipaSelected = $row['id_equipa'];
        $OrganizacaoSelected = $row['id_organizacao'];  
        $DivisaoSelected = $row['id_divisao'];
?>
        <section class="home-section">
            <div class="home-content">
                <i class='bx bx-menu'></i>
                <span class="text"></span>
            </div>
            <div class="mx-auto w-50">
                <h1 style="text-align: center;">Alterar dados</h1>
                <form action="EditarPiloto.php" method="post">

                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">IdPiloto</span>
                        <input type="text" class="form-control" name="coluna1" value="<?php echo $row['id_piloto']; ?>" readonly>
                    </div>
                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">Nickname</span>
                        <input type="text" class="form-control" value="<?php echo $row['nome_piloto']; ?>" readonly>
                    </div>
<?php 
                    if($DivisaoSelected != 5){

                        $query = "SELECT * FROM equipa WHERE id_equipa = $EquipaSelected OR (id_equipa NOT IN (SELECT id_equipa FROM pilotopontostemporada WHERE id_divisao = $DivisaoSelected AND id_temporada = $idTemporada GROUP BY id_equipa HAVING COUNT(*) > 1)OR id_equipa = 22);";
                        $result = $db->query($query);

                        // Verifica se a consulta retornou resultados
                        if ($result->num_rows > 0) {
                            echo '<div style="margin-top: 20px;" class="input-group mb-3">';
                            echo '<span class="input-group-text">Equipa</span>';
                            echo '<select class="form-select" name="coluna2" required>';
                            // Itera sobre os resultados e gera as opções
                            while ($row = $result->fetch_assoc()) {
                                $idEquipa = $row['id_equipa'];
                                $nomeEquipa = $row['nome_equipa'];
                                
                                if($EquipaSelected == $idEquipa){
                                    echo '<option selected value="' . $idEquipa . '">' . $nomeEquipa . '</option>';    
                                }else{
                                    echo '<option value="' . $idEquipa . '">' . $nomeEquipa . '</option>';
                                }
                            }
                            echo '</select>';
                            echo '</div>';
                        }
                    }

                    $query = "SELECT * FROM organizacao;";
                    $result = $db->query($query);

                    // Verifica se a consulta retornou resultados
                    if ($result->num_rows > 0) {
                        echo '<div style="margin-top: 20px;" class="input-group mb-3">';
                        echo '<span class="input-group-text">Organização</span>';
                        echo '<select class="form-select" name="coluna3" required>';
                        // Itera sobre os resultados e gera as opções
                        while ($row = $result->fetch_assoc()) {
                            $idOrganizacao = $row['id_organizacao'];
                            $nomeOrganizacao = $row['nome_organizacao'];

                            if($OrganizacaoSelected == $idOrganizacao){
                                echo '<option selected value="' . $idOrganizacao . '">' . $nomeOrganizacao . '</option>';    
                            }else{
                                echo '<option value="' . $idOrganizacao . '">' . $nomeOrganizacao . '</option>';
                            }
                        }
                        echo '</select>';
                        echo '</div>';
                    }
?>
                    <div style="text-align: center; margin-top: 10px;">
                        <button id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>
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