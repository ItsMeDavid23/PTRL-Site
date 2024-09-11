<script>
    // Obtém o caminho atual da URL e remove "/PAP/"
    var path = window.location.pathname.replace("/PAP/", "");

    // Verifica se o caminho corresponde a cada link e define o ativo correspondente
    var element = document.querySelector(".header-right a[href='" + path + "']");
    if (element) {
        element.classList.add("active");
    }else{
        element = document.querySelector(".header-right a[href='index.php']");
        element.classList.add("active");
    }
</script>
