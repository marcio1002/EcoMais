<?php
    require_once "../model/accountController.class.php";
    
    $host = "localhost:3306";
    $user = "root";
    $password = "";
    $database = "apiTest";
    $account = new AccountController($host,$user,$password,$database);
    $account->connect();
?>