<?php

define("BASE_URL", "https://ecomais.herokuapp.com");


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-PINGARUNER, Content-Type');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Content-type: text/html; application/json;charset=UTF-8');
header("Accept-Language: *");
header("Content-Language: pt-BR,en");

function renderUrl(?string $url = null):string
{
    return empty($url) ? BASE_URL : BASE_URL . "/$url";    
}