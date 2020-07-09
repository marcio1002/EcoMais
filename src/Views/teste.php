<?php
    require_once __DIR__ . "/../../vendor/autoload.php";

    $safety = new Ecomais\Models\Safety();

    $prod  = new Ecomais\Controllers\Product\ProductManager();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>
    <?php
        $values = array(
            "name" => "Maça Pera",
            "price" => "23.90",
            "brand" => "Lacoste",
            "classification" => "Fruta",
            "description" => "Maça Pera",
            "quantity" => 12,
            "date_start" => "05/07/2020",
            "date_end" => "08/07/2020",
            "fkCompany" => 1
        );

        $passwd = $safety->criptPasswd("teste_de_senha1");
    
        $prod =  $prod->createProduct($values);

        print_r($prod);
    ?>
</body>
</html>