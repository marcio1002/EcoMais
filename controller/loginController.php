<?php
    require_once "../model/manipulacaoContasModel.class.php";
    require_once "../model/segurancaModel.class.php";
    require_once "../model/pessoaFisicaModel.class.php";
    
    try{
        $handling = new AccountHandling;
        $usr = new PersonPhysical();
        $poli = new Safety();
        
        $usr->setEmail($_GET['email']);
        $passwd = $poli->criptPasswd($_GET['pwd']);
        
        if($handling->login($usr,$passwd)){
            $temp = time() + (2 * 24 * 3600);
            setcookie(session_name(),session_id(),$temp);

            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            $_SESSION['_id'] = $usr->getId();
            $_SESSION['_token']= uniqid(md5(time() * strlen($usr->getName())));
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"]);
        }else {
            throw new Exception('No results found',3);
        }

    }catch(Exception $ex) {
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
        die();
    }
?>