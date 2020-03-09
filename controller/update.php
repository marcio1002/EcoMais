<?php    
    require_once "../model/data.class.php";
    require_once "../model/register.class.php";
    try{
        $usr = new User();
        $data = new Data('localhost','root','rootadmin','apiTest');
        $usr->setName($_POST['name']);
        $usr->setEmail($_POST['email']);
        $usr->setPassword($_POST['passwd']);

        if($data->update("usuarios","id_usuario = ?",[$_POST['id']],
        ["nome = ?","email = ?", "password = ?"],
        [$usr->getName(), $usr->getEmail(), $usr->getPassword()]
        )){
            $data->connectionClose();
            return "ok";
        }
        
       
    }catch(PDOException $ex){
       return die($ex->getMessage());
    }catch(Exception $ex) {
       return die($ex->getMessage());
    }
?>