<?php
require_once dirname(__DIR__,2) . "/vendor/autoload.php";

use Ecomais\Web\Bundles;
use Ecomais\Controllers\ComponenteElement as componente;

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="EcoMais">
    <meta name="description" content="Conheça a melhor plataforma de descontos de atacarejos. O ecomais vai te mostrar os melhores descontos perto da sua casa.">
    <meta name="keywords" content="descontos,atacarejos,supermercado,compras">
    <link rel="shortcut icon" href=<?= renderUrl("/src/assets/logos-icons/ecomais.ico") ?> type="image/x-icon">
    <?= Bundles::renderFileCss([
        "bootstrap.min",
        "bootstrap-reboot.min",
        "bootstrap-grid.min",
        "alertify.min",
        "default.min",
        "eco.style",
        "estilo",
        "styleComponente"
    ]) ?>
    <?= $this->section("css"); ?>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php
        if (!$this->section("error")) :
            echo componente::navBarHome();
        endif;
        ?>
    </header>
    <main>
        <?php
        if ($this->section("error")) :
            echo $this->section("error");
        else :
            echo $this->section("content");
        endif;
        ?>
    </main>
    <?php
    if ($this->section('footer')) :
        echo $this->section('footer');
    endif;

    echo Bundles::renderFileJs([
        "jquery-3.5.1.min",
        "jquery.mask",
        "bootstrap.min",
        "bootstrap.bundle",
        "alertify.min",
        "apis",
        "manipulation"
    ]);

    echo "
        <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
        <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>\n
        <script> const BASE_URL = '" . BASE_URL . "'; </script>";

    echo $this->section("scripts");
    ?>

    <script>
        $("#btnEnv").click(function() {
            let val = $("#emailNewsLetter").val().trim();
            option = {
                method: 'POST',
                mycustomtype: "application/json",
                url: `${BASE_URL}/manager/newsletter`,
                dataType: "json",
                data: {
                    newsletter: val
                },
                success: (response) => {

                    if (response.res) {
                        $("#emailNewsLetter").val("");
                        alertify.success("Obrigado! <br/>Agora você recebera nossa newsletter").delay(5);
                    }
                },
                error: () => {}
            };

            if (val.length > 0) reqAjax(option);
        })
    </script>
</body>

</html>