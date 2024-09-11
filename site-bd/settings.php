<?php
include("session.php");

if ($CargoUser == "Admin" ||  $CargoUser == "Moderador") {

?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
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
                <div>
                    <h1 style="text-align: center; margin-bottom:80px">Settings</h1>
                </div>
                <div>
                    <div>
                        <h3>Deseja eliminar a sua conta ?</h3>
                        <p>Para encerrar a sua conta de forma <b>permanente</b> no site basta clicar neste botão e confirmar a sua decisão , esta ação é <b>ireversivel</b>.</p>
                    </div>
                    <form style="text-align: center;  " action="DeleteConta.php" method="post">
                        <input type="hidden" name="id" value="<?php echo ($IdUser); ?>">
                        <button type="submit" class="btn btn-danger">Apagar</button>
                    </form>
                </div>
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
            console.log(sidebarBtn);
            sidebarBtn.addEventListener("click", () => {
                sidebar.classList.toggle("close");
            });
        </script>
    </body>
</html>
<?php
}
?>