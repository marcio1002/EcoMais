<?php
namespace Controllers;

require_once __DIR__ . "/../vendor/autoload.php";

use Models\{DataException, PersonPhysical, Safety};
use ControllersServices\AccountHandling;
use Services\EmailECM;

class AccountManager
{
    private $account;
    private $usr;
    private $safety;
    private $email;

    function __construct()
    {
        $this->account = new AccountHandling();
        $this->usr = new PersonPhysical();
        $this->safety = new Safety();
        $this->email = new EmailECM();
    }

    public function  addAccount($person): void
    {
        try {

            $this->usr->setName($person['name']);
            $this->usr->setEmail($person['email']);
            $this->usr->setPassword($person['passwd']);

            if ($this->account->createAccount($this->usr)) {

                echo json_encode(["error" => false, "status" => 201, "msg" => "Ok"]);
            } else {
                throw new DataException("Ocorreu um erro ao criar conta");
            }
        } catch (DataException $ex) {
            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
        }
    }

    public function updateAccount(): void
    {
        try {

            $this->usr->setName($_POST['name']);
            $this->usr->setEmail($_POST['email']);
            $this->usr->setPassword($_POST['passwd']);
            $this->usr->setId($_POST['id']);


            if ($this->account->updateAccount($this->usr)) {
                echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"],);
            } else {
                throw new DataException("Ocorreu ao atualizar");
            }
        } catch (DataException $ex) {
            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
            die();
        }
    }

    public function  deleteAccount($person): void
    {
        try {

            $this->usr->setId($person['id']);

            if ($this->account->deleteAccount($this->usr)) {
                echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"],);
            } else {
                throw new DataException("Ocorreu um erro ao deletar o usuario");
            }
        } catch (DataException $ex) {
            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
            die();
        }
    }

    public function login($person): void
    {
        try {
            $this->usr->setEmail($person['email']);
            $this->usr->setPassword($person['passwd']);

            if ($res = $this->account->setLogin($this->usr)) {

                $this->usr->setId($res['id_usuario']);
                $temp = time() + (1 * 12 * 30 * 24 * 3600);
                
                $token =  md5("ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}");
                session_name($token);

                if (session_status() == PHP_SESSION_DISABLED) session_start();

                setcookie('_id', $this->usr->getId(), $temp, '/', "", false, true);
                setcookie('_token', $token, $temp, '/', "", false, true);
                
                echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"]);
            } else {
                throw new DataException('No results found', 404);
            }
        } catch (DataException $ex) {
            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
            die();
        }
        finally 
        { 
            if(session_status() == PHP_SESSION_ACTIVE) session_destroy();
        }
    }

    public function logoff(): void
    {
        if (session_status() == PHP_SESSION_DISABLED) session_start();

        if (!empty($_COOKIE['_id']) && !empty($_COOKIE['_token'])) 
        {
            setcookie('_id', "", 0, "/");
            setcookie('_token', "", 0, "/");
           
            header("location:" . BASE_URL);
        } else 
        {
           
            header("location: " . BASE_URL . "/product");
        }
        session_destroy();
    }

    public function recoverPasswd($param):void 
    {
        try {

            if($param['option'] == 0) {
                $this->email->add(
                    "Recuperar senha",
                    "<div style='width: 80%;margin: 0 25%'>
                    <h1>Chave de recuperação de senha</h1>
                    <div style='width:20%; padding:50px;background:#f5f5f5;margin: 0 15%;text-align:center'>
                      <p>33543534</p>
                    </div>
                  </div>",
                  $param['value'],
                  $param['value']
                )->send();
            } else {
                $pwd = $this->safety->criptPasswd($param['value']);
                $this->usr->setPassword($pwd);
                $this->account->recoverPasswd($this->usr);
            }


        }catch(DataException $ex) {

            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
        }
    }
}
