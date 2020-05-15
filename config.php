<?php
define("BASE_URL", "https://www.localhost/WWW/CrudEcoMais");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-PINGARUNER');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Content-type: text/html');

define(
    "BUNDLES_URL",
    [
        "css/fonts" =>
        [
            "<script src='https://code.jquery.com/jquery-3.4.1.min.js' integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=' crossorigin='anonymous'></script>",
            "<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>",
        ],
        
        "dataTable" => 
        [
            "<link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css'/>",
            "<script type='text/javascript' src='https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js'></script>",
        ],
        "css/style" =>  "<link rel='stylesheet' type='text/css' href='" . BASE_URL . "/src/css/estilo.css'/>",
        "alertify" =>
        [
            "<link rel='stylesheet' type='text/css' href='" . BASE_URL . "/src/css/themes/default.min.css'/>",
            "<link rel='stylesheet' type='text/css' href='" . BASE_URL . "/src/css/alertify.min.css'/>",
            "<script type='text/javascript' src='" . BASE_URL . "/src/js/alertify.min.js'></script>"
        ],
        "js/jquery" =>
        [
            "<script src='https://code.jquery.com/jquery-3.4.1.min.js'
            integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=' crossorigin='anonymous'></script>",
            "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js'></script>",
            "<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'
            integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo'
            crossorigin='anonymous'></script>"
        ],
        "bootstrap" =>
        [
            "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>",
            "<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>"
        ],
        "css/rsenha" => "<link rel='stylesheet' type='text/css' href='" . BASE_URL . "/src/css/rsenha.css' />",
        "css/card" => " <link rel='stylesheet' type='text/css' href='" . BASE_URL . "/src/css/cad.css' />",
        "css/manipulation" => "<link rel='stylesheet' type='text/css' href='" . BASE_URL . "/src/css/manipulation.css' />",
        "js/manipulation" => "<script type='text/javascript' src='" . BASE_URL . "/src/js/manipulation.js'></script>",
        "js/apis" => "<script type='text/javascript' src='" . BASE_URL . "/src/js/apis.js'></script>",
        "js/regAjax" => "<script type='text/javascript' src='" . BASE_URL . "/src/js/reqAjax.js'></script>",
        "js/mainMethods" => "<script type='text/javascript' src='" . BASE_URL . "/src/js/mainMethods.js'></script>"
    ]
);
