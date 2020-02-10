<?php
    require_once "../Controller/accountController.class.php";
    require_once "../services/connection.php";

    $account = new AccountController();

    $name = "Jaqueline Almeida";
    $email = "jaquelinealmeida@gmail.com";
    $update = ["nome = '$name'","email = '$email'"];
    try{
        $result =  $account->updateRegistry($connection,"usuarios","id_usuarios = 3",$update,1);
        echo "<script> alert('Ok') </script>";
    }catch(Exception $erro){
        echo $erro->getMessage();
    }
?>