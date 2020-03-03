<?php
    require_once "../model/data.class.php";
    
    $host = "localhost:3306";
    $user = "root";
    $password = "rootadmin";
    $database = "apiTest";
    $data = new Data($host,$user,$password,$database);
?>