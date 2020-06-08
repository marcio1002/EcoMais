<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Ecomais\Web\Bundles;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://www.localhost/www/EcoMais/src/assets/css/estilo.css">
  <?php
  Bundles::renderBundle([
    "css/manipulation",
    "bootstrap",
    "alertify",
    "css/rsenha"
  ]);
  ?>
</head>

<body>
  <div class='body-em d-flex flex-column align-self-stretch'>
    <div class="col-12">
      <div class="row-cols-md-3 " style="position: relative; top: 25%">
        <form class="m-auto">
        <div class="alert " role="alert">     
        </div>
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
    "js/jquery",
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