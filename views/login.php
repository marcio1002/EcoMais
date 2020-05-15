<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Controllers\ComponenteElement;
use Web\Bundles;

$account = new ControllersServices\AccountHandling();

if ($account->isLogged()) {
  header("location: " . BASE_URL . "/product");
} else {
  setcookie('_id', "", 0, "/");
  setcookie('_token', "", 0, "/");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <?php
  Bundles::renderCss([
    "css/fonts",
    "bootstrap",
    "js/jquery",
    "css/style",

  ])
  ?>
</head>

<body>
  <?php
  ComponenteElement::navBar();
  ?>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login" data-whatever="@mdo">Open modal for @mdo</button>

  <?php
  Bundles::renderJs([
    "js/apis",
    "js/regAjax",
  ])
  ?>
</body>

</html>