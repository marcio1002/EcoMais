<?php
    require_once "../model/data.class.php";
    require_once "../model/register.class.php";
    try{
        $data = new Data('localhost','root','rootadmin','apiTest');
        $usr = new User();
        
        $usr->setEmail($_GET['email']);
        $usr->setPassword($_GET['pwd']);

        $res = $data->show('usuarios',[],"email = '{$usr->getEmail()}' AND password = '{$usr->getPassword()}'",3);

        if(!$res->num_rows) throw new Exception('No results found',3);

        $data->connectionClose();

        header('location: ../view/mostrar.php');

    }catch(Exception $ex){
        die($ex->getMessage());
    }
?>