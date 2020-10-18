<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";

$comp = "";//$this->func()->verifyLoggedCompany();

use Ecomais\Web\Bundles;
use Ecomais\Views\Component\ComponentCompany as component;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href=<?= "\"" . renderUrl("/src/assets/logos-icons/ecomais.ico") . "\"" ?> type="image/x-icon">
    <?php Bundles::render(
        ["bootstrap.min.css.map", "bootstrap.min.css", "bootstrap-reboot.min.css.map", "bootstrap-reboot.min.css", "bootstrap-grid.min.css.map", "bootstrap-grid.min.css", "alertify.min.css", "default.min.css", "eco.style.css", "manipulation.css", "themeCompany.css","alertComponent.css"],
        fn ($file) => print_r("<link rel=\"stylesheet\" href=\"$file\">")
    ) ?>
    <?= $this->section("css"); ?>
    <title><?= /* $comp->fantasia ?? */ "my page" ?></title>
</head>

<body class="bg-blue-dark">
    <div class="d-xl-flex d-lg-flex w-12 bg-secondary">
        <!-- Menu -->
        <?= component::navbar(); ?>
        <!-- Menu mobile -->
        <?= component::navBarMobile(); ?>

        <!-- content httperror -->
        <?php
        if ($this->section("error")) :
            echo $this->section("error");
        else :
        ?>
            <div class="h-auto d-flex flex-column container-header">
                <div class="layout-header bg-dark text-light shadow-dark h-auto sticky-top d-flex flex-row justify-content-between">
                    <div class="col-3 py-2 py-xl-2 py-md-3"></div>
                    <div class="header-title text-center col-6 py-2 py-xl-2 py-md-3">
                        <h5 class="font-weight-bold my-2"><?= $subtitle; ?></h5>
                    </div>
                    <div class="col-3 py-2 py-xl-2 py-md-3">
                        <button data-logoff="" class="btn bg-red-wine text-white remove-focus d-xl-none d-lg-none d-sm-inline float-right" title="Sair">
                            Sair
                            <i class="fas fa-sign-out-alt text-white"></i>isset($comp->imagem )) ? renderUrl("/{$comp->imagem}") : renderUrl("/src/assets/imgs/logo-atacado-default.jpg") ?> alt="Imagem de Perfil">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="content" class="content h-auto bg-blue-dark">
                    <?= $this->section("content"); ?>
                    <div style="height: 50px;"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
    echo
        "<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
        <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>\n
        <script> const BASE_URL = '" . BASE_URL . "'; </script>";
    Bundles::render(
        ["jquery-3.5.1.min.js", "jquery.mask.js", "bootstrap.min.js.map", "bootstrap.min.js", "bootstrap.bundle.js.map", "bootstrap.bundle.js", "alertify.min.js", "apis.js", "manipulation.js", "mainCompany.js","alertComponent.js"],
        fn ($file) => print_r("<script src=\"$file\"></script>")
    );
    echo $this->section("scripts");
?>
</body>

</html>https://translate.google.com/translate?depth=1&pto=aue&rurl=translate.google.com&sl=auto&sp=nmt4&tl=pt&u=https://stitcher.io/blog/new-in-php-74#left-associative-ternary-operator-deprecation-rfc