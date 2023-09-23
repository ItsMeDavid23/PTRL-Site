<div style="padding-right: 3em; padding-left: 3em; padding-top: 2em; ">
    <?php
    if ($CargoUser == 'User') { ?>

        <div style="margin-left: 50px;margin-right: 50px;" class="header">
            <img href="index.php" src="/PAP/imagens/PTRL.webp" alt="PTRL logo">
            <div class="header-right">
                <a href="index.php">Home</a>
                <a href="AboutUs.php">About Us</a>
                <a href="Standings.php">Standings</a>
                <a href="Calendarios.php">Calendários</a>
                <a href="Candidaturas.php">Candidaturas</a>
                <a href="logout.php">Sign Out</a>
            </div>
        </div>
    <?php
    }

    if ($CargoUser == 'Piloto') { ?>

        <div class="header">
            <img href="index.php" src="imagens/PTRL.webp" alt="PTRL logo">
            <div class="header-right">
                <a href="index.php">Home</a>
                <a href="AboutUs.php">About Us</a>
                <a href="Standings.php">Standings</a>
                <a href="Calendarios.php">Calendários</a>
                <a href="PerfilPiloto.php">Perfil do Piloto</a>
                <a href="logout.php">Sign Out</a>
            </div>
        </div>
    <?php
    }

    if ($CargoUser == 'Moderador' || $CargoUser == 'Admin') { ?>
        <div class="header">
            <img href="index.php" src="imagens/PTRL.webp" alt="PTRL logo">
            <div class="header-right">
                <a href="index.php">Home</a>
                <a href="AboutUs.php">About Us</a>
                <a href="Standings.php">Standings</a>
                <a href="Calendarios.php">Calendários</a>
                <a href="admin.php">Admin</a>
                <a href="logout.php">Sign Out</a>
            </div>
        </div>

    <?php } ?>
</div>