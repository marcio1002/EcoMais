<?php
$env = getenv("BASE_URL") ? getenv("BASE_URL") : "https://127.0.0.1/www/ecomais";

define("BASE_URL", $env);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-PINGARUNER, Content-Type');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Content-type: text/html; application/json;charset=UTF-8');
header("Accept-Language: *");
header("Content-Language: pt-BR,en");

function renderUrl(?string $url = null):string
{
    $baseUrl = BASE_URL;
    return empty($url) ? $baseUrl : "$baseUrl$url";    
}

mb_http_output('UTF-8');