<?php
    require_once "../Controller/accountController.class.php";
    require_once "../services/connection.php";

    $account = new AccountController();

    try{
        $result =  $account->deleteRegistry($connection,"usuarios","id_usuarios = 5");
        echo "<script> alert('Ok') </script>";
    }catch(Exception $erro){
        echo $erro->getMessage();
    }
?>