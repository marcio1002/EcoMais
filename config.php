<?php
define("BASE_URL","https://www.localhost/WWW/CrudEcoMais");

header('Access-Control-Allow-Origin: *');   
header('Access-Control-Allow-Headers: X-PINGARUNER');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Content-type: text/html');

define("BUNDLES_URL",
[
    "css/materialize" => "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css",
    "js/materialize" => "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js",
    "css/style" => [ BASE_URL."/src/css/estilo.css",BASE_URL."/src/css/style.css"],
    "css/alertify" =>[ BASE_URL."/src/css/themes/default.min.css", BASE_URL."/src/css/alertify.min.css"],
    "js/alertify" => BASE_URL."/src/js/alertify.min.js",
    "js/jquery" => ["https://code.jquery.com/jquery-3.4.1.min.js","https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"],
    "js/apis" => BASE_URL."/src/js/apis.js",
    "js/regAjax" => BASE_URL."/src/js/reqAjax.js",
    "js/manipulation"=> BASE_URL."/src/js/manipulation.js",
    "js/mainMethods" => BASE_URL."/src/js/mainMethods.js"
]);