<?php
    require_once "../server/dataModel.class.php";
    require_once "../model/safety.class.php";
    require_once "../model/personPhysicalModel.class.php";
    try{
        $data = new Data('localhost','root','rootadmin','apiTest');
        $register = new PersonPhysical();
        $safety = new Safety();
        $register->setName($_POST['name']);
        $register->setEmail($_POST['email']);
        $register->setPassword($_POST['pwd']);
        $passwd = $safety->criptPasswd($register->getPassword());

        $array_columns = array("nome","email","password","date");
        $array_register = array($register->getName(),$register->getEmail(),$passwd,$register->createAt());

        $data->open();
        
        if($data->add("usuarios",$array_columns,$array_register)) {
            $data->close();
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"],);
        }
        
        

    }catch(PDOException $ex) {   
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
    }catch(Exception $ex) {
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
    }
?>