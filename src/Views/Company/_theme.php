<?php
require_once dirname(__DIR__,3) . "/vendor/autoload.php";

use Ecomais\Web\Bundles;

$sql = new Ecomais\ControllersServices\Company\CompanyHandling();
$user = new Ecomais\Models\PersonLegal();
$implement = new Ecomais\Models\Implementation();

if ($implement->isLogged("empresa")) {
    $user->id = $_COOKIE['_id'];
    $row = $sql->userCompanyInfo($user);
} else {
    header("location: " . BASE_URL . "/login");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href=<?= renderUrl("/src/assets/logos-icons/ecomais.ico") ?> type="image/x-icon">
    <?= Bundles::renderFileCss([ 
        "bootstrap.min", 
        "bootstrap-reboot.min", 
        "bootstrap-grid.min", 
        "alertify.min", 
        "default.min", 
        "eco.style",
        "manipulation",
        "themeCompany"])
    ?>    
    <?= $this->section("css"); ?>
    <title><?= "$row[fantasia] | {$subtitle}" ?></title>
</head>

<body>
    <div class="d-xl-flex d-lg-flex w-12 bg-secondary">
        <!-- Menu -->
        <header class="h-auto navigation d-none d-lg-block d-xl-block">
            <nav class="nav flex-column layote-navbar align-content-center navigation navbar bg-light position-fixed z-index-1000">
                <div class="">
                    <!-- Logo -->
                    <img src=<?= Bundles::renderFile("ecomais-logo-medium","png","/assets/logos-icons") ?> alt="logo Ecomais" class="img-fluid">
                </div>
                <div class="py-5">
                    <a class="nav-link text-red-wine text-red-wine py-4 font-size-1-4em" href=<?= renderUrl("/empresa"); ?> title="Create chat" role="tab">
                        <i class="far fa-chart-bar"></i>
                    </a>

                    <a class="nav-link text-red-wine py-4 font-size-1-4em" href=<?= renderUrl("/empresa/cadastro-de-produtos"); ?> title="Friends" role="tab">
                        <i class="far fa-edit"></i>
                    </a>

                    <a class="nav-link text-red-wine py-4 font-size-1-4em" href=<?= renderUrl("/empresa/perfil"); ?> title="Demos" role="tab">
                        <i class="far fa-address-card"></i>
                    </a>
                </div>
                <div>
                    <a class="nav-link text-red-wine py-2 px-2 font-size-1-4em " href=<?= renderUrl("/empresa/configuracoes"); ?> title="Settings">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
            </nav>
        </header>
        <header class="d-block d-xl-none d-lg-none">
            <nav class="nav nav-pills nav-fill fixed-bottom bg-white">
                <a class="nav-item  nav-link py-4 text-red-wine" href=<?= renderUrl("/empresa/"); ?> title="Create chat" role="tab">
                    <i class="far fa-chart-bar"></i>
                </a>

                <a class="nav-item nav-link py-4 text-red-wine" href=<?= renderUrl("/empresa/cadastro-de-produtos"); ?> title="Friends" role="tab">
                    <i class="far fa-edit"></i>
                </a>

                <a class="nav-item nav-link py-4 text-red-wine" href=<?= renderUrl("/empresa/perfil"); ?> title="Demos" role="tab">
                    <i class="far fa-address-card"></i>
                </a>
                <a class="nav-item nav-link py-4 text-red-wine" href=<?= renderUrl("/empresa/configuracoes"); ?> title="Settings">
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
                    <div class="layote-header h-auto py-2 py-xl-3 py-lg-3 py-md-3  text-white sticky-top d-flex flex-row justify-content-between">
                        <div class="col-3"></div>
                        <div class="header-title text-center col-6">
                            <h5 class="font-weight-bold"><?= $subtitle; ?></h5>
                        </div>
                        <div class="col-3">
                            <button id="logoff" class="btn bg-transparent float-right py-2 remove-focus" title="Sair"><i class="fas fa-sign-out-alt text-white"></i></button>
                        </div>
                    </div>
                    <div class="content h-auto">
                        <?= $this->section("content"); ?>
                        <div class="" style="height: 7vh;"></div>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <?php
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
</body>
<script>
    $("#logoff").click(function() {
        let option = {
            method: 'GET',
            mycustomtype: "application/json charset=utf-8",
            url: `${BASE_URL}/manager/logoff`,
            dataType: "json",
            success: (res) => {
                if (!res.error) {
                    location.href = `${BASE_URL}/login`
                }
            },
            error: (e) => {
                alertify.error("Ocorreu um erro no servidor!");
            }
        };
        reqAjax(option);
    });
</script>

</html>