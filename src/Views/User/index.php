<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

use Ecomais\Web\Bundles;

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <?= Bundles::renderCss(["css/bootstrap", "css/alertify", "fontawesome", "css/eco/style"]); ?>
  <link rel='stylesheet' type='text/css' href=<?= renderUrl("/src/assets/css/estilo.css") ?> />
  <?= $this->section("css"); ?>
  <title>fdsfs</title>
</head>

<body>
  <div class="row">
    <div class="col-lg-4">
      <svg class="bd-placeholder-img rounded-circle" width="150" height="150" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
        <title>imagem</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
      </svg>
      <h2>nome mercado</h2>
      <p>descrição</p>
      <p><a class="btn btn-success" href="#" role="button">Saiba Mais &raquo;</a></p>
    </div>
    <div class="col-lg-4">
      <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
        <title>Imagem</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
      </svg>
      <h2>Nome do mercado</h2>
      <p>breve descrição.</p>
      <p><a class="btn btn-success" href="#" role="button">Saiba Mais &raquo;</a></p>
    </div>
    <div class="col-lg-4">
      <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
        <title>Imagem</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
      </svg>
      <h2>Nome do mercado</h2>
      <p>breve descrição</p>
      <p><a class="btn btn-success" href="#" role="button">Saiba Mais&raquo;</a></p>
    </div>
  </div>
</body>

</html>