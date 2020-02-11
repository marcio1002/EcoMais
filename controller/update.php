<?php
    require_once "./connection.php";

    $name = "Jaqueline Almeida";
    $email = "jaquelinealmeida@gmail.com";
    $update = ["nome = '$name'","email = '$email'"];
    try{
        $result =  $account->updateRegistry("usuarios","id_usuarios = 3",$update,1);
        echo "<script> alert('Ok') </script>";
        $account->connectionClose();
    }catch(Exception $erro){
        echo $erro->getMessage();
    }
?>