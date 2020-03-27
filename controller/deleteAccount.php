<?php    
    require_once "../model/accountHandlingmodel.class.php";
    require_once "../model/personPhysicalModel.class.php";
    try{
        $account = new AccountHandling();
        $pess = new PersonPhysical();
        $pess->setId($_POST['id']);

        if($account->deleteAccount($pess))
        {
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"],);
        } else
        {
            throw new Exception("Ocorreu um erro ao deletar o usuario");
        }
     } catch(Exception $ex) 
     {
        echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
     }
?>