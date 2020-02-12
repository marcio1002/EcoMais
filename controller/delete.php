<?php
    require_once "./connection.php";
        
    try{
        $result =  $account->deleteRegistry("usuarios","id_usuario = id_usuario");
        echo "<script> alert('Ok') </script>";
        $account->connectionClose();
    }catch(Exception $erro){
        echo $erro->getMessage();
    }
?>