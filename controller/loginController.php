<?php
    require_once "../model/manipulacaoContasModel.class.php";
    require_once "../model/segurancaModel.class.php";
    require_once "../model/pessoaFisicaModel.class.php";
    
    try{
        $handling = new AccountHandling;
        $usr = new PersonPhysical();
        $poli = new Safety();
        
        $usr->setEmail($_POST['email']);
        $passwd = $poli->criptPasswd($_POST['pwd']);
        
        if($res = $handling->login($usr,$passwd)){
            $usr->setId($res['id_usuario']);
            $temp = time() + (1*12*30 * 24 * 3600);
            $token =  uniqid(md5("ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}"));

            session_set_cookie_params($temp,'/',null,false,false);
            session_name(md5("ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}"));

            if(session_status() == PHP_SESSION_DISABLED) session_start();
            
            setcookie('_id',$usr->getId(),$temp,'/',null,false,true);
            setcookie('_token', $token,$temp,'/',null,false,true);
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"]);
        }else {
            throw new Exception('No results found',3);
        }

    }catch(Exception $ex) {
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
        die();
    }
?>