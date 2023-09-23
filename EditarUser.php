<?php
include("session.php");

// Verifique se o formulário foi enviado
if (isset($_POST['coluna1']) && isset($_POST['coluna2']) && isset($_POST['coluna3']) && isset($_POST['coluna4']) && isset($_POST['coluna5']) && isset($_POST['coluna6']) && isset($_POST['coluna7']) && isset($_POST['coluna8']) && isset($_POST['coluna9'])) {
    
    $coluna1 = $_POST['coluna1'];
    $coluna2 = $_POST['coluna2'];
    $coluna3 = $_POST['coluna3'];
    $coluna4 = $_POST['coluna4'];
    $coluna5 = $_POST['coluna5'];
    $coluna6 = $_POST['coluna6'];
    $coluna7 = $_POST['coluna7'];
    $coluna8 = $_POST['coluna8'];
    $coluna9 = $_POST['coluna9'];

    // Atualize os dados da linha
    $query = "UPDATE users SET  Nome = '$coluna2', Sobrenome = '$coluna3' , Username = '$coluna4' , EmailUser = '$coluna5' , CargoUser = '$coluna6', DiscordUser = '$coluna7', DataNascimentoUser = '$coluna8' , GeneroUser = '$coluna9' WHERE IdUser = $coluna1";
    mysqli_query($db, $query);

    if($coluna6 == "Piloto"){

        //ao ser aceite , verifica se anteior mente já foi membro da liga e portanto o campo na tabela piloto ja existe , se for novo cria o campo , se não for só muda o estado de 0 para 1
        $sql = "SELECT id_piloto FROM `piloto` WHERE nome = '$coluna4';";
        $result = $db->query($sql);
        
        if ($result->num_rows == 0) {
            //cria o user na tabela piloto
            $sql = "INSERT INTO `piloto` (`id_piloto`, `nome`) VALUES (NULL,'$coluna4');";
            $db->query($sql);
            // vai buscar o id piloto que inseriu
            $sql = "SELECT id_piloto FROM piloto WHERE nome = '$coluna4';";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $idPiloto = $row['id_piloto'];
                // Segunda consulta para obter o ID da temporada com o maior valor
                $secondQuery = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
                $result = $db->query($secondQuery);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $idTemporada = $row['id_temporada'];
                    // Terceira consulta para inserir os valores na tabela pilotopontostemporada
                    $thirdQuery = "INSERT INTO `pilotopontostemporada` (`id_piloto`, `id_temporada`, `pontos`, `id_equipa`, `id_organizacao`, `id_divisao`) VALUES ('$idPiloto', '$idTemporada', '0', '22', '8', '5');";
                    $db->query($thirdQuery);
                } else {
                    echo "Nenhuma temporada encontrada.";
                }
            } else {
                echo "Piloto não encontrado.";
            }
        }else{
            $sql = "UPDATE `piloto` SET estado_piloto = '1' WHERE nome = '$coluna4';";
            $db->query($sql);
        }
    }

    if($coluna6 == "User"){

        $query = "SELECT id_piloto FROM `piloto` WHERE nome = '$coluna4';";
        $result = $db->query($query);
        
        if ($result->num_rows == 1) {
        
            $query = "UPDATE piloto SET `estado_piloto` = '0' WHERE `piloto`.`nome` = '$coluna4';";
            mysqli_query($db, $query);
        
            $query = "SELECT id_piloto FROM piloto WHERE nome = '$coluna4';";
            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $idPiloto = $row['id_piloto'];
        
            $query = "SELECT id_temporada FROM temporada ORDER BY id_temporada DESC LIMIT 1;";
            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $idTemporada = $row['id_temporada'];
        
            $query = "UPDATE `pilotopontostemporada` SET `id_equipa` = '22' , id_divisao = '5' , pontos = '0' WHERE `pilotopontostemporada`.`id_piloto` ='$idPiloto' AND `pilotopontostemporada`.`id_temporada` = '$idTemporada';";
            mysqli_query($db, $query);
        }
    }
    // Volte para a página da tabela
    header('Location: VerUsers.php');
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

        // Verifique se o ID da linha foi enviado
        if (isset($_POST['id'])) {
            $id = mysqli_real_escape_string($db, $_POST['id']);

            // Selecione os dados da linha
            $query = "SELECT * FROM users WHERE IdUser = $id";
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
                <form action="EditarUser.php" method="post">

                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">ID User</span>
                        <input type="text" class="form-control" name="coluna1" value="<?php echo $row['IdUser']; ?>" readonly>
                    </div>

                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">Primeiro e ultimo nome</span>
                        <input type="text" class="form-control" name="coluna2" value="<?php echo $row['Nome']; ?>" required>
                        <input type="text" class="form-control" name="coluna3" value="<?php echo $row['Sobrenome']; ?>" required>
                    </div>

                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">Username</span>
                        <input type="text" class="form-control" name="coluna4" value="<?php echo $row['Username']; ?>" required>
                    </div>

                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">Email</span>
                        <input type="text" class="form-control" name="coluna5" id="email" value="<?php echo $row['EmailUser']; ?>" onblur="verificarEmail(this)" required>
                        <div id="email-error" class="error-message"></div>
                    </div>

<?php
                    if ($row['CargoUser'] == "User") {
?>
                        <div style="margin-top: 20px;" class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Cargo</label>
                            <select name="coluna6" class="form-select" id="inputGroupSelect01">
                                <option selected value="User">User</option>
                                <option value="Piloto">Piloto</option>
                                <option value="Moderador">Moderador</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
<?php
                    } 

                    if ($row['CargoUser'] == "Piloto") {
?>
                        <div style="margin-top: 20px;" class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Cargo</label>
                            <select name="coluna6" class="form-select" id="inputGroupSelect01">
                                <option value="User">User</option>
                                <option selected value="Piloto">Piloto</option>
                                <option value="Moderador">Moderador</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
<?php
                    }

                    if ($row['CargoUser'] == "Moderador") {
?>
                        <div style="margin-top: 20px;" class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Cargo</label>
                            <select name="coluna6" class="form-select" id="inputGroupSelect01">
                                <option value="User">User</option>
                                <option value="Piloto">Piloto</option>
                                <option selected value="Moderador">Moderador</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
<?php
                    } 

                    if ($row['CargoUser'] == "Admin") {
?>
                        <div style="margin-top: 20px;" class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Cargo</label>
                            <select name="coluna6" class="form-select" id="inputGroupSelect01">
                                <option value="User">User</option>
                                <option value="Piloto">Piloto</option>
                                <option value="Moderador">Moderador</option>
                                <option selected value="Admin">Admin</option>
                            </select>
                        </div>
<?php
                    }
?>
                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">Discord</span>
                        <input type="text" class="form-control" readonly name="coluna7" value="<?php echo $row['DiscordUser']; ?>" required>
                    </div>

                    <div style="margin-top: 20px;" class="input-group">
                        <span class="input-group-text">Data Nascimento</span>
                        <input type="date" class="form-control" name="coluna8" value="<?php echo $row['DataNascimentoUser']; ?>" required>
                    </div>

<?php
                    if ($row['GeneroUser'] == "Masculino") {
?>
                        <div style="margin-top: 20px;" class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Genero</label>
                            <select name="coluna9" class="form-select" id="inputGroupSelect01">
                                <option selected value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Outros">Outros</option>
                                <option value="Prefiro não dizer">Prefiro não dizer</option>
                            </select>
                        </div>
<?php
                    } 
                
                    if ($row['GeneroUser'] == "Femenino") {
?>
                        <div style="margin-top: 20px;" class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Genero</label>
                            <select name="coluna9" class="form-select" id="inputGroupSelect01">
                                <option value="Masculino">Masculino</option>
                                <option selected value="Femenino">Femenino</option>
                                <option value="Outros">Outros</option>
                                <option value="Prefiro não dizer">Prefiro não dizer</option>
                            </select>
                        </div>
<?php 
                    } 

                    if ($row['GeneroUser'] == "Outros") {
?>
                        <div style="margin-top: 20px;" class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Genero</label>
                            <select name="coluna9" class="form-select" id="inputGroupSelect01">
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option selected value="Outros">Outros</option>
                                <option value="Prefiro não dizer">Prefiro não dizer</option>
                            </select>
                        </div>
<?php 
                    }

                    if ($row['GeneroUser'] == "Prefiro não dizer") {
?>
                        <div style="margin-top: 20px;" class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Genero</label>
                            <select name="coluna9" class="form-select" id="inputGroupSelect01">
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Outros">Outros</option>
                                <option selected value="Prefiro não dizer">Prefiro não dizer</option>
                            </select>
                        </div>
<?php 
                    }
?>
                    <div style="text-align: center; margin-top: 10px;">
                        <button id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </section>
        <script>
            function verificarEmail(emailInput) {
                
                var emailAntigo = "<?php echo $row['EmailUser']; ?>";
                var emailNovo = emailInput.value;

                // Verifique se o email foi alterado
                if (emailNovo !== emailAntigo) {
                    // Faça uma consulta à base de dados para verificar se o email já está em uso
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'verificar_email.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = () => {
                        if (xhr.status === 200) {
                            // Exiba uma mensagem se o email já estiver em uso
                            if (xhr.responseText === 'true') {
                                emailInput.parentElement.classList.add('input-error');
                                emailInput.parentElement.classList.add('error-message');
                                emailInput.nextElementSibling.innerHTML = 'Este email já está em uso!';
                                document.getElementById('btn-salvar').disabled = true;
                            } else {
                                emailInput.parentElement.classList.remove('input-error');
                                emailInput.parentElement.classList.remove('error-message');
                                emailInput.nextElementSibling.innerHTML = '';
                                document.getElementById('btn-salvar').disabled = false;
                            }
                        }
                    };
                    xhr.send(`email=${emailNovo}`);
                }
            }

            // Selecione a caixa de entrada de email
            const emailInput = document.getElementById('email');

            // Adicione um ouvinte de eventos à caixa de entrada de email
            emailInput.addEventListener('blur', () => {
                // Obtenha o valor da caixa de entrada de email
                const email = emailInput.value;
                verificarEmail(emailInput);
            });
        </script>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
<?php
mysqli_close($db);
?>