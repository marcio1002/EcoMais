<?php 
    require_once "./connection.php";
    require_once "../model/registerController.class.php";

    try{
        $register = new RegisterController();

        $register->setName($_POST['name']);
        $register->setEmail($_POST['email']);
        $register->setPassword($_POST['password']);

        $array_register = array($register->getName(),$register->getEmail(),$register->getPassword(),$register->createAt());
        $array_columns = array("nome","email","password","date");

        $account->addRegistry("usuarios",$array_columns,$array_register);
        echo "<script>confir('Cadastrado com sucesso!'); </script>";
        header("location: ../view/index.php");

    }catch(Exception $erro) {
        echo $erro->getMessage();
    }
?>