<?php

define("DB_CONFIG", [
  "DRIVE" => 'mysql',
  "DB_HOST" => env("DB_HOST", 'localhost'),
  "DB_PORT" => env("DB_PORT", "3306"),
  "DB_USERNAME" => env("DB_USERNAME", 'root'),
  "DB_PASSWD" => env("DB_PASSWD", ''),
  "DB_NAME" => env("DB_NAME", 'bdecomais'),
  "OPTIONS" => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
    PDO::ATTR_CASE => PDO::CASE_NATURAL
  ]
]);

define("EMAIL_PROPS", [
  "HOST" => "smtp.gmail.com",
  "PORT" => "587",
  "EMAIL" => "ecomais5354@gmail.com",
  "PASSWD" => env("EMAIL_PASSWD","ecoMaisDeveloper"),
]);

define("SERVER",[
  "HOST_NAME" => env("HOST_NAME","")
]);
