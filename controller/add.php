<?php
    require_once "../model/register.class.php";
    require_once "../model/data.class.php";
    try{
        $data = new Data('localhost','root','rootadmin','apiTest');
        $register = new User();

        $register->setName($_POST['name']);
        $register->setEmail($_POST['email']);
        $register->setPassword($_POST['pwd']);

        $array_columns = array("nome","email","password","date");
        $array_register = array($register->getName(),$register->getEmail(),$register->getPassword(),$register->createAt());
        $data->add("usuarios",$array_columns,$array_register);
        $data->connectionClose();
        return "ok";
        header("location: ../view/index.php");

    }catch(PDOException $erro) {   
        return die($erro->getMessage());
    }catch(Exception $ex) {
        return die($ex->getMessage());
    }
?>