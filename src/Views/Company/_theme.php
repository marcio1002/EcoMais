<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

use Ecomais\Web\Bundles;
//$safety = new Ecomais\Models\Safety();

// if(!$safety->isLogged()) header("location: " . BASE_URL . "/login");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href=<?= renderUrl("/src/assets/logos-icons/ecomais.ico") ?> type="image/x-icon">
    <?= Bundles::renderCss(["css/bootstrap", "css/alertify", "fontawesome","css/eco/style","css/manipulation"]); ?>
    <link rel="stylesheet" href=<?= renderUrl("/src/assets/css/themes/themeCompany.css"); ?>>
    <?= $this->section("css"); ?>
    <title><?= $title; ?></title>
</head>

<body>
    <div class="d-flex w-12">
        <!-- Menu -->
        <header>
            <nav class="layote-navbar nav navigation navbar navbar-light">
                <div>
                    <!-- Logo -->
                    <img src=<?= renderUrl("/src/assets/imgs/nlogo.png") ?> alt="" class="img-fluid">
                </div>
                <div class=" ">

                    <ul class="d-flex flex-column justify-content-center align-items-center" role="tablist">

                        <li class="nav-item pb-2">
                            <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#tab-content-create-chat" title="Create chat" role="tab">
                                <i class="far fa-chart-bar"></i>
                            </a>
                        </li>
                        <li class="nav-item pb-2">
                            <a href=<?= renderUrl("/empresa/perfil"); ?> class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" title="Friends" role="tab">
                                <i class="far fa-address-card"></i>
                            </a>
                        </li>
                        <li class="nav-item pb-2">
                            <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="" title="Demos" role="tab">
                                <i class="fas fa-shopping-basket"></i>
                            </a>
                        </li>
                    </ul>

                </div>
                <div>
                    <a class="nav-link" href=<?= renderUrl("/empresa/configuracoes") ?> title="Settings">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
            </nav>
        </header>
        <main>
            <?php
            if ($this->section("error")) :
                echo $this->section("error");
            ?>
                <? else: ?>
                <div class="d-flex flex-column container-header">
                    <div class="layote-header py-4 text-white sticky-top d-flex flex-row justify-content-between align-self-stretch">
                        <div class="col-3"></div>
                        <div class="header-title text-center col-6"> col 2 Title</div>
                        <div class="col-3">

                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                    </div>
                    <div class="content">
                        <?= $this->section("content"); ?>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

<?php
   echo Bundles::renderJs([
        "js/jquery",
        "js/jqueryMask",
        "js/bootstrap",
        "js/alertify",
        "js/apis",
        "js/manipulation"
    ]);
    echo $this->section("scripts");

    echo "
    <script>
        const BASE_URL = '" . BASE_URL . "';
    </script>";
?>
</body>

</html>