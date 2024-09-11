<?php
    $row = $db->query("SELECT IDUser FROM candidaturaspiloto ");
    $result = $row->fetch_all();
    $count = $row->num_rows;

    $row = $db->query("SELECT IDUser FROM users ");
    $result = $row->fetch_all();
    $count1 = $row->num_rows;

    $row = $db->query("SELECT id_corrida FROM corrida WHERE estado_corrida = 'revisao' ");
    $result = $row->fetch_all();
    $count2 = $row->num_rows;
    
    $row = $db->query("SELECT id_piloto FROM piloto WHERE estado_piloto = '1' ");
    $result = $row->fetch_all();
    $count3 = $row->num_rows;
    
    $row = $db->query("SELECT id_organizacao FROM organizacao");
    $result = $row->fetch_all();
    $count4 = $row->num_rows;
?>
<div class="sidebar close">
    <div class="logo-details">
        <a href="index.php"><img src="imagens/PTRL.webp" alt="profileImg"></a>
        <span class="logo_name">PTRL</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="admin.php">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name">Dashboard</a></li>
                <li><a href="admin.php">Ver Dashboard</a></li>
            </ul>
        </li>
        
        <li>
            <a href="VerNoticias.php">
            <i class="fa-solid fa-newspaper"></i>
            <span class="link_name">Notícias</span>
            </a>
            <ul class="sub-menu">
                <li><a class="link_name">Notícias</a></li>
                <li><a href="InserirNoticias.php">Inserir Notícias</a></li>
                <li><a href="VerNoticias.php">Ver Notícias</a></li>
            </ul>
        </li>
        <li>
            <a href="Candidaturas.php">
                <i class="fa-brands fa-wpforms">  <?php echo ($count); ?></i>
                <span class="link_name">Candidaturas  </span>
            </a>
            <ul class="sub-menu">
                <li><a class="link_name">Candidaturas</a></li>
                <li><a href="Candidaturas.php">Ver Candidaturas</a></li>
            </ul>
        </li>
        <li>
            <a href="EscolherCorrida.php">
                <i class="fa-sharp fa-solid fa-flag-checkered">  <?php echo ($count2); ?></i>
                <span class="link_name">Corridas</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name">Corridas</a></li>
                <li><a href="AgendarCorrida.php">Agendar Corrida</a></li>
                <li><a href="EscolherCorrida.php">Inserir Resultados</a></li>
            </ul>
        </li>
        <li>
            <a href="VerLigas.php">
                <i class='bx bx-pie-chart-alt-2'></i>
                <span class="link_name">Ligas</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name">Ligas</a></li>
                <li><a href="VerLigas.php">Ver Ligas</a></li>
            </ul>
        </li>
        <li>
            <a href="VerTemporadas.php">
                <i class='bx bx-compass'></i>
                <span class="link_name">Temporadas</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name">Temporadas</a></li>
                <li><a href="VerTemporadas.php">Ver Temporadas</a></li>
                <li><a href="NovaCompeticao.php">Criar Temporada</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="VerUsers.php">
                    <i class="fa-solid fa-user">  <?php echo ($count1); ?></i>
                    <span class="link_name">Users</span>
                </a>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Users</a></li>
                <li><a href="VerUsers.php">Ver Users</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="VerPilotos.php">
                <i class="fa-solid fa-gamepad">  <?php echo ($count3); ?></i>
                    <span class="link_name">Pilotos</span>
                </a>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Pilotos</a></li>
                <li><a href="VerPilotos.php">Ver Pilotos</a></li>
            </ul>
        </li>

        <li>
            <div class="iocn-link">
                <a href="VerOrganizacoes.php">
                <i class="fa-solid fa-people-group">  <?php echo ($count4); ?></i>
                <span class="link_name">Organizações</span>
                </a>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Organizações</a></li>
                <li><a href="VerOrganizacoes.php">Ver Organizações</a></li>
                <li><a href="InserirOrganizacao.php">Inserir Organizações</a></li>
            </ul>
        </li>

        <li>
            <a href="settings.php">
                <i class='bx bx-cog'></i>
                <span class="link_name">Settings</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name">Settings</a></li>
                <li><a href="settings.php">Ver Settings</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <!--<img src="image/profile.jpg" alt="profileImg">-->
                </div>
                <div class="name-job">
                    <div class="profile_name">
                        <?php echo ($Username); ?>
                    </div>
                    <div class="job">
                        <?php echo ($CargoUser); ?>
                    </div>
                </div>
                <a href="logout.php"><i class='bx bx-log-out'></i></a>
            </div>
        </li>
    </ul>
</div>