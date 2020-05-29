<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Ecomais\Web\Bundles;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Recuperação de Senha</title>
  <?php
  Bundles::renderBundle([
    "css/fonts",
    "css/manipulation",
    "js/jquery",
    "bootstrap",
    "alertify",
    "css/rsenha"
  ])
  ?>
</head>

<body>
  <div class='body-em d-flex flex-column align-self-stretch'>
    <div class="col-12">
      <div class="row-cols-md-3 " style="position: relative; top: 25%">
        <form class="m-auto">
        <div class="form-group">
            <label for="username">Nome:</label>
            <input type="text" class="form-control" id="username" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="recoverpwd" id="recover-label">Email:</label>
            <input type="text" class="form-control" id="recoverpwd" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Informe o email ou chave de acesso clicando na opção "<strong>Eu tenho a chave de acesso</strong>" .</small>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="checkChave" value="0">
            <label class="form-check-label" for="checkChave">Eu tenho a chave de acesso</label>
          </div>
          <button type="button" class="btn btn-primary" id="btnRecoverPwd">Enviar</button>
        </form>
      </div>
    </div>
  </div>

  <?php
  Bundles::renderJs([
    "js/apis",
    "js/mainMethods",
    "js/manipulation",
    "js/recoverPasswd"
  ]);
  echo "
  <script>
    const BASE_URL = '" . BASE_URL . "'
  </script>";
  ?>
</body>

</html>