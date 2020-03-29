<?php
    require_once "../server/dataModel.class.php";
    require_once "../model/segurancaModel.class.php";
    require_once "../model/pessoaFisicaModel.class.php";
    
    try{
        $data = new Data();
        $usr = new PersonPhysical();
        $poli = new Safety();
        
        $usr->setEmail($_GET['email']);
        $usr->setPassword($_GET['pwd']);
        $passwd = $poli->criptPasswd($usr->getPassword());

        $data->open();
        $res = $data->show('usuarios',[],"email = ? AND password = ?",[$usr->getEmail(),$passwd],3);
        
        if($res){
            $data->close();
            $usr->setName($res['nome']);
            $usr->setId($res['id_usuario']);
            $temp = time() + (1000 * 24 * 3600);
            session_cache_expire($temp);

            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            $_SESSION['_id'] = $usr->getId();
            $_SESSION['_token']= uniqid(md5(time() * strlen($usr->getName())));
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"]);
        }else {
            throw new Exception('No results found',3);
        }

    }catch(PDOException $ex){
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
        die();
    }catch(Exception $ex) {
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
        die();
    }
?>