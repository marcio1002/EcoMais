<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

use Ecomais\Web\Bundles;

$sql = new Ecomais\ControllersServices\Company\CompanyHandling();
$user = new Ecomais\Models\PersonLegal();
$safety = new Ecomais\Models\Safety();

//   if($safety->isLogged()) {

//     $user->id = $_COOKIE['_id'];
//     $row = $sql->userInfo($user->id);

//   } else {
//     header("location: " . BASE_URL . "/login");
//   }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href=<?= renderUrl("/src/assets/logos-icons/ecomais.ico") ?> type="image/x-icon">
    <?= Bundles::renderCss(["css/bootstrap", "css/alertify", "fontawesome", "css/eco/style", "css/manipulation"]); ?>
    <link rel="stylesheet" href=<?= renderUrl("/src/assets/css/themes/themeCompany.css"); ?>>
    <?= $this->section("css"); ?>
    <title><?= $title; ?></title>
</head>

<body>
    <div class="d-xl-flex d-lg-flex w-12">
        <!-- Menu -->
        <header class="h-auto navigation d-none d-lg-block d-xl-block">
            <nav class="nav flex-column layote-navbar navigation navbar bg-light position-fixed z-index-1000">
                <div class="">
                    <!-- Logo -->
                    <img src=<?= renderUrl("/src/assets/logos-icons/ecomais-logo-medium.png") ?> alt="logo Ecomais" class="img-fluid">
                </div>
                <div class="py-5">
                    <a class="nav-link  nav-link py-4" href=<?= renderUrl("/empresa/"); ?> title="Create chat" role="tab">
                        <i class="far fa-chart-bar"></i>
                    </a>

                    <a class="nav-link py-4" href=<?= renderUrl("/empresa/cadastro-de-produtos"); ?> title="Friends" role="tab">
                        <i class="far fa-edit"></i>
                    </a>

                    <a class="nav-link py-4" href=<?= renderUrl("/empresa/perfil"); ?> title="Demos" role="tab">
                        <i class="far fa-address-card"></i>
                    </a>
                </div>
                <div>
                    <a class="nav-link" href=<?= renderUrl("/empresa/configuracoes"); ?> title="Settings">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
            </nav>
        </header>
        <header class="d-block d-xl-none d-lg-none">
            <nav class="nav nav-pills nav-fill fixed-bottom bg-white">
                <a class="nav-item  nav-link py-4" href=<?= renderUrl("/empresa/"); ?> title="Create chat" role="tab">
                    <i class="far fa-chart-bar"></i>
                </a>

                <a class="nav-item nav-link py-4" href=<?= renderUrl("/empresa/cadastro-de-produtos"); ?> title="Friends" role="tab">
                    <i class="far fa-edit"></i>
                </a>

                <a class="nav-item nav-link py-4" href=<?= renderUrl("/empresa/perfil"); ?> title="Demos" role="tab">
                    <i class="far fa-address-card"></i>
                </a>
                <a class="nav-item nav-link py-4" href=<?= renderUrl("/empresa/configuracoes"); ?> title="Settings">
                    <i class="fas fa-cog"></i>
                </a>
            </nav>
        </header>
        <main>
            <?php
            if ($this->section("error")) :
                echo $this->section("error");
            ?>
                <? else: ?>
                <div class="h-auto d-flex flex-column container-header">
                    <div class="layote-header h-auto py-2 py-xl-4 py-lg-4 py-md-3  text-white sticky-top d-flex flex-row justify-content-between">
                        <div class="col-3"></div>
                        <div class="header-title text-center col-6">
                            <h5>col 2 Title</h5>
                        </div>
                        <div class="col-3">
                            <i class="fas fa-sign-out-alt align-item-end"></i>
                        </div>
                    </div>
                    <div class="content">
                        <?= $this->section("content"); ?>
                        <div class="bg-transparent" style="height: 7vh;"></div>
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