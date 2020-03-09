<?php
    require_once "../model/data.class.php";
    require_once "../model/register.class.php";
    try{
        $data = new Data('localhost','root','rootadmin','apiTest');
        $usr = new User();
        
        $usr->setEmail($_GET['email']);
        $usr->setPassword($_GET['pwd']);

        $res = $data->show('usuarios',[],"email = ? AND password = ?",[$usr->getEmail(),$usr->getPassword()],3);

        if(!$res) throw new Exception('No results found',3);

        $data->connectionClose();

        header('location: ../view/mostrar.php');

    }catch(PDOException $ex){
        die($ex->getMessage());
    }catch(Exception $ex) {
        die($ex->getMessage());
    }
?>