<?php    
    require_once "../model/dataModel.class.php";
    require_once "../model/personPhysicalModel.class.php";
    try{
        $usr = new PersonPhysical();
        $data = new Data('localhost','root','rootadmin','apiTest');
        $usr->setName($_POST['name']);
        $usr->setEmail($_POST['email']);
        $usr->setPassword($_POST['passwd']);

        if($data->update("usuarios","id_usuario = ?",[$_POST['id']],
        ["nome = ?","email = ?", "password = ?"],
        [$usr->getName(), $usr->getEmail(), $usr->getPassword()]
        )){
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"],);
        }
        
       
    }catch(PDOException $ex){
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()], );
    }catch(Exception $ex) {
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()], );
    }
?>