<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/csssite.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        .fa {
            width: 43px;
            height: 43px;
            padding: 10px;
            font-size: 22px;
            text-align: center;
            text-decoration: none;
            border-radius: 50%;
            display: inline-block;
            margin-right: 10px;
        }

        /* Add a hover effect if you want */
        .fa:hover {
            opacity: 0.7;
        }

        /* Set a specific color for each brand */

        /* Facebook */
        .fa-facebook {
            background: #3B5998;
            color: white;
        }

        /* Twitter */
        .fa-twitter {
            background: #55ACEE;
            color: white;
        }

        .fa-youtube {
            background: #bb0000;
            color: white;
        }

        .fa-instagram {
            background: #f40083;
            color: white;
        }

        .fa-twitch {
            background: #9146ff;
            color: white;
        }

        @font-face {
            font-family: "Teko";
            src: url("./fonts/Teko/Teko-Regular.ttf"), url("./fonts/Teko/Teko-Bold.ttf");
        }


        * {
            font-family: 'Teko', Arial, Helvetica, sans-serif;
            color: white;
            text-transform: uppercase;
        }

        h1 {
            letter-spacing: 2px;
            font-size: 78px;
        }

        h1,
        .sub-title {
            color: white;
            text-transform: uppercase;
        }

        .sub-title {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            height: fit-content;
        }

        @media screen and (max-width: 700px) {

            #imginthefooter img:first-child {
                margin-top: 1em;
            }
        }
    </style>
</head>

<body>
    <div style="background-color:#1E191F ; padding-bottom: 6em;">
        <div>
            <?php include("navbarfront.php"); ?>

            <div style="text-align: center; font-size:40px;">
                <h1>Sobre Nós</h1>
                <div class="sub-title">
                    <a style="text-decoration:none" href="index.php">Home</a><i class="fa-solid fa-angles-right" style="font-size:20px;"></i><span>Sobre Nós</span>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color:#1A0E22 ; padding:2em;">
        <div style="padding:2.5%;">
            <h1 style="font-size:50px; text-align:center; margin-bottom:1em">PTRL (Portuguese Racing League)</h1>
            <table style="width: 100%;">
                <tr>
                    <td>
                        <video width="100%" height="650px" autoplay controls>
                            <source src="imagens\AT-cm_c_FxT9xaYvg6LAIuNXjVxQ.mp4" type="video/mp4">
                        </video>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="font-size:21px; text-align:center; ">A Portugal Racing League é uma liga de F1 virtual criada há 4 anos e conta com mais de 200 participantes.</p><br>
                        <p style="font-size:21px; text-align:center;">A plataforma do pc e da ps sempre fizeram parte dos quadros, contudo a XBOX juntou-se recentemente às nossas fileiras para proporcionar mais competições a todos os sim racers em Portugal</p>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <h1 style="font-size:50px; text-align:center;">Social Media</h1>
            <p style="font-size:25px; text-align:center;">Estas são as nossas contas nas redes sociais onde podes seguir para te manteres <br>a par de tudo relacionado com a liga.</p>
            <div style="margin:2.3em; text-align:center;">
                <a href="https://www.youtube.com/PTRacingLeague" class="fa fa-youtube"></a>
                <a href="https://www.instagram.com/ptracingleague/" class="fa fa-instagram"></a>
                <a href="https://www.twitch.tv/ptracingleague" class="fa fa-twitch"></a>
                <a href="https://www.facebook.com/ptracingleague/" class="fa fa-facebook"></a>
                <a href="https://twitter.com/ptracingleague" class="fa fa-twitter"></a>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
    <?php include("script_nav.php"); ?>
    <script src="https://kit.fontawesome.com/a48f2f209c.js" crossorigin="anonymous"></script>
</body>

</html>