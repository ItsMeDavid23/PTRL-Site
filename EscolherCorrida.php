<?php
include("session.php");

//Verifica quais corridas estão a decorrer e passa o compo "estado_corrida" para "decorrer"
$query = ("SELECT id_corrida FROM corrida WHERE estado_corrida = 'agendada' AND CURRENT_TIMESTAMP > data_corrida AND CURRENT_TIMESTAMP < data_corrida + INTERVAL 5400 HOUR_SECOND");
$result = $db->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $query = ("UPDATE `ptrlbd`.`corrida` SET `estado_corrida` = 'decorrer' WHERE `corrida`.`id_corrida` = $row[id_corrida];");
        $db->query($query);
    }
}

//Verifica quais corridas agendadas ou a decorrer e passa o compo "estado_corrida" para "revisao"
$query = ("SELECT id_corrida FROM corrida WHERE estado_corrida = 'agendada' AND CURRENT_TIMESTAMP > data_corrida + INTERVAL 5400 HOUR_SECOND OR estado_corrida = 'decorrer' AND CURRENT_TIMESTAMP > data_corrida + INTERVAL 5400 HOUR_SECOND;");
$result = $db->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $query = ("UPDATE `ptrlbd`.`corrida` SET `estado_corrida` = 'revisao' WHERE `corrida`.`id_corrida` = $row[id_corrida];");
        $db->query($query);
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
        <title>Escolher Corrida</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="./css/all.min.css">
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
<?php 
            $row = $db->query("SELECT id_corrida FROM corrida WHERE estado_corrida = 'revisao'");
            $result = $row->fetch_all();
            $count = $row->num_rows;
            if($count == 0)
            {
?>
            <h1 style="text-align: center;">Selecione a corrida</h1>
            <h4 style="text-align: center; margin: bottom 100px;">Todos os resultados necessários já foram inseridos.</h4>
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
}else{
?>
    <h1 style="text-align: center;">Selecione a corrida</h1>
        <h4 style="text-align: center; margin: bottom 100px;">Primeiro precisa de escolher de que corrida pretende inserir os resultados</h4>

        <!--Inserção dos resultados da corrida-->
        <form action="InserirResultados.php" method="post">
<?php
            //Select de todas as corridas em "Revisão"
            $query = ("SELECT id_corrida,id_divisao,pista.nome_pista,data_corrida FROM corrida INNER JOIN pista ON corrida.id_pista = pista.id_pista WHERE estado_corrida = 'revisao';");
            $result = $db->query($query);

            echo ('<select style="display:block; margin-inline: auto;" name="corrida_id">');
            if ($result->num_rows > 0) {
                // imprime os dados de cada corrida
                while ($row = $result->fetch_assoc()) {
                    echo ("<option value='$row[id_corrida]'>Divisão: $row[id_divisao] - Nome:$row[nome_pista] - Data:$row[data_corrida]</option>");
                }
            }
            echo ('</select>');
?>
            <div style="text-align: center; margin-top: 10px;">
                <button type="submit" class="btn btn-primary">Selecionar</button>
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
}
mysqli_close($db);
?>