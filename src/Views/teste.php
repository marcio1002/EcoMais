<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Ecomais\Web\Bundles;

$products = new Ecomais\Models\Product();
$prod  = new Ecomais\ControllersServices\Product\ProductHandling();
$implement = new \Ecomais\Models\Implementation();

$products->fkCompany = 11;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Bundles::renderFileCss([
        "bootstrap.min",
        "bootstrap-reboot.min",
        "bootstrap-grid.min",
        "alertify.min",
        "dataTable.min",
        "default.min",
        "eco.style",
        "tableproduct"])?>
    <title>Teste</title>
</head>

<body>

    <?php

    echo substr(__DIR__,22,strlen(__DIR__));

    $row = $prod->searchProd($products);

    // if (count($row) > 0) {
    //     foreach ($row as $val) $data = $implement->toObject($val);
    //     $url = BASE_URL;
    //     echo "<img src=\"$url\\{$data->imagem}\"/>";
    // }
    echo Bundles::renderFileJs([
        "popper.min",   
        "jquery-3.5.1.min",
        "jqueryMask.mask",
        "bootstrap.min",
        "bootstrap.bundle",
        "alertify.min",
        "dataTable.min",
        "manipulation",
        "apis"]);
    echo
        "
        <script>
            const BASE_URL = '" . BASE_URL . "';
        </script>
        ";
    ?>
</body>

</html>