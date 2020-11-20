<?php
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use RenderFile\RenderFile as Bundles;

$implement = new  Ecomais\Models\Implementation();

$implement->getSession(['read_and_close'  => true]);

if (count($_SESSION) == 0 || $_SESSION['ssioninfo']["session_timestamp"] < time())
  exit(header("location: " . renderUrl("home.recuperarsenha")));

if (($token <=> session_id()) != 0) 
  exit(header("location: " . renderUrl("home.recuperarsenha")));
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
      ["bootstrap.min.css.map","bootstrap.min.css","bootstrap-reboot.min.css.map","bootstrap-reboot.min.css","bootstrap-grid.min.css.map","bootstrap-grid.min.css","alertify.min.css","default.min.css","eco.style.css","manipulation.css","rsenha.css"], 
      fn ($file) => printf("<link rel='stylesheet' href='%s'>",renderUrl($file))
    );
  ?>
</head>

<body>
  <div class='body-em d-flex flex-column justify-content-xl-center justify-content-lg-center justify-content-md-center'>
    <div>
      <div class="col-12">
          <div class="col-xl-5 col-lg-5 col-md-8 col-sm-10 m-auto">
            <div class="alert " role="alert"></div>
          </div>
        <form>
          <div class="form-row">
            <div class="form-group col-xl-5 col-lg-5 col-md-8 col-sm-10 m-auto">
              <label for="newPasswd" id="recover-label">Digite a nova senha:</label>
              <div class="input-group">
                <input type="password" class="form-control inset-shadow" id="newPasswd" autocomplete="new-password" aria-describedby="emailHelp" />
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-primary" id="btnViewPasswd"><i id="iconPasswd" class="fas fa-eye-slash"></i></button>
                </div>
              </div>
              <small class="form-text text-muted">
                <div class="progress" style="width: 100%; height: 5px;">
                  <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </small>
            </div>
          </div>
          <div class="form-row p-2">
            <div class="form-group col-xl-5 col-lg-5 col-md-8 col-sm-10 m-auto">
              <label for="newPasswdVerify">Digite novamente a senha:</label>
              <input type="password" id="newPasswdVerify" class="form-control inset-shadow" />
            </div>
            <div class="d-none">
              <input type="hidden" id="value" value=<?= $_SESSION['ssioninfo']["chveml"] ?? "''" ?>>
            </div>
          </div>
          <div class="form-row p-4">
            <div class="form-group col-xl-5 col-lg-5 col-md-8 col-sm-10 m-auto">
              <div id="container-btnRecoverPwd" class="col-xl-7 col-lg-7 col-md-7 col-xm-10 m-auto">
                <button type="button" class="btn btn-lg btn-block btn-success btn-bg-shadow-hover" id="btnRecoverPwd">Criar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  echo "
    <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>
    <script> const BASE_URL = '" . BASE_URL . "'</script>";
  Bundles::render(
    ["jquery-3.5.1.min.js", "jquery.mask.js", "bootstrap.min.js.map", "bootstrap.min.js", "bootstrap.bundle.js.map", "bootstrap.bundle.js", "alertify.min.js", "apis.js", "manipulation.js", "newpasswd.js"],
    fn ($file) => printf("<script src='%s'></script>",renderUrl($file))
  );
  ?>
</body>

</html>