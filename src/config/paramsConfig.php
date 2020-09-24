<?php

define("BD_CONFIG", [
  "TYPE" => 'mysql',
  "HOST" => env("BD_HOST", 'localhost'),
  "USER" => env("BD_USER", 'root'),
  "PASSWD" => env("BD_PASSWD", ''),
  "NAME" => env("BD_NAME", 'bdecomais'),
  "PORT" => env("BD_PORT", "3305"),
  "OPTIONS" => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_CASE => PDO::CASE_NATURAL
  ]
]);

define("EMAIL_PROPS", [
  "HOST" => "smtp.gmail.com",
  "PORT" => "587",
  "EMAIL" => "ecomais5354@gmail.com",
  "PASSWD" => env("EMAIL_PASSWD","ecoMaisDeveloper"),
]);
