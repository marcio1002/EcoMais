<?php 
    require_once "../Controller/registerController.class.php";
    require_once "../Controller/accountController.class.php";
    require_once "../services/connection.php";

    $register = new RegisterController();
    $account = new  AccountController();

    $register->setName($_POST['name']);
    $register->setEmail($_POST['email']);
    $register->setPassword($_POST['password']);

    $values = [$register->getName(),$register->getEmail(),$register->getPassword()];
    $columns = ["nome","email","password"];

    try{
        $account->addRegistry($connection,"usuarios",$columns,$values);
        echo "<script>alert('ok');</script>";
        header("location: index.php");

    }catch(Exception $erro) {
        echo $erro->getMessage();
        
    }
?>