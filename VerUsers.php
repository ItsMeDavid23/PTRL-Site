<?php
include("session.php");
// Verifique se houve um pedido de pesquisa
if (isset($_POST['pesquisa'])) {
    $pesquisa = mysqli_real_escape_string($db, $_POST['pesquisa']);
    $query = "SELECT * FROM users WHERE IdUser LIKE '%$pesquisa%' OR Nome LIKE '%$pesquisa%' OR Sobrenome LIKE '%$pesquisa%' OR Username LIKE '%$pesquisa%' OR EmailUser LIKE '%$pesquisa%' OR CargoUser LIKE '%$pesquisa%' OR DiscordUser LIKE '%$pesquisa%' ";
} else {
    $query = 'SELECT * FROM users';
}
$result = mysqli_query($db, $query);
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
            <!-- Formulário de pesquisa -->
            <div class="linha">
                <div>
                    <form action="" method="post">
                        <input class="form-control mr-sm-2 pesquisar" type="search" name="pesquisa" placeholder="Pesquisar" aria-label="Pesquisar">
                </div>
                <div>
                    <button class="btn btn-success" type="submit">Pesquisar</button>
                    </form>
                </div>
            </div>
            <!-- Cabeçalho da tabela -->
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>IdUser</th>
                        <th>Username</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Cargo</th>
                        <th>Discord</th>
                        <th>Ação</th>
                    </tr>
                </thead>
<?php
                // Corpo da tabela
                echo '<tbody>';
                
                // Obtenha o número total de registros na tabela
                $totalRecords = mysqli_num_rows(mysqli_query($db, "SELECT * FROM users"));
                
                // Número de registros por página
                $recordsPerPage = 10;
                
                // Número total de páginas
                $totalPages = ceil($totalRecords / $recordsPerPage);
                
                // Verifique se a página atual é especificada na consulta de URL, caso contrário, defina-a como 1
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                
                // Calcule o deslocamento para consulta SQL
                $offset = ($currentPage - 1) * $recordsPerPage;
                
                // Adicione a cláusula LIMIT à consulta existente
                $query .= " LIMIT $offset, $recordsPerPage";
                
                // Execute a consulta atualizada
                $result = mysqli_query($db, $query);

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['IdUser'] . '</td>';
                    echo '<td>' . $row['Username'] . '</td>';
                    echo '<td>' . $row['Nome'] . '</td>';
                    echo '<td>' . $row['Sobrenome'] . '</td>';
                    echo '<td>' . $row['EmailUser'] . '</td>';
                    echo '<td>' . $row['CargoUser'] . '</td>';
                    echo '<td>' . $row['DiscordUser'] . '</td>';
                    echo '<td>';
                    echo '<div class="btn-group">';
                    echo '
                <form style="margin-right:5px" action="EditarUser.php" method="post">
                  <input type="hidden" name="id" value="' . $row['IdUser'] . '">
                 <button type="submit" class="btn btn-info" style="color: white";>Editar</button>
                </form>';
                    echo '
                    <form action="DeleteUser.php" method="post">   
                        <button type="button" onclick="GetId(' . $row['IdUser'] . ')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Apagar</button>
                    </form>';
                    echo '</div>';
                }
                echo '</tbody>';

                // Fim da tabela
                echo '</table>';
?>
                <!-- Paginação -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <!-- Setas para a primeira página e página anterior -->
                        <?php if ($currentPage > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1" aria-label="Primeira página">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Página anterior">
                                    <span aria-hidden="true">&lt;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Links de páginação -->
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo ($currentPage == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Setas para a próxima página e última página -->
                        <?php if ($currentPage < $totalPages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Próxima página">
                                    <span aria-hidden="true">&gt;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $totalPages; ?>" aria-label="Última página">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
        </div>
    </section>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Excluir Utilizador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir este utilizador?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="DeleteUser.php" method="post">
                        <input type="hidden" class="delete" name="id" value="">
                        <button type="submit" class="btn btn-danger">Excluir</button>
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