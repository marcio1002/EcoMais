<?php
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use Ecomais\Web\Bundles;
use Ecomais\Views\Component\ComponenteElement as componente;

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
    <?= Bundles::render(
        ["bootstrap.min.css.map", "bootstrap.min.css", "bootstrap-reboot.min.css.map", "bootstrap-reboot.min.css", "bootstrap-grid.min.css.map", "bootstrap-grid.min.css", "alertify.min.css", "default.min.css", "styleComponente.css", "eco.style.css", "manipulation.css", "estilo.css",],
        fn ($file) => print_r("<link rel='stylesheet' href='$file'>")
    );
    ?>
    <?= $this->section("css"); ?>
    <title><?= $title; ?></title>
</head>

<body>
    <?php
    if ($this->section("error")) :
        echo $this->section("error");
    else :
    ?>
        <header>
            <?= componente::navBarHome(); ?>
        </header>
        <main>
            <?= $this->section("content"); ?>
        </main>
    <?php
        if ($this->section('footer')) :
            echo $this->section('footer');
        endif;
    endif;

    echo "<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>\n
        <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>\n
        <script> const BASE_URL = '" . renderUrl() . "'; </script>";

    Bundles::render(
        ["jquery-3.5.1.min.js", "jquery.mask.js", "bootstrap.min..map", "bootstrap.min.js", "bootstrap.bundle.min.js.map", "bootstrap.bundle.js", "alertify.min.js", "apis.js", "manipulation.js", "newslleter.js","home.js"],
        fn ($file) => print_r("<script src=\"$file\"></script>"),
        "/assets/js"
    );
    echo $this->section("scripts");
?>
</body>

</html>