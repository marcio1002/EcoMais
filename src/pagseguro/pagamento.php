<?php
// require_once __DIR__ . "/../../vendor/autoload.php";
include 'config.php';

$url = URL_PAGSEGURO . "sessions?email=" . EMAIL_PAGSEGURO . "&token=" . TOKEN_PAGSEGURO;

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$retorno = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($retorno);
echo json_encode($xml);