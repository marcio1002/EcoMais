<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Web\Bundles;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Recuperação de Senha</title>
  <?php 
    Bundles::renderCss([
      "css/fonts",
      "css/manipulation",
      "bootstrap",
      "js/jquery",
      "alertify",
      "css/rsenha"
    ])
  ?>
</head>

<body>
  <div class="container" id="title-container">
    <h1>Recuperação de senha</h1>
  </div>
  <main>
    <div class="cad">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail2"> Digite o seu Email:</label>
          <input type="email" class="form-control" id="inputEmail2">
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-success">Enviar</button>
  </main>

<?php
  Bundles::renderJs([
    "js/apis",
    "js/regAjax",
    "js/manipulation",
    "js/mainMethods"
  ])
?>
</body>
</html>