<?php
require_once dirname(__DIR__,2) . "/vendor/autoload.php";

use RenderFile\RenderFile as Bundles;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="shortcut icon" href="./src/assets/logos-icons/ecomais.ico" type="image/x-icon">
  <?php
    Bundles::render(
      ["bootstrap.min.css.map", "bootstrap.min.css", "bootstrap-reboot.min.css.map", "bootstrap-reboot.min.css", "bootstrap-grid.min.css.map", "bootstrap-grid.min.css","bootstrap-utilities.min.css.map","bootstrap-utilities.min.css","alertify.min.css","default.min.css","eco.style.css","manipulation.css","rsenha.css"],
      fn($file) => printf("<link rel='stylesheet' href='%s'>",renderUrl($file))
    );
  ?>
  <title>Recuperar senha</title>
</head>

<body>
  <div class="col-12" style="max-height: 100vh;height: 100vh;">
    <div class="col-xl-10 col-lg-10 col-md-8 col-sm-12 p-2 m-auto mb-7">
      <div class="col-xl-7 col-lg-7 col-md-9 col-sm-12 m-auto">
        <div id="alert" class="alert" role="alert"></div>
      </div>
      <div class="form-row">
        <div class="form-group col-xl-7 col-lg-7 col-md-9 col-sm-12 m-auto">
          <label for="recoverpwd" id="recover-label">Email ou CNPJ:</label>
          <input type="text" class="form-control inset-shadow" id="recoverpwd" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">Informe o email ou chave de acesso clicando na opção "<strong>Eu tenho a chave de acesso</strong>" .</small>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-xl-7 col-lg-7 col-md-9 col-sm-12 m-auto">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="checkChave" value="0">
            <label class="form-check-label" for="checkChave">Eu tenho a chave de acesso</label>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-12 m-auto">
          <div class="col-xl-4 col-md-8 col-xm-12 m-auto">
            <button type="button" class="btn btn-lg btn-block btn-primary text-weight-800 text-uppercase font-size-1em" id="btnEnviPwd">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php
  echo "<script>  const BASE_URL = \"" . BASE_URL . "\"</script>";
  Bundles::render(
    ["jquery-3.5.1.min.js","jquery.mask.js","bootstrap.min.js","bootstrap.min.js.map","bootstrap.bundle.js","bootstrap.bundle.js.map","alertify.min.js","apis.js","manipulation.js","recoverpasswd.js"],
    fn($file) => printf("<script src='%s'></script>",renderUrl($file))
  );
  ?>
</body>

</html>