<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

use Ecomais\Web\Bundles;
use Ecomais\Controllers\ComponenteElement as componente;

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
  <?= Bundles::renderCss(["css/bootstrap", "css/alertify", "fontawesome", "css/eco/style"]);?>
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link rel='stylesheet' href=<?= renderUrl("/src/assets/css/themes/styleComponente.css"); ?> >
  <?= $this->section("css"); ?>
  
  <title><?= $title ?></title>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <a class="btn btn-primary" href="#">Sign In</a>
    </div>
  </nav>
  <div class="progress d-none" style="height: 5px;">
  <div id="#progress" class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>

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
  <?= componente::footer()?>

<?php
    echo Bundles::renderJs([
          "js/jquery",
          "js/jqueryMask",
          "js/bootstrap",
          "js/alertify",
          "js/apis",
          "js/manipulation"
      ]);
      
  echo "<script>
          const BASE_URL = '" . BASE_URL . "';
      </script>";
      echo $this->section("scripts");
  ?>

<script>
        $("#btnEnv").click(function() {
          alertify.set('notifier','position', 'top-right');
          
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