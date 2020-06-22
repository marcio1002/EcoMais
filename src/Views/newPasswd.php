<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Ecomais\Web\Bundles;


if (session_status() == PHP_SESSION_DISABLED || session_status() == PHP_SESSION_NONE) session_start();
$expire = time();
if($expire > $_SESSION['ssioninfo']["timestamp"]) {
  session_unset();
  session_destroy();
}

$session_id = session_id();

if (isset($_SESSION['ssioninfo'])) {
  $ssion_id = $_SESSION['ssioninfo']["ssion_id"];
  $tnk = $_SESSION['ssioninfo']["tnk"];
  if ((strcasecmp($ssion_id, $session_id) != 0) || (strcasecmp($tnk, $v["token"]) != 0)) {
    header("location: " . renderUrl("/recuperarsenha"));
  }
} else {
  header("location: " . renderUrl("/recuperarsenha"));
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Recuperação de Senha</title>
  <?=
    Bundles::renderBundle([
      "css/manipulation",
      "css/bootstrap",
      "css/alertify",
      "css/rsenha"
    ])
  ?>
</head>

<body>
  <div class='body-em d-flex flex-column justify-content-xl-center justify-content-lg-center justify-content-md-center'>
    <div>
      <div class="col-12">
        <div class="col-12">
          <form>
            <div class="col-xl-5 col-lg-5 col-md-8 col-sm-10 offset-xl-3 offset-lg-3 offset-md-3 offset-sm-1">
              <div class="alert " role="alert"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-xl-5 col-lg-5 col-md-8 col-sm-10 offset-xl-3 offset-lg-3 offset-md-3 offset-sm-1">
                <label for="newPasswd" id="recover-label">Digite a nova senha:</label>
                <input type="password" class="form-control" id="newPasswd" aria-describedby="emailHelp" />
                <small class="form-text text-muted">
                  <div class="progress" style="width: 100%; height: 5px;">
                    <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-xl-5 col-lg-5 col-md-8 col-sm-10 offset-xl-3 offset-lg-3 offset-md-3 offset-sm-1">
                <label for="newPasswdVerify">Digite novamente a senha:</label>
                <input type="password" id="newPasswdVerify" class="form-control" />
              </div>
            </div>
            <div class="d-none">
              <input type="hidden" id="value" value=<?= $_SESSION['ssioninfo']["chveml"] ?>>
            </div>
            <div class="form-row">
              <div class="form-group col-xl-5 col-lg-5 col-md-8 col-sm-10 offset-xl-3 offset-lg-3 offset-md-3 offset-sm-1">
                <div class="col-xl-7 col-lg-7 col-md-7 col-xm-10 m-auto">
                  <button type="button" class="btn btn-lg btn-block btn-success" id="btnRecoverPwd">Criar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>

  <?php
  echo Bundles::renderJs([
    "js/jquery",
    "js/apis",
    "js/alertify",
    "js/manipulation",
  ]);
  ?>
  <script src=<?= renderUrl("/src/assets/js/newpasswd.js") ?>></script>
  <?php
  echo
    "<script>
      const BASE_URL = '" . BASE_URL . "'
    </script>";
  ?>
</body>

</html>