<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" type="image/x-icon" href="imagens/PTRL.webp">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/csssite.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About Us</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .like-button {
                color: white;
            }

            .like-button.liked {
                color: red;
            }
        </style>
        <style>

            @font-face {
                font-family: "Teko";
                src: url("./fonts/Teko/Teko-Regular.ttf"), url("./fonts/Teko/Teko-Bold.ttf");
            }

            * {
                font-family: 'Teko', Arial, Helvetica, sans-serif;
                color: white;
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
        <div style="background-color:#1E191F;">
<?php
            include("navbarfront.php");
            $IdNoticia = $_GET['id_noticia'];

            $query = "SELECT * FROM noticias WHERE id_noticia = $IdNoticia";
            $result = mysqli_query($db, $query);
            $row = $result->fetch_assoc();

            $titulo = $row['titulo'];
            $descricao = $row['descricao'];
            $caminhoImagem = $row['caminho_imagem'];
            $dataNoticia = $row['DataNoticia'];
            $dataNoticia = date('d/m/Y', strtotime($dataNoticia));

            // Consulta para verificar se o usuário já deu "like" na notícia
            $query = "SELECT COUNT(*) AS total_likes FROM noticias_likes WHERE id_user = '$IdUser' AND id_noticia = '$IdNoticia'";
            $result = $db->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $VerificaLike = $row["total_likes"];

                // Verificar se o usuário já deu "like" na notícia
                $liked = ($VerificaLike > 0);
            } else {
                $liked = false;
            }

             // Obter o número de likes da notícia
             $queryLikes = "SELECT COUNT(*) AS totalLikes FROM noticias_likes WHERE id_noticia = $IdNoticia";
             $resultLikes = mysqli_query($db, $queryLikes);
             $rowLikes = mysqli_fetch_assoc($resultLikes);
             $totalLikes = $rowLikes['totalLikes'];
?>
            <div style="padding-right: 5em;padding-left: 5em;padding-bottom: 5em;margin-right:auto;margin-left:auto;max-width:1020px;">
                <div>
                    <div>
                        <p class='news-description' style='font-size:22px;text-align:right;'>Noticia lançada no dia <?php echo $dataNoticia; ?></p>
                        <img src="<?php echo $caminhoImagem ?>" class='news-image' alt="<?php echo $titulo ?>" style='margin-left:auto;margin-right:auto;display:block;margin-bottom: 25px; max-width: 100%; height: auto;'>
                    </div>
                    <div>
                        <i class="fa-solid fa-heart like-button <?php echo ($liked ? 'liked' : ''); ?>"   style='font-size:30px;float: right;margin-left:10px;' data-id-noticia="<?php echo $IdNoticia; ?>"></i>
                        <p class='news-description' style='font-size:22px;text-align:right;margin-bottom: 25px;'><span class="likes-count"><?php echo $totalLikes; ?></span></p>
                    </div>
                    <div>
                        <h1 class='news-title' style='font-size:38px;margin-bottom:30px;text-align:center;color:khaki;'> <?php echo $titulo; ?> </h1>
                        <p class='news-description' style='font-size:24px;'><?php echo nl2br($descricao); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
        <?php include("script_nav.php"); ?>

        <script>
            function addLike(idNoticia, button) {
            console.log("like");
            var xhrAddLike = new XMLHttpRequest();
            xhrAddLike.open("GET", "adicionar_like.php?id_noticia=" + idNoticia, true);

            xhrAddLike.onreadystatechange = function() {
                if (xhrAddLike.readyState === 4 && xhrAddLike.status === 200) {
                var likesCount = parseInt(xhrAddLike.responseText);
                var likesCountElement = button.parentElement.querySelector(".likes-count");
                likesCountElement.textContent = likesCount;

                if (!button.classList.contains("liked")) {
                    button.classList.add("liked");
                }
                }
            };

            xhrAddLike.send();
            }

            function removeLike(idNoticia, button) {
            console.log("dislike");
            var xhrRemoveLike = new XMLHttpRequest();
            xhrRemoveLike.open("GET", "remover_like.php?id_noticia=" + idNoticia, true);

            xhrRemoveLike.onreadystatechange = function() {
                if (xhrRemoveLike.readyState === 4 && xhrRemoveLike.status === 200) {
                var likesCount = parseInt(xhrRemoveLike.responseText);
                var likesCountElement = button.parentElement.querySelector(".likes-count");
                likesCountElement.textContent = likesCount;

                if (button.classList.contains("liked")) {
                    button.classList.remove("liked");
                }
                }
            };

            xhrRemoveLike.send();
            }

            document.addEventListener("DOMContentLoaded", function () {
                var likeButtons = document.querySelectorAll(".like-button");

                for (var i = 0; i < likeButtons.length; i++) {
                likeButtons[i].addEventListener("click", function () {
                    var button = this;
                    var idNoticia = button.getAttribute("data-id-noticia");
                    var isLiked = button.classList.contains("liked");

                    if (isLiked) {
                    removeLike(idNoticia, button);
                    } else {
                    addLike(idNoticia, button);
                    }
                });
                }
            });
        </script>

    </body>
</html>