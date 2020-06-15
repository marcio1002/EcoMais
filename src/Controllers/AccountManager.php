<?php

namespace Ecomais\Controllers;

use Ecomais\Models\{DataException, Person, Safety};
use Ecomais\Controllers\ComponenteElement as Componente;
use Ecomais\ControllersServices\AccountHandling;
use Ecomais\Services\{Data, EmailECM};

class AccountManager
{
    private $account;
    private $usr;
    private $safety;
    private $email;

    function __construct()
    {
        $this->account = new AccountHandling();
        $this->usr = new Person();
        $this->safety = new Safety();
        $this->email = new EmailECM();
    }

    // login server para os dois tipos de usuario empresa/usuario
    public function login($param): void
    {
        try {
            $this->usr->setEmail($param['email']);
            $this->usr->setPassword($param['passwd']);

            if ($res = $this->account->setLogin($this->usr)) {

                $temp = ($param['conectedLogin'] == 18) ? time() + (1 * 12 * 30 * 24 * 3600) : time() + (24 * 36000);

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
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        } finally {
            if (session_status() == PHP_SESSION_ACTIVE) session_destroy();
        }
    }

    public function logoff(): void
    {
        if (session_status() == PHP_SESSION_DISABLED) session_start();

        if (!empty($_COOKIE['_id']) && !empty($_COOKIE['_token'])) {
            setcookie('_id', "", 0, "/");
            setcookie('_token', "", 0, "/");

            header("location:" . BASE_URL);
        } else {

            //header("location: " . BASE_URL . "/product");
        }
        if (session_status() == PHP_SESSION_ACTIVE) session_destroy();
    }
    // recuperar senha server para os dois tipos de usuario empresa/usuario
    public function recoverByKey($param): void
    {
        try {
            $token = $this->safety->createToken($param["value"]);
            if ($res  = $this->account->recoverByKey(trim($param["value"]))) echo json_encode(["error" => false, "status" => 200, "token" => $token]);
            else echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "chave inválida"]);

        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    public function recoverByMail($param):void 
    {
        try {
            ob_start();
                $token = $this->safety->createToken($param["value"]);
                $env = $this->email->add(
                    "Seu pedido de recuperação de senha no EcoMais",
                    Componente::mail($param['name'], $token),
                    $param["name"],
                    $param["value"],
                    )->send();
            ob_clean();
                if($env)  echo json_encode(["error" => false, "status" => 200, "msg" => "ok"]);
                else  echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "ok"]);
            ob_end_flush();

        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }
}
