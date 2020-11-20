<?php
$env = env("BASE_URL","https://127.0.0.1/www/ecomais");

$allow_origin = env("CORS_Allow_Origin","*");

define("BASE_URL", $env);
define("PATH_URL", BASE_URL . "/src");
define("BASE_DIR", dirname(__DIR__,2));

header("Access-Control-Allow-Origin: {$allow_origin}");
header('Access-Control-Allow-Headers: X-PINGARUNER, Content-Type');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Content-type: text/html; application/json;charset=UTF-8');
header("Accept-Language: *");
header("Content-Language: pt-BR,en");

function env(string $env, string $valueDefault): string
{
    return getenv($env) ?: $valueDefault;
}
