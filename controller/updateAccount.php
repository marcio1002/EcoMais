<?php   
    require_once "../model/accountHandlingmodel.class.php";
    require_once "../model/personPhysicalModel.class.php";

    try{
        $usr = new PersonPhysical();
        $account = new AccountHandling();

        $usr->setName($_POST['name']);
        $usr->setEmail($_POST['email']);
        $usr->setPassword($_POST['passwd']);
        $usr->setId($_POST['id']);


        if($account->updateAccount($usr))
        {
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"],);
        } else
        {
            throw new Exception("Ocorreu ao atualizar");
        }
              
    }catch(Exception $ex) {
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
    }
?>