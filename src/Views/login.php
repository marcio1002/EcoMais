<?php
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use RenderFile\RenderFile as Bundles;
use Ecomais\Views\Component\ComponenteElement as component;

$implement = new Ecomais\Models\Implementation();

if ($implement->isLogged("usuario")) header("location: " . renderUrl("user.index"));
if ($implement->isLogged("empresa")) header("location: " . renderUrl("company.index"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./src/assets/logos-icons/ecomais.ico" type="image/x-icon">
    <?php Bundles::render(["bootstrap.min.css", "bootstrap-reboot.min.css.map", "bootstrap-reboot.min.css", "bootstrap-grid.min.css.map", "bootstrap-grid.min.css", "alertify.min.css", "default.min.css", "eco.style.css", "rsenha.css", "login.css"])
        ->each(fn ($file) => printf("<link rel='stylesheet' href='%s'>",renderUrl($file)));
    ?>
    <title>Login</title>
</head>

<body>
    <div id="container-login" class='col-xl-4 col-lg-4 col-md-6 col-sm-8 shadow-lg py-xl-5 py-lg-5 p-sm-0 position-relative bg-white m-sm-auto h-sm-100 h-xm-100 t-10'>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-8 bg-transparent m-auto box-ecomais-icon position-fixed d-xl-block d-lg-block d-sm-none">
        <div class="w-25 h-100 m-auto ecomais-icon p-0 bg-transparent">
            <img class="img-fluid ecomais-icon shadow-lg img" src=<?= renderUrl("/src/assets/logos-icons/ecomais-icon-xmall.png"); ?> alt="Ecomais">
        </div>
    </div>
        <div class='modal-body p-5'>
            <form>
                <div class='form-group col-12'>
                    <label for='user' class='label-login'>Email ou CNPJ :</label>
                    <div class="input-group">
                        <input type='text' id='user' class='form-control bg-light remove-focus'>
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                </div>
                <div class='form-group col-12'>
                    <label for='inputPwd' class='label-login'>Senha :</label>
                    <div class="input-group">
                        <input type='password' id='inputPwd' class='form-control bg-light remove-focus'>
                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                    </div>
                </div>
                <div class=' col-12'>
                    <div class="form-check m-auto">
                        <input type='checkbox' class='form-check-input' id='manterConectado' checked>
                        <label class='form-check-label ' for='dropdownCheck'>
                            Mantenha-me conectado
                        </label>
                    </div>
                </div>
                <div class='p-3 col text-center'>
                    <a href=<?= renderUrl("home.cadastro"); ?> class='btn btn-link yellow'>Cadastra-se</a>
                    <a href=<?= renderUrl("home.recuperarsenha") ?> class='btn btn-link text-dark'>Esqueceu a Senha?</a>
                </div>
                <div class='col-11 py-2 d-sm-flex justify-content-center m-auto'>
                    <div class='text-center col-12'>
                        <button type='button' class='btn btn-block btn-color-login btn-bg-shadow-hover remove-focus text-center text-uppercase text-weight-800 font-size-1-1em' id='btnLogar'>Entrar</button>
                    </div>
                </div>
                <div class='col-12 text-center pt-3 horizontal-row position-relative'>
                    OU
                </div>
                <div class='col-11 py-2 d-sm-flex justify-content-center m-auto'>
                    <?= component::buttonGoogle("container-account-login", "Entrar com o Google", renderUrl("manager.loginauthgoogle")) ?>
                </div>
            </form>
        </div>
    </div>
    <?php
    echo "
        <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>\n
        <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>\n
        <script> const BASE_URL = '" . BASE_URL . "'; </script>";
    Bundles::render(["jquery-3.5.1.min.js", "jquery.mask.js", "bootstrap.min.js.map", "bootstrap.min.js", "bootstrap.bundle.js.map", "bootstrap.bundle.js", "alertify.min.js", "manipulation.js", "apis.js", "login.js"])
        ->each(fn ($file) => printf("<script src='%s'></script>",renderUrl($file)));
    ?>
</body>

</html>