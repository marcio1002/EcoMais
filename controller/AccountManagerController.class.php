<?php

namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Model\{AccountHandling,Person, PersonPhysical, Safety};
use Exception;
use PDOException;

class AccountManager
{
    private $account;
    private $usr;
    private $safety;

    function __construct()
    {
        $this->account = new AccountHandling();
        $this->usr = new PersonPhysical();
        $this->safety = new Safety();
    }
    public function test(array $usr) {
       echo json_encode(['code'=> '200','status' => 'OK','data' => ['name'=> $usr['name'],'idade'=> $usr['idade'],'city'=> $usr['city'],'pais'=>$usr['pais']]]);
    }
    public function  addAccount(Person $person)
    {
        try {
            if ($this->account->createAccount($person)) {
                echo json_encode(["error" => false, "status" => 201, "msg" => "Ok"],);
            } else {
                throw new Exception("Ocorreu um erro ao criar conta");
            }
        } catch (Exception $ex) {
            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
        }
    }

    public function updateAccount()
    {
        try {

            $this->usr->setName($_POST['name']);
            $this->usr->setEmail($_POST['email']);
            $this->usr->setPassword($_POST['passwd']);
            $this->usr->setId($_POST['id']);


            if ($this->account->updateAccount($this->usr)) {
                echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"],);
            } else {
                throw new Exception("Ocorreu ao atualizar");
            }
        } catch (Exception $ex) {
            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
        } catch (PDOException $pdoEx) {
            echo json_encode(["error" => true, "status" => $pdoEx->getCode(), "msg" => $pdoEx->getMessage()]);
        }
    }

    public function  deleteAccount()
    {
        try {

            $this->usr->setId($_POST['id']);

            if ($this->account->deleteAccount($this->usr)) {
                echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"],);
            } else {
                throw new Exception("Ocorreu um erro ao deletar o usuario");
            }
        } catch (Exception $ex) {
            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
        }
    }
    
    public function login($person)
    {
        try {
            $this->usr->setEmail($person['email']);
            $this->usr->setPassword($person['passwd']);

            if ($res = $this->account->setLogin($this->usr)) {

                $this->usr->setId($res['id_usuario']);
                $temp = time() + (1 * 12 * 30 * 24 * 3600);
                $token =  uniqid(md5("ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}"));

                session_set_cookie_params($temp, '/', null, false, false);

                if (session_status() == PHP_SESSION_DISABLED) session_start();

                setcookie('_id', $this->usr->getId(), $temp, '/', null, false, true);
                setcookie('_token', $token, $temp, '/', null, false, true);
                echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"]);
            } else {
                throw new Exception('No results found',404);
            }
        } catch (Exception $ex) {
            echo json_encode(["error" => true, "status" => $ex->getCode(), "msg" => $ex->getMessage()]);
            die();
        }
    }

    public function logoff()
    {
        if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0) header("location: ".BASE_URL."/error/406");

        if ($this->account->isLogged()) {
            setcookie('_id', "", time() -  36000, "/");
            setcookie('_token', "", time() -  36000, "/");
        }

        header("location:" . BASE_URL);
    }
}
