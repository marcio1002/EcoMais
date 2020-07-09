<?php
require_once __DIR__ . "/../../vendor/autoload.php";

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
    <link rel="shortcut icon" href="./src/assets/icon-ecomais/ecomais-icon.ico" type="image/x-icon">
    <?= Bundles::renderCss(["css/bootstrap", "css/alertify", "fontawesome", "css/eco/style"]); ?>
    <link rel='stylesheet' type='text/css' href=<?= renderUrl("/src/assets/css/estilo.css") ?> />
    <?= $this->section("css"); ?>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php
        if (!$this->section("error")) :
            echo componente::navBarHome();
        endif;
        ?>
    </header>
    <main>
        <?php
        if ($this->section("error")) :
            echo $this->section("error");
        else :
            echo $this->section("content");
        endif;
        ?>
    </main>
    <footer>
        <?php
        if ($this->section('footer')) :
            echo $this->section('footer');
        endif;
        ?>
    </footer>
    <?=
        Bundles::renderJs([
            "js/jquery",
            "js/jqueryMask",
            "js/bootstrap",
            "js/alertify",
            "js/apis",
        ]);
    ?>
    <?php
    echo $this->section("scripts");
    echo "<script>
            const BASE_URL = '" . BASE_URL . "';
        </script>";
    ?>

    <script>
        $("#btnEnv").click(function() {
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
                   
                    if(response.res) {
                        alertify.success("Obrigado! <br/>Agora você receberar nossa newsletter").delay(5);
                    }
                },
                error: () => {}
            };

            if(val.length > 0) {
                reqAjax(option);
            }
        })
    </script>
</body>

</html>