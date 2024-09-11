<?php
include("session.php");

// Verifique se o formulário foi enviado
if (isset($_POST['coluna1']) && isset($_POST['coluna2'])) {
    $coluna1 = mysqli_real_escape_string($db, $_POST['coluna1']);
    $coluna2 = mysqli_real_escape_string($db, $_POST['coluna2']);

    // Atualize os dados da linha
    $query = "UPDATE temporada SET  nome_temporada = '$coluna2' WHERE id_temporada = $coluna1";
    mysqli_query($db, $query);

    // Volte para a página da tabela
    header('Location: VerTemporadas.php');
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
    </head>
    <body>
<?php 
        include("navbarback.php");
        
        // Verifique se o ID da linha foi enviado
        if (isset($_POST['id_temporada'])) {
            $id = mysqli_real_escape_string($db, $_POST['id_temporada']);

            // Selecione os dados da linha
            $query = "SELECT * FROM temporada WHERE id_temporada = $id";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($result);
        }
?> 
        <section class="home-section">
            <div class="home-content">
                <i class='bx bx-menu'></i>
                <span class="text"></span>
            </div>
            <div class="mx-auto w-50">
                <h1 style="text-align: center;">Alterar dados</h1>
                <form action="EditarTemporada.php" method="post">
                    <input type="hidden" class="form-control" name="coluna1" value="<?php echo $id; ?>" required>
                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">ID Temporada</span>
                        <input type="text" class="form-control"  value="<?php echo $row['id_temporada']; ?>" readonly>
                    </div>
                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">Nome Temporada</span>
                        <input type="text" class="form-control" name="coluna2" value="<?php echo $row['nome_temporada']; ?>" required>
                    </div>
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