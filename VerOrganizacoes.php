<?php
include("session.php");

$query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
$result = $db->query($query);
$row = $result->fetch_assoc();
$idTemporada = $row['id_temporada'];

$query = 'SELECT O.*, COUNT(DISTINCT P.id_piloto) AS numero_pilotos FROM organizacao O LEFT JOIN pilotopontostemporada P ON O.id_organizacao = P.id_organizacao AND P.id_temporada = '. $idTemporada .' GROUP BY O.id_organizacao;';
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
    </head>
<body>
    <?php include("navbarback.php"); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"></span>
        </div>
        <div class="teste">
            <!-- Cabeçalho da tabela -->
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>idOrganização</th>
                        <th>Nome</th>
                        <th>Nº Pilotos</th>
                    </tr>
                </thead>
<?php
                // Corpo da tabela
                echo '<tbody>';
          
                // Execute a consulta atualizada
                $result = mysqli_query($db, $query);

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id_organizacao'] . '</td>';
                    echo '<td>' . $row['nome_organizacao'] . '</td>';
                    echo '<td>' . $row['numero_pilotos'] . '</td>';
                    echo '<td>';
                    echo '<div class="btn-group">';
                    echo '
                        <form style="margin-right:5px" action="EditarOrganizacao.php" method="post">
                            <input type="hidden" name="id_organizacao" value="' . $row['id_organizacao'] . '">
                            <button type="submit" class="btn btn-info" style="color: white";>Editar</button>
                        </form>';
                    echo '
                        <form action="EliminarOrganizacao.php" method="post">   
                            <button type="button" onclick="GetId(\'' . $row['id_organizacao'] . '\')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Apagar</button>
                        </form>';
                    echo '</div>';
                }
                echo '</tbody>';

                // Fim da tabela
                echo '</table>';
?>
                <!-- Paginação -->
                
        </div>
    </section>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">apagar Piloto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Tem a certeza que deseja apagar esta organização?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="TirarTagPiloto.php" method="post">
                        <input type="hidden" class="delete" name="id" value="">
                        <button type="submit" class="btn btn-danger">apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function GetId(id) {
            document.querySelector(".delete").value = id;
        }
    </script>
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