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
    <?= Bundles::renderCss(["css/bootstrap", "css/alertify","css/dataTable","css/eco/style"])?>
    <link rel="stylesheet" href=<?= renderUrl("/src/assets/css/themes/tableproduct.css")?> >
    <title>Teste</title>
</head>

<body>


    <?php
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
<script>
    const options = {
        method: 'GET',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/listencompany`,
        dataType: "json",
        success: (res) => {
            console.debug(res);
        },
        error: (res) => {
            console.warn(res.responseText);
            alertify.alert("Alerta","Não foi possível buscar os atacados");
        }
    }

    reqAjax(options);
</script>
</body>

</html>