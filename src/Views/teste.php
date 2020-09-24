<?php
require_once dirname(__DIR__,2) . "/vendor/autoload.php";

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
    <?php?>
</body>

</html>