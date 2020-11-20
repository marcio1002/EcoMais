<?php
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use Ecomais\Models\Implementation;
use RenderFile\RenderFile as Bundles;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Bundles::render(
        ["bootstrap.min.css.map", "bootstrap.min.css", "bootstrap-reboot.min.css.map", "bootstrap-reboot.min.css", "bootstrap-grid.min.css.map", "bootstrap-grid.min.css", "alertify.min.css", "dataTable.min.css", "default.min.css", "eco.style.css", "alertComponent.css"],
        fn ($file) => printf("<link rel='stylesheet' href='%s'>",renderUrl($file))
    )
    ?>
    <title>Teste</title>
</head>

<body style="width: 100%; height: 100vh">
    <?php
    $imple = new Implementation;
    
    $newPass = $imple->criptPasswd("atacadoteste");

    // print_r(openssl_get_cipher_methods());
    Bundles::render(
        ["jquery-3.5.1.min.js", "jquery.mask.js", "bootstrap.min.js.map", "bootstrap.min.js", "bootstrap.bundle.js.map", "bootstrap.bundle.js", "alertify.min.js", "alertComponent.js"],
        fn ($file) => printf("<script src='%s'></script>",renderUrl($file))
    );
    ?>
</body>

</html>