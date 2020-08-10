<?php

define("BD_CONFIG", [
  "HOST" => env("BD_HOST", 'localhost'),
  "USER" => env("BD_USER", 'root'),
  "PASSWD" => env("BD_PASSWD", ''),
  "TYPE" => 'mysql',
  "NAME" => env("BD_NAME", 'bdecomais'),
  "PORT" => env("BD_PORT", "3305"),
]);

define("EMAIL_PROPS", [
  "HOST" => "smtp.gmail.com",
  "PORT" => "587",
  "EMAIL" => "ecomais5354@gmail.com",
  "PASSWD" => "ecoMaisDeveloper",
]);
