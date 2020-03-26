<?php
    require_once "../server/dataModel.class.php";
    require_once "../model/safety.class.php";
    require_once "../model/personPhysicalModel.class.php";
    try{
        $data = new Data();
        $usr = new PersonPhysical();
        $poli = new Safety();
        
        $usr->setEmail($_GET['email']);
        $usr->setPassword($_GET['pwd']);
        $passwd = $poli->criptPasswd($usr->getPassword());
        $res = $data->show('usuarios',[],"email = ? AND password = ?",[$usr->getEmail(),$passwd],3);
        
        if($res){
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"],);
            $usr->setName($res['nome']);
            $usr->setId($res['id_usuario']);
            $temp = time() + (90 * 24 * 3600);
            setcookie('_id',$usr->getId(),$temp);
            setcookie('_token',(uniqid(md5(time() * strlen($res['nome'])))),$temp);
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