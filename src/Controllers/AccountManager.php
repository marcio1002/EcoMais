<?php
namespace Ecomais\Controllers;

use Ecomais\Models\{DataException, Person, PersonLegal, Safety};
use Ecomais\Controllers\ComponenteElement as Componente;
use Ecomais\ControllersServices\AccountHandling;
use Ecomais\Services\EmailECM;

class AccountManager
{
    private $account;
    private $usr;
    private $usrLegal;
    private $safety;
    private $email;

    function __construct()
    {
        $this->account = new AccountHandling();
        $this->usr = new Person();
        $this->safety = new Safety();
        $this->email = new EmailECM();
    }

    public function  addAccountPersonPhysical($param): void
    {
        try {

            $this->usr->setName($param['name']);
            $this->usr->setEmail($param['email']);
            $this->usr->setPassword($param['passwd']);
            $this->usr->setCep($param['cep']);
            $this->usr->setUF($param['uf']);
            $this->usr->setAddres($param['addres']);
            $this->usr->setLocality($param['localidade']);
            $this->usr->setStatusAccount(Person::ENABLED);

            if ($this->account->createAccountPersonPhysical($this->usr)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]); 
            }
        } catch (DataException $ex) {
            die(header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}"));
        }
    }

    public function updateAccount(): void
    {
        try {

            $this->usr->setName($_POST['name']);
            $this->usr->setEmail($_POST['email']);
            $this->usr->setPassword($_POST['passwd']);
            $this->usr->setId($_POST['id']);


            if ($this->account->updateAccountPersonPhysical($this->usr)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"],);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}"); 
        }
    }

    public function  deleteAccount($person): void
    {
        try {

            $this->usr->setId($person['id']);

            if ($this->account->deleteAccount($this->usr)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"],);
            } else {
                echo json_encode(["error" => true, "status" => 404, "msg" => ""]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}"); 
        }
    }
    // login server para os dois tipos de usuario empresa/usuario
    public function login($person): void
    {
        try {
            $this->usr->setEmail($person['email']);
            $this->usr->setPassword($person['passwd']);

            if ($res = $this->account->setLogin($this->usr)) {
                
                $temp = ($person['conectedLogin'] == 18) ? time() + (1 * 12 * 30 * 24 * 3600) : time() + (24 * 36000);

                $this->usr->setId($res['id_usuario']);
                
                $token =  md5("ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}");
                session_name($token);

                if (session_status() == PHP_SESSION_DISABLED) session_start();

                setcookie('_id', $this->usr->getId(), $temp, '/', "", false, true);
                setcookie('_token', $token, $temp, '/', "", false, true);
                
                echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"]);
                
            } else {
                echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]); 
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}");
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
           
            //header("location: " . BASE_URL . "/product");
        }
       if(session_status() == PHP_SESSION_ACTIVE) session_destroy();
    }
// recuperar senha server para os dois tipos de usuario empresa/usuario
    public function recoverPasswd($param):void 
    {
        try {
            if($param['option'] == 0) { 
                $token = $this->safety->createToken($param["value"]);         
                $this->email->add(
                    "Seu pedido de recuperação de senha no EcoMais",
                    Componente::mail($param['name'],$token),
                    $param["name"],
                    $param["value"],
                )->attach(__DIR__ . "/../assets/imgs/eco.jpg","EcoMais")->send();
                echo json_encode(["error" => false, "status" => 200, "msg" => $param["name"]]);
            } else {
                if($this->account->recoverPasswdKey($param["value"]))
                    echo json_encode(["error" => false, "status" => 200, "msg" => $param["name"]]);
                else 
                    echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Found"]);
            }


        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}"); 
        }
    }
}
