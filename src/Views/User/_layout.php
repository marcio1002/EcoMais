<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";

$this->func()->verifyLoggedUser();

use Ecomais\Web\Bundles;
use Ecomais\Views\Component\ComponenteElement as componente;

$implement = new Ecomais\Models\Implementation();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="author" content="EcoMais">
  <meta name="description" content="Conheça a melhor plataforma de descontos de atacarejos. O ecomais vai te mostrar os melhores descontos perto da sua casa.">
  <meta name="keywords" content="descontos,atacarejos,supermercado,compras">
  <link rel="shortcut icon" href=<?= renderUrl("/src/assets/logos-icons/ecomais.ico") ?> type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <?php Bundles::render(
    ["bootstrap.min.css", "bootstrap-reboot.min.css.map", "bootstrap-reboot.min.css", "bootstrap-grid.min.css.map", "bootstrap-grid.min.css", "alertify.min.css", "default.min.css", "eco.style.css", "styleComponente.css"],
    fn ($file) => print_r("<link rel='stylesheet' href='$file'>")
  ) ?>

  <?= $this->section("css"); ?>
  <title>Ecomais | <?= $row ?? "My Webpage" ?></title>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <a class="btn btn-primary" href="#">Sign In</a>
    </div>
  </nav>

  <section>
    <?php
    if ($this->section("error")) :
      echo $this->section("error");
    else :
      echo $this->section("content");
    endif;
    ?>
  </section>

  <!-- Footer -->
  <?= componente::footer() ?>

  <?php
  echo "
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
    <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>\n
    <script> const BASE_URL = '" . BASE_URL . "' </script>";
  Bundles::render(
    ["jquery-3.5.1.min.js", "jquery.mask.js", "bootstrap.min.js.map", "bootstrap.min.js", "bootstrap.bundle.js.map", "bootstrap.bundle.js", "alertify.min.js", "apis.js", "manipulation.js", "newslleter.js"],
    fn ($file) => print_r("<script src='$file'></script>")
  );
  echo $this->section("scripts");
  ?>

</body>

</html>