<?php include("session.php"); ?>
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
<body style="background-color: #e4e9f7;">
    <?php include("navbarback.php"); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"></span>
        </div>
        <div class="teste" style="text-align:center;">
        <h1>Alteração de pilotos da liga</h1>
        <p>Ter em atenção que o "Remover" remove o piloto automaticamente ao ser clicado , não espera pela ação do botão "Gravar", <br>isso só acontece quando tentamos inserir alguém na liga.</p>
<?php
        echo $_POST['id_divisao'];
        // Verifique se o ID da linha foi enviado
        if (isset($_POST["id_divisao"])) {

          $id_temporada = $_POST["id_temporada"];
          $id_divisao = $_POST["id_divisao"];
          $query = "SELECT p.id_piloto, piloto.nome FROM pilotopontostemporada p JOIN piloto ON p.id_piloto = piloto.id_piloto WHERE p.id_temporada = ". $id_temporada ." AND p.id_divisao = ". $id_divisao .";";

          // Executar a consulta
          $result = mysqli_query($db, $query);

          // Obter o número de pilotos retornados
          $num_pilotos = mysqli_num_rows($result);

          // Criar 20 caixas de texto ou selects
          for ($i = 1; $i <= 20; $i++) {
              echo '<div>';
              // Verificar se há um piloto correspondente para exibir
              if ($row = mysqli_fetch_assoc($result)) {
                  $id_piloto = $row["id_piloto"];
                  $nome = $row["nome"];
                  echo '<input type="hidden" name="id_piloto[]" value="'.$id_piloto.'" style="margin-top:3px;">';
                  echo '<input type="text" value="'.$nome.'" readonly>';
                  echo '<button class="btn-eliminar" data-id="'.$id_piloto.'" style="margin-top:3px;">Remover</button>';
              } else {
                  // Consulta para obter os pilotos com id_divisao = 5 (reservas)
                  $queryReservas = "SELECT pt.id_piloto, p.nome FROM pilotopontostemporada pt JOIN piloto p ON pt.id_piloto = p.id_piloto WHERE pt.id_divisao = 5 AND pt.id_piloto NOT IN (SELECT id_piloto FROM pilotopontostemporada WHERE id_temporada = " . $id_temporada . " AND id_divisao = " . $id_divisao . ");";
                  $resultReservas = mysqli_query($db, $queryReservas);

                  echo '<select class="select-piloto" name="piloto[]">';
                  echo '<option value="">Escolha um piloto reserva</option>';

                  // Exibir as opções dos pilotos reservas
                  while ($rowReservas = mysqli_fetch_assoc($resultReservas)) {
                      $id_piloto_reserva = $rowReservas["id_piloto"];
                      $nome_reserva = $rowReservas["nome"];
                      echo '<option value="'.$id_piloto_reserva.'">'.$nome_reserva.'</option>';
                  }

                  echo '</select>';
              }
              echo '</div>';
          }
        }
?>
  <button id="btnGravar"  class="btn btn-info" style="color:white;margin-top:10px;">Gravar</button>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
  var btnGravar = document.getElementById('btnGravar');
  btnGravar.addEventListener('click', function() {
    var selects = document.getElementsByClassName('select-piloto');
    var dadosSelecionados = [];
    var idDivisao = <?php echo $id_divisao; ?>; // Get the value of $id_divisao from PHP

    for (var i = 0; i < selects.length; i++) {
      var select = selects[i];
      var selectedOption = select.options[select.selectedIndex];
      var idPiloto = selectedOption.value;
      var nomePiloto = selectedOption.textContent;
      if (idPiloto !== '') {
        dadosSelecionados.push({
          id_piloto: idPiloto,
          nome: nomePiloto
        });
      }
    }

    // Add id_divisao to the data
    dadosSelecionados.forEach(function(dados) {
      dados.id_divisao = idDivisao;
    });

    // Enviar os dados via AJAX
    fetch('InserirPiloto.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(dadosSelecionados)
    })
    .then(response => response.json())
    .then(data => {
      location.reload();
      console.log(data); // Exibir resposta do servidor, se houver
    })
    .catch(error => {
      location.reload();
      console.error(error); // Lidar com erros, se ocorrerem
    });
  });
  });

</script>
<script>
    document.addEventListener('change', function(event) {
      var selectPiloto = event.target;
      if (!selectPiloto.classList.contains('select-piloto')) {
        return;
      }

      var selects = document.getElementsByClassName('select-piloto');
      var pilotosSelecionados = [];

      // Obter os pilotos selecionados em todos os selects
      for (var i = 0; i < selects.length; i++) {
        var select = selects[i];
        var selectedPiloto = select.value;
        if (selectedPiloto !== '' && !pilotosSelecionados.includes(selectedPiloto)) {
          pilotosSelecionados.push(selectedPiloto);
        }
      }

      // Atualizar as opções disponíveis em todos os selects
      for (var i = 0; i < selects.length; i++) {
        var select = selects[i];
        var options = select.getElementsByTagName('option');
        for (var j = 0; j < options.length; j++) {
          var option = options[j];
          var optionValue = option.value;
          if (optionValue !== '') {
            if (pilotosSelecionados.includes(optionValue)) {
              option.style.display = 'none';
            } else {
              option.style.display = 'block';
            }
          }
        }
      }
    });

    function atualizarSelects() {
      var selects = document.getElementsByClassName('select-piloto');
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'ObterPilotosReservas.php', true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var reservas = xhr.responseText;
          for (var i = 0; i < selects.length; i++) {
            var select = selects[i];
            select.innerHTML = '<option value="">Escolha um piloto reserva</option>' + reservas;
          }
        } else if (xhr.readyState === 4 && xhr.status !== 200) {
          console.error(xhr.responseText);
        }
      };
      xhr.send();
    }

    document.addEventListener('DOMContentLoaded', function() {
      atualizarSelects();
      document.addEventListener('click', function(event) {
        var target = event.target;
        if (!target.classList.contains('btn-eliminar')) {
          return;
        }

        var idPiloto = target.getAttribute('data-id');
        var eliminarButton = target;
        var divElement = eliminarButton.parentElement;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'RemoverPiloto.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);

            // Remova a caixa de texto existente e o botão "Eliminar"
            var inputText = divElement.querySelector('input[type="text"]');
            var selectElement = document.createElement('select');
            selectElement.className = 'select-piloto';
            selectElement.name = 'piloto';
            var optionElement = document.createElement('option');
            optionElement.value = '';
            optionElement.textContent = 'Escolha um piloto reserva';
            selectElement.appendChild(optionElement);
            divElement.replaceChild(selectElement, inputText);
            divElement.removeChild(eliminarButton);
                  // Atualize os selects após a remoção
        atualizarSelects();
      } else if (xhr.readyState === 4 && xhr.status !== 200) {
        console.error(xhr.responseText);
      }
    };
    xhr.send('id_piloto=' + encodeURIComponent(idPiloto));
  });
  });
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