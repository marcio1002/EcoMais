<?php
require_once dirname(__DIR__,2) . "/vendor/autoload.php";

use Ecomais\Web\Bundles;

$sql = new Ecomais\ControllersServices\Company\CompanyHandling();
$user = new Ecomais\Models\PersonLegal();
$implement = new Ecomais\Models\Implementation();

if ($implement->isLogged("usuario")) header("location: " . BASE_URL . "/usuario");
if ($implement->isLogged("empresa")) header("location: " . BASE_URL . "/empresa");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./src/assets/logos-icons/ecomais.ico" type="image/x-icon">
    <?= Bundles::renderFileCss(["bootstrap.min", "bootstrap-reboot.min", "bootstrap-grid.min", "alertify.min", "default.min", "eco.style", "rsenha", "login"]) ?>
    <title>Login</title>
</head>

<body>
    <div id="container-login" class='col-xl-4 col-lg-4 col-md-6 col-sm-8 shadow-lg py-4 bg-white m-auto' style="top: 5px;">
        <div class='modal-body p-3'>
            <div class='form-group col-12'>
                <label for='value' class='label-login'>Email ou CNPJ :</label>
                <input type='text' id='value' class='form-control border-bottom-solid-2px'>
            </div>
            <div class='form-group col-12'>
                <label for='inputPwd' class='label-login'>Senha :</label>
                <input type='password' id='inputPwd' class='form-control border-bottom-solid-2px'>
            </div>
            <div class=' col-12'>
                <div class="form-check m-auto">
                    <input type='checkbox' class='form-check-input' id='manterConectado'>
                    <label class='form-check-label ' for='dropdownCheck'>
                        Mantenha-me conectado
                    </label>
                </div>
            </div>
            <div class='p-3 col text-center'>
                <a href=<?= renderUrl("/cadastro"); ?> class='btn btn-link yellow'>Cadastra-se</a>
                <a href=<?= renderUrl("/recuperarsenha") ?> class='btn btn-link text-dark'>Esqueceu a Senha?</a>
            </div>
            <div class='col-12'>
                <div class='text-center col-12'>
                    <button type='button' class='btn btn-large btn-block remove-focus text-center btn-color-login text-weight-800 font-size-1-2em text-uppercase' id='btnLogar'>Entrar</button>
                </div>
            </div>
            <div class='col-12 text-center pt-3'>
                OU
            </div>
            <div class='col-12 pt-4 pb-4 d-sm-flex justify-content-center'>
                <div class='text-center col-12'>
                    <div id="container-account-login" class="btn-group btn-large btn-block">
                        <button class=" btn-color-red text-white btn remove-focus">
                            <i class="icon-google fab fa-google"></i>
                        </button>
                        <a title='Entrar com o Google' href=<?= renderUrl("/manager/logingoogle"); ?> class='btn btn-large btn-block btn-color-red  btn-google remove-focus text-weight-800 font-size-1-2em text-center text-white p-2'>
                            <div class='item-account-login google '>
                                Entrar com o Google
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    echo "<script> const BASE_URL = \"" . BASE_URL . "\"; </script>";
    echo  Bundles::renderFileJs([
        "jquery-3.5.1.min",
        "jquery.mask",
        "bootstrap.min",
        "bootstrap.bundle",
        "alertify.min",
        "dataTable.min",
        "manipulation",
        "apis",
        "login"
    ]);
    ?>
</body>

</html>