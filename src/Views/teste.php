<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Ecomais\Web\Bundles;

$prod  = new Ecomais\Controllers\Product\ProductManager();


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Bundles::renderCss(["css/bootstrap", "css/alertify", "css/dataTable", "css/eco/style"]) ?>
    <link rel="stylesheet" href=<?= renderUrl("/src/assets/css/themes/tableproduct.css") ?>>
    <title>Teste</title>
</head>

<body>
    
    <?php
    echo dirname(__DIR__ . "/../uploads/imageCompany/",1);
    echo Bundles::renderJs([
        "js/jquery",
        "js/jqueryMask",
        "js/bootstrap",
        "js/alertify",
        "js/dataTable",
        "js/manipulation",
        "js/apis",
    ]);

    echo
        "
        <script>
            const BASE_URL = '" . BASE_URL . "';
        </script>
        "
    ?>
</body>

</html>