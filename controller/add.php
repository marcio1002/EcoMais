<?php 
    require_once "./connection.php";
    require_once "../model/registerController.class.php";

    try{
        $register = new RegisterController();

        $register->setName($_POST['name']);
        $register->setEmail($_POST['email']);
        $register->setPassword($_POST['password']);

        $array_register = array($register->getName(),$register->getEmail(),$register->getPassword());
        $array_columns = array("nome","email","password");

        $account->addRegistry("usuarios",$array_columns,$array_register);
        header("location: ../view/index.php");
        echo "<script>alert('Cadastrado com sucesso!'); </script>";
    }catch(Exception $erro) {
        echo $erro->getMessage();
    }
?>