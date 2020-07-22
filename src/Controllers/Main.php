<?php

namespace Ecomais\Controllers;

use Ecomais\Models\{DataException, Person, Safety,AuthGoogle};
use Ecomais\Controllers\ComponenteElement as Componente;
use Ecomais\ControllersServices\AccountHandling;
use Ecomais\Services\{EmailECM};

class Main
{
    private $sql;
    private $usr;
    private $safety;
    private $email;
    private $connected;

    function __construct()
    {
        $this->sql = new AccountHandling();
        $this->usr = new Person();
        $this->safety = new Safety();
        $this->email = new EmailECM();
    }

    /**
     * login server para os dois tipos de usuario empresa/usuario
     */
    public function login(array $param): void
    {
        try {
            $param['value'] = preg_replace("/\D/","",$param['value']);
            $this->usr->email = $param['value'];
            $this->usr->passwd = $param['passwd'];
            $company = 10;
            $user = 11;

            $row = $this->sql->setLogin($this->usr, (is_numeric($param['value'])) ? $company : $user);

            if (count($row) > 0 && password_verify($this->usr->passwd,$row['senha'])) {

                $expire = ($param['conectedLogin'] == 18) ? time() + (12 * 30 * 24 * 3600) : time() + (24 * 36000);

                $token =  hash("whirlpool","ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}");

                $this->usr->id = $row['id_usuario'];

                $this->sql->verifyUpdateHash($row['senha'],$this->usr);

                session_name($token);
                session_id(hash("whirlpool",uniqid("ABLS{$_SERVER['REMOTE_ADDR']}ABLS{$_SERVER['HTTP_USER_AGENT']}")));

                if (session_status() == PHP_SESSION_DISABLED) session_start(true);

                setcookie('_id', $this->usr->id, $expire, '/', BASE_URL, false, true);
                setcookie('_token', $token, $expire, '/', BASE_URL, false, true);

                echo json_encode(["error" => false, "status" => 200, "data" => (is_numeric($param['value'])) ? $company : $user]);
            } else {
                echo json_encode(["error" => true, "status" => 404, "data" => "Not results"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        } finally {
            if (session_status() == PHP_SESSION_ACTIVE) session_destroy();
        }
    }

    public function loginAuthGoogle(): void 
    {
        $google  = new AuthGoogle("/manager/logingoogle");

        $authGoogleUrl = $google->getAuthURL();
        
        $code = filter_input(INPUT_GET,"code",FILTER_SANITIZE_STRIPPED);
        $err  = filter_input(INPUT_GET,"error",FILTER_SANITIZE_STRIPPED);

        if(empty($code) && empty($err)) header("location: $authGoogleUrl");

        if(!empty($code)) {
            echo "<script> window.close(); </script>";
            $data = $google->getData($code);
            $this->usr->name = $data->getName(); // O metodo não foi encontrado, mas ele existe no outro objeto
            $this->usr->email = $data->getEmail();
            $row =  $this->sql->getLoginAuthGoogle($this->usr,"usuario");
            $row2 = $this->sql->getLoginAuthGoogle($this->usr,"empresa");

            if(count($row) > 0 || count($row2) > 0) {
                $this->usr->id = $row['id_usuario'];

                $expire = time() + (12 * 30 * 24 * 3600);
                $token =  hash("whirlpool","ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}");
                
                session_name($token);
                session_id(hash("whirlpool",uniqid("ABLS{$_SERVER['REMOTE_ADDR']}ABLS{$_SERVER['HTTP_USER_AGENT']}")));

                if (session_status() == PHP_SESSION_DISABLED) session_start(true);

                setcookie('_id', $this->usr->id, $expire, '/', BASE_URL, false, true);
                setcookie('_token', $token, $expire, '/', BASE_URL, false, true);

                if($row2) header("location: " . BASE_URL . "/");
            } 
        }else {
            echo "<script> window.close(); </script>";
        }
        if(session_status() == PHP_SESSION_ACTIVE) session_destroy();
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
    public function recoverByKey(array $param): void
    {
        try {
            $token = $this->safety->createToken($param["value"]);
            if ($res  = $this->sql->recoverByKey(trim($param["value"]))){
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

    public function recoverByMail(array $param):void 
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
            $option = ($this->safety->isEmail($param["value"])) ? $email : $chave;
            $verification = $param["value"];
            $this->usr->passwd = $this->safety->criptPasswd($param['passwd']);


            if($this->sql->recoverPasswd($this->usr,$verification,$option)) 
            echo json_encode(["error" => false, "status" => 200, "msg" => "ok"]);
            else
            echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "ok"]);

        }catch(DataException $ex){
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    public function newsLetter($param) {
        try{
            
            if(filter_var($param["newsletter"],FILTER_VALIDATE_EMAIL)) {
                if($this->sql->createNewsLetter($param["newsletter"])) 
                echo json_encode([ "res" => true]);
                return;
            }
                echo json_encode([ "res" => false]);

        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }
}
