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
  <title>Recuperação de Senha</title>
  <?php
  Bundles::renderBundle([
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
            <label for="newPasswd" id="recover-label">Digite a nova senha:</label>
            <input type="text" class="form-control" id="newPasswd" aria-describedby="emailHelp"/>
          </div>
          <div class="form-group">
            <label for="newPasswdVerify">Digite novamente a senha:</label>
            <input type="text" id="newPasswdVerify" class="form-control"/>
          </div>
         <div class="form-group">
            <button type="button" class="btn btn-success" id="btnrRcoverPwd">Criar</button>
         </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  Bundles::renderJs([
    "js/apis",
    "js/regAjax",
    "js/mainMethods",
    "js/manipulation",
  ])
  ?>
</body>
</html>