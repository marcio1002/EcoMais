<?php
    require_once "../model/dataModel.class.php";
    require_once "../model/personPhysicalModel.class.php";
    try{
        $data = new Data('localhost','root','rootadmin','apiTest');
        $usr = new PersonPhysical();
        
        $usr->setEmail($_GET['email']);
        $usr->setPassword($_GET['pwd']);
        $res = $data->show('usuarios',[],"email = ? AND password = ?",[$usr->getEmail(),$usr->getPassword()],3);
        
        if($res){
            $usr->setName($res['nome']);
            $usr->setPassword($res['password']);
            $usr->setId($res['id_usuario']);

            setcookie('user',$usr->getName());
            setcookie('pwd',$usr->getPassword());
            setcookie('_id',$usr->getId());
            setcookie('_token',md5(uniqid(time() * strlen($res['nome']))));
            header('location: ../view/mostrar.php');
        }else {
            throw new Exception('No results found',3);
        }

    }catch(PDOException $ex){
        die($ex->getMessage());
    }catch(Exception $ex) {
        die($ex->getMessage());
    }
?>