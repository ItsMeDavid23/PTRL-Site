<?php
include('session.php');

if ($CargoUser == 'Moderador' || $CargoUser == 'Admin') {

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

    $sql = "SELECT DATE(access_time) AS access_date, COUNT(DISTINCT id_user) AS total_users 
    FROM access_logs 
    WHERE access_time >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
    GROUP BY DATE(access_time)";

    $result = $db->query($sql);

    $dates = [];
    $averages = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dates[] = $row['access_date'];
            $averages[] = $row['total_users'];
        }
    }
?>
    <html lang="en" dir="ltr">

    <head>
        <!-- Map CSS -->
        <link type="text/css" rel="stylesheet" href="css\jquery-jvectormap-2.0.2.css">

        <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <title>Dashboard</title>
    </head>

    <body style="background-color: #e4e9f7;" onload="updateChart('month')">
        <?php include("navbarback.php"); ?>
        <section class="home-section">
            <div class="home-content">
                <i class='bx bx-menu'></i>
                <span class="text"></span>
                <div style="display: flex; margin-right:auto;margin-left:auto;">
                    <div style="text-align: center;">
                        <select id="timeRangeSelect" class="form-control" style="max-width: 150px;text-align:center;">
                            <option value="week">Última Semana</option>
                            <option selected value="month">Último Mês</option>
                        </select>
                    </div>
                    <button class="btn btn-success" onclick="exportToExcel()">Exportar Excel</button>
                </div>
            </div>
            <div>
                <canvas class="my-4 w-100" id="dailyAverageChart" style="max-height:50%;max-width:50%;margin-right:auto;margin-left:auto;"></canvas>
                <p style="text-align:center;margin-top:10px;margin-bottom:0px;">Nº de Utilizadores mensais por País.</p>
                <div id="world-map" style="height: 350px;background-color:#999999;max-height:40%;max-width:50%;margin-right:auto;margin-left:auto;"></div>
            </div>
        </section>
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/plugins/jqvmap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="assets/plugins/jqvmap/gdp-data.js"></script>
        <script src="assets/plugins/jqvmap/maps/jquery-jvectormap-world-mill-en.js"></script>

        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
        <script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Grafico de Linhas -->
        <script>
            // Dados do PHP
            var dates = <?php echo json_encode($dates); ?>;
            var averages = <?php echo json_encode($averages); ?>;

            // Função para calcular a média de um array
            function calculateAverage(array) {
                var sum = array.reduce(function(a, b) {
                    return a + Number(b); // Certifique-se de converter o valor para número usando a função Number()
                }, 0);

                return sum / array.length;
            }

            // Função para calcular a média acumulada em cada ponto do gráfico
            function calculateCumulativeAverage(array) {
                var cumulativeAverageArray = [];
                for (var i = 0; i < array.length; i++) {
                    var subset = array.slice(0, i + 1);
                    var average = calculateAverage(subset);
                    cumulativeAverageArray.push(average);
                }
                return cumulativeAverageArray;
            }

            // Função para atualizar o gráfico com base na opção selecionada
            function updateChart(timeRange) {

                var filteredDates = [];
                var filteredAverages = [];

                if (timeRange === "week") {
                    // Lógica para exibir dados da última semana
                    var endDate = new Date(); // Data atual
                    var startDate = new Date(endDate); // Cria uma cópia da data atual
                    startDate.setDate(startDate.getDate() - 6); // Subtrai 6 dias para obter a data inicial

                    filteredDates = [];
                    filteredAverages = [];

                    var currentDate = new Date(startDate); // Inicializa com a data inicial

                    while (currentDate <= endDate) {
                        var currentDateStr = currentDate.toISOString().split('T')[0]; // Converte a data para o formato 'yyyy-mm-dd'

                        var dataIndex = dates.indexOf(currentDateStr);
                        if (dataIndex !== -1) {
                            filteredDates.push(dates[dataIndex]);
                            filteredAverages.push(averages[dataIndex]);
                        } else {
                            filteredDates.push(currentDateStr);
                            filteredAverages.push(0); // Define a média como zero para os dias sem dados
                        }

                        currentDate.setDate(currentDate.getDate() + 1); // Avança para o próximo dia
                    }
                } else if (timeRange === "month") {
                    // Lógica para exibir dados do mês anterior
                    var currentDate = new Date(); // Data atual
                    var startDate = new Date(currentDate); // Cria uma cópia da data atual
                    startDate.setMonth(startDate.getMonth() - 1); // Define o mês como o mês anterior

                    filteredDates = [];
                    filteredAverages = [];

                    while (startDate <= currentDate) {
                        var currentDateStr = startDate.toISOString().split('T')[0]; // Converte a data para o formato 'yyyy-mm-dd'

                        var dataIndex = dates.indexOf(currentDateStr);
                        if (dataIndex !== -1) {
                            filteredDates.push(dates[dataIndex]);
                            filteredAverages.push(averages[dataIndex]);
                        } else {
                            filteredDates.push(currentDateStr);
                            filteredAverages.push(0); // Define a média como zero para os dias sem dados
                        }

                        startDate.setDate(startDate.getDate() + 1); // Avança para o próximo dia
                    }
                }

                // Calcular a média acumulada em cada ponto do gráfico
                var cumulativeAverageArray = calculateCumulativeAverage(filteredAverages);

                // Atualizar o gráfico com os novos dados
                chart.data.labels = filteredDates;
                chart.data.datasets[0].data = filteredAverages;
                chart.data.datasets[1].data = cumulativeAverageArray;
                chart.update();
            }

            // Configuração do gráfico
            var ctx = document.getElementById('dailyAverageChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                            label: 'Número de Utilizadores no site',
                            data: averages,
                            backgroundColor: 'rgba(0, 123, 255, 0.5)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            borderWidth: 1,
                            tension: 0.5
                        },
                        {
                            label: 'Média',
                            data: [],
                            backgroundColor: 'rgba(255, 0, 0, 0.5)',
                            borderColor: 'rgba(255, 0, 0, 1)',
                            borderWidth: 1,
                            tension: 0.4
                        }
                    ],
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Data'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Nº de Utilizadores'
                            }
                        }
                    }
                }
            });

            // Evento de mudança do seletor
            var timeRangeSelect = document.getElementById('timeRangeSelect');
            timeRangeSelect.addEventListener('change', function() {
                var selectedOption = timeRangeSelect.value;
                updateChart(selectedOption);
            });
        </script>
        <!-- Grafico Globo -->
        <script>
            "use strict";
            $(document).ready(function() {
                // World Map
                $('#world-map').vectorMap({
                    map: 'world_mill_en',
                    backgroundColor: 'transparent',
                    markerStyle: {
                        initial: {
                            fill: '#2e2e2e',
                            stroke: '#2e2e2e',
                            "fill-opacity": 1,
                            "stroke-width": 15,
                            "stroke-opacity": 0.2
                        }
                    },
                    markers: [
                        <?php
                        // $d=strtotime("today");
                        // $data = date("Y-m-d", $d) . "<br>";
                        $query = "SELECT COUNT(DISTINCT id_user) AS count, country, sigla, latitude, longitude FROM access_logs WHERE access_time >= CURDATE() - INTERVAL 31 DAY GROUP BY country;";
                        $result = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count = $row['count'];
                            $country = $row['country'];
                            $latitude = $row['latitude'];
                            $longitude = $row['longitude'];
                            $sigla = $row['sigla'];

                            echo "{latLng: [$latitude, $longitude], name: '$country - $count Pessoas'},";
                        }
                        ?>
                    ],
                    focusOn: {
                        x: 0,
                        y: 0,
                        scale: 1
                    },
                    series: {
                        regions: [{
                            values: {
                                <?php
                                $query = "SELECT COUNT(id) AS count, sigla FROM access_logs GROUP BY sigla";
                                $result = mysqli_query($db, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $count = $row['count'];
                                    $sigla = $row['sigla'];

                                    echo "'$sigla': 'rgba(94, 163, 255, 1)',";
                                }
                                ?>
                            }
                        }]
                    },
                    regionStyle: {
                        initial: {
                            fill: '#e9eff9'
                        }
                    }
                });
            });
        </script>
        <!-- Exportar Excel -->
        <script>
            function exportToExcel() {
                // Obter os dados do gráfico
                var chartData = chart.data;

                // Preparar os dados para a exportação
                var data = [];
                for (var i = 0; i < chartData.labels.length; i++) {
                    var date = chartData.labels[i];
                    var average = chartData.datasets[0].data[i];
                    var cumulativeAverage = chartData.datasets[1].data[i];
                    data.push([date, average, cumulativeAverage]);
                }

                // Criar uma nova planilha Excel
                var wb = XLSX.utils.book_new();

                // Criar uma planilha para os dados
                var wsData = XLSX.utils.aoa_to_sheet([
                    ['Data', 'Valores Diários', 'Média Acumulada'], ...data
                ]);
                XLSX.utils.book_append_sheet(wb, wsData, 'Dados');

                // Salvar o gráfico como imagem
                var chartImage = chart.toBase64Image();

                // Converter a imagem base64 para Blob
                var byteCharacters = atob(chartImage.split(',')[1]);
                var byteNumbers = new Array(byteCharacters.length);
                for (var i = 0; i < byteCharacters.length; i++) {
                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                }
                var byteArray = new Uint8Array(byteNumbers);
                var blob = new Blob([byteArray], {
                    type: 'image/png'
                });

                // Criar uma URL para a imagem
                var imageURL = URL.createObjectURL(blob);

                // Criar uma nova planilha para o gráfico
                var wsChart = XLSX.utils.book_new();

                // Definir a célula onde o gráfico será inserido
                var cellRef = 'A1';

                // Adicionar a imagem do gráfico à planilha
                var img = new Image();
                img.src = imageURL;
                wsChart['A1'] = {
                    t: 's',
                    v: 'Gráfico'
                };
                wsChart['A2'] = {
                    t: 's',
                    v: 'Veja a imagem abaixo:'
                };
                wsChart['A4'] = {
                    t: 's',
                    v: 'Gráfico'
                };
                wsChart['B4'] = {
                    t: 's',
                    v: imageURL
                };
                wsChart['!ref'] = 'A1:B4';

                // Adicionar a planilha do gráfico ao livro Excel
                XLSX.utils.book_append_sheet(wb, wsChart, 'Gráfico');

                // Gerar o arquivo Excel
                XLSX.writeFile(wb, 'grafico.xlsx');
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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
} else {
    echo ("inicie sessão com uma conta com permissoes para aceder a esta pagina ");
?>
    <A HREF="login.php">Login</A>
<?php
}
?>

</html>