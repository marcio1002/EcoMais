<?php
namespace Controller;
    
    require_once __DIR__."/../vendor/autoload.php";

    use Model\{AccountHandling,PersonPhysical,Safety};
    use Exception;

   class AccountManager {

    public function  addAccount() {
        try {

            $account = new AccountHandling();
            $register = new PersonPhysical();
    
            $register->setName($_POST['name']);
            $register->setEmail($_POST['email']);
            $register->setPassword($_POST['pwd']);
    
            if ($account->createAccount($register)) {
                echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"],);
            } else {
                throw new Exception("Ocorreu um erro ao criar conta");
            }
        } catch (Exception $ex) {
            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
        }
    
       }
       public function updateAccount() {
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
       }

       public function  deleteAccount() {
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
       }
       public function login() {
        try{
            $handling = new AccountHandling;
            $usr = new PersonPhysical();
            $poli = new Safety();
            
            $usr->setEmail($_POST['email']);
            $passwd = $poli->criptPasswd($_POST['pwd']);
            
            if($res = $handling->setLogin($usr,$passwd)){
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
       }

       public function logoff() {
            if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0) header("location: ../view/error.php");

            require_once "../model/manipulacaoContasModel.class.php";
            $handling = new AccountHandling();
                if($handling->isLogged()) {
                    setcookie('_id',"",time() -  36000,"/");
                    setcookie('_token',"",time() -  36000,"/");
                }
        
            header("location: ../index.php");
       }


   }