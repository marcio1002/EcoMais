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
            $this->usr->email = $param['email'];
            $this->usr->passwd = $param['passwd'];

            if ($res = $this->account->setLogin($this->usr)) {

                $expire = ($param['conectedLogin'] == 18) ? time() + (1 * 12 * 30 * 24 * 3600) : time() + (24 * 36000);

                $this->usr->id = $res['id_usuario'];

                $token =  md5("ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}");
                session_name($token);
                session_id(md5(uniqid("ABLS{$_SERVER['REMOTE_ADDR']}ABLS{$_SERVER['HTTP_USER_AGENT']}")));

                if (session_status() == PHP_SESSION_DISABLED) session_start(true);

                setcookie('_id', $this->usr->id, $expire, '/', BASE_URL, false, true);
                setcookie('_token', $token, $expire, '/', BASE_URL, false, true);

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

    public function loginAuthGoogle(): void 
    {
        $google  = new \Ecomais\Models\AuthGoogle();

        $authGoogleUrl = $google->getAuthURL();
        
        $code = filter_input(INPUT_GET,"code",FILTER_SANITIZE_STRIPPED);
        $err  = filter_input(INPUT_GET,"error",FILTER_SANITIZE_STRIPPED);

        if(empty($code) && empty($err)) header("location: $authGoogleUrl");

        if(!empty($code)) {
            $data = $google->getData($code);
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }else {
            echo "<script> window.close(); </script>";
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

            header("location: " . BASE_URL);
        }
        if (session_status() == PHP_SESSION_ACTIVE) session_destroy();
    }
    // recuperar senha server para os dois tipos de usuario empresa/usuario
    public function recoverByKey($param): void
    {
        try {
            $token = $this->safety->createToken($param["value"]);
            if ($res  = $this->account->recoverByKey(trim($param["value"]))){
                session_cache_expire(time() + (2 * 3600));
                session_id(md5($param['name'] . "ECOID"));

                session_start();

                $_SESSION["ssioninfo"] = ["ssion_id" => session_id(),"timestamp" => session_cache_expire(), "tnk" => $token, "chveml" => $param["value"] ];
                echo json_encode(["error" => false, "status" => 200, "token" => $token]);   
            }
            else echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "chave inválida"]);

        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }finally {
           session_commit();
           sleep(1);
        }
    }

    public function recoverByMail($param):void 
    {
        try {
            ob_start();
                $token = $this->safety->createToken($param["value"]);
                $env = $this->email->add(
                    "Seu pedido de recuperação de senha do EcoMais",
                    Componente::mail($param['name'], $token),
                    $param["name"],
                    $param["value"],
                    )->send();
            ob_clean();
                if($env) {
                    session_cache_expire(time() + (2 * 3600));
                    session_id(md5($param['name'] . "ECOID"));

                    session_start();

                   $_SESSION["ssioninfo"] = ["ssion_id" => session_id(),"timestamp" => session_cache_expire(), "tnk" => $token, "chveml" => $param["value"] ];

                    echo json_encode(["error" => false, "status" => 200, "msg" => "ok"]);
                }
                else  echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "ok"]);
            ob_end_flush();

        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }finally {
            session_commit();
            sleep(1);
         }
    }

    public function recoverPasswd($param):void
    {
        try{

            $email = 1;
            $chave = 2;
            $option = null;
            
            if($val =  preg_match("/^(.)+\@[a-zA-Z]+\.[a-zA-Z]+$/i",$param["value"])) {
                $this->usr->email = $param["value"];
                $option = $email;
            } else {
                $this->usr->passwd = $param["value"];
                $option = $chave;
            }

            if($this->account->recoverPasswd($this->usr,$option)) 
            echo json_encode(["error" => false, "status" => 200, "msg" => "ok"]);
            else
            echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "ok"]);

        }catch(DataException $ex){
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }
}
