<?php
require_once dirname(__DIR__,2) . "/vendor/autoload.php";

use Ecomais\Web\Bundles;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="shortcut icon" href=<?= renderUrl("/src/assets/logos-icons/ecomais.ico") ?> type="image/x-icon">
  <?=
    Bundles::renderFileCss([
      "bootstrap.min",
      "bootstrap-reboot.min",
      "bootstrap-grid.min",
      "alertify.min",
      "default.min",
      "eco.style",
      "manipulation",
      "rsenha"
    ]);
  ?>
  <title>Recuperar senha</title>
</head>

<body>
  <div class="w-100" style="max-height: 100vh;height: 100vh;">
    <div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 p-2 m-auto mb-7">
      <div class="col-xl-7 col-lg-7 col-md-9 col-sm-12 offset-xl-2 p-2">
        <div id="alert" class="alert" role="alert"></div>
      </div>
      <div class="form-row">
        <div class="form-group col-xl-7 col-lg-7 col-md-9 col-sm-12 mx-auto">
          <label for="username">Nome:</label>
          <input type="text" class="form-control" id="username" aria-describedby="emailHelp">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-xl-7 col-lg-7 col-md-9 col-sm-12 mx-auto">
          <label for="recoverpwd" id="recover-label">Email:</label>
          <input type="text" class="form-control" id="recoverpwd" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">Informe o email ou chave de acesso clicando na opção "<strong>Eu tenho a chave de acesso</strong>" .</small>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-xl-7 col-lg-7 col-md-9 col-sm-12 mx-auto">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="checkChave" value="0">
            <label class="form-check-label" for="checkChave">Eu tenho a chave de acesso</label>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-xl-7 col-lg-7 col-md-9 col-sm-12 mx-auto">
          <div class="col-xl-12 col-lg-12 col-md-12 col-xm-12 m-auto">
            <button type="button" class="btn btn-lg btn-block btn-primary" id="btnEnviPwd">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php
  echo "<script>  const BASE_URL = \"" . BASE_URL . "\"</script>";
  echo Bundles::renderFileJs([  
    "jquery-3.5.1.min",
    "jquery.mask",
    "bootstrap.min",
    "bootstrap.bundle",
    "alertify.min",
    "apis",
    "manipulation",
    "recoverpasswd"]);
  ?>
</body>

</html>