<?php
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use Ecomais\Models\AuthGoogle;
use Ecomais\Models\Implementation;
use Ecomais\Web\Bundles;
use Ecomais\Services\Data;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Bundles::render(
        ["bootstrap.min.css.map", "bootstrap.min.css", "bootstrap-reboot.min.css.map", "bootstrap-reboot.min.css", "bootstrap-grid.min.css.map", "bootstrap-grid.min.css", "alertify.min.css", "dataTable.min.css", "default.min.css", "eco.style.css", "alertComponent.css"],
        fn ($file) => print_r("<link rel=\"stylesheet\" href=\"$file\">")
    )
    ?>
    <title>Teste</title>
</head>

<body style="width: 100%; height: 100vh">
    <?php
    Bundles::render(
        ["jquery-3.5.1.min.js", "jquery.mask.js", "bootstrap.min.js.map", "bootstrap.min.js", "bootstrap.bundle.js.map", "bootstrap.bundle.js", "alertify.min.js", "alertComponent.js"],
        fn ($file) => print_r("<script src=\"$file\"></script>")
    );
    ?>
</body>

</html>