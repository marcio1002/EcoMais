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
            <label for="newPasswd" id="recover-label">Digite a nova senha:</label>
            <input type="text" class="form-control" id="newPasswd" aria-describedby="emailHelp"/>
            <small class="form-text text-muted">
              <div class="progress" style="width: 70%">
                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </small>
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