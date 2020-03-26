<?php    
    require_once "../server/dataModel.class.php";
    require_once "../model/personPhysicalModel.class.php";
    try{
        $usr = new PersonPhysical();
        $data = new Data();
        $usr->setName($_POST['name']);
        $usr->setEmail($_POST['email']);
        $usr->setPassword($_POST['passwd']);
        
        $id = [$_POST['id']];
        $postPreVal =["nome = ?","email = ?", "password = ?"];
        $postVal = [$usr->getName(), $usr->getEmail(), $usr->getPassword()];

        if($data->update("usuarios","id_usuario = ?",$id,$postPreVal,$postVal)){
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"],);
        }
        
       
    }catch(PDOException $ex){
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
        die();
    }catch(Exception $ex) {
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
        die();
    }
?>