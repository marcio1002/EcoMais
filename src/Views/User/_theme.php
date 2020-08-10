<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

use Ecomais\Web\Bundles;
use Ecomais\Controllers\ComponenteElement as componente;

$sql = new Ecomais\ControllersServices\User\UserHandling();
$user = new Ecomais\Models\Person();
$implement = new Ecomais\Models\Implementation();

// if($Implementation->isLogged()) {

//   $user->id = $_COOKIE['_id'];
//   $row = $sql->userInfo($user->id);

// } else {
//   header("location: " . BASE_URL . "/login");
// }

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
  <?= Bundles::renderFileCss([
    "bootstrap.min",
    "bootstrap-reboot.min",
    "bootstrap-grid.min",
    "alertify.min",
    "default.min",
    "eco.style",
    "styleComponente"
  ]) ?>
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
  echo Bundles::renderFileJs([
    "jquery-3.5.1.min",
    "jquery.mask",
    "bootstrap.min",
    "bootstrap.bundle",
    "alertify.min",
    "apis",
    "manipulation"
  ]);

  echo "
      <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
      <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>\n
      <script> const BASE_URL = '" . BASE_URL . "'; </script>";
  echo $this->section("scripts");
  ?>

  <script>
    $("#btnEnv").click(function() {
      alertify.set('notifier', 'position', 'top-right');

      let val = $("#emailNewsLetter").val().trim();
      option = {
        method: 'POST',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/newsletter`,
        dataType: "json",
        data: {
          newsletter: val
        },
        success: (response) => {

          if (response.res) {
            $("#emailNewsLetter").val("");
            alertify.success("Obrigado! <br/>Agora você recebera nossa newsletter").delay(5);
          }
        },
        error: () => {}
      };

      if (val.length > 0) {
        reqAjax(option);
      }
    })
  </script>

</body>

</html>