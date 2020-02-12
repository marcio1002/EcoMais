<?php
    require_once "./connection.php";
        
    try{
        $result =  $account->deleteRegistry($connection,"usuarios","id_usuarios = 5");
        echo "<script> alert('Ok') </script>";
        $account->connectionClose();
    }catch(Exception $erro){
        echo $erro->getMessage();
    }
?>