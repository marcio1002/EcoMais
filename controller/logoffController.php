<?php
if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0) header("location: ../view/error.php");

    require_once "../model/manipulacaoContasModel.class.php";
    $handling = new AccountHandling();
        if($handling->isLogged()) {
            setcookie('_id',"",time() -  36000,"/");
            setcookie('_token',"",time() -  36000,"/");
        }

    header("location: ../index.php");
?>