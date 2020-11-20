<?php

namespace Ecomais\Controllers;

use Ecomais\Models\{DataException, Person, Implementation, AuthGoogle};
use Ecomais\Views\Component\ComponenteElement as componente;
use Ecomais\ControllersServices\AccountHandling;
use Ecomais\Services\EmailECM;
use Exception;

class Main
{
    private $sql;
    private $usr;
    private $implement;
    private $email;
    private static $cookie_options = [
        "expires" =>  24 * 36000,
        "path" => "/",
        "domain" => SERVER["DOMAIN"],
        "secure" => SERVER["HTTP_SECURE"],
        "httponly" => true,
        "samesite" => "Lax"
    ];

    function __construct()
    {
        $this->sql = new AccountHandling();
        $this->usr = new Person();
        $this->implement = new Implementation();
        $this->email = new EmailECM();
    }

    /**
     * O método login trabalha com os dois tipos de conta empresa e usuário
     * assim como o método loginAuthGoogle e o método recoverByKey
     */
    public function login(array $params): void
    {
        try {
            if ($cnpj = $this->implement->isCnpj($params['value'])) {
                $params['value'] = $cnpj;
            }
            $this->usr->email = $params['value'];
            $this->usr->passwd = filter_var($params['passwd'],FILTER_SANITIZE_STRING,FILTER_FLAG_EMPTY_STRING_NULL);
            $company = 10;
            $user = 11;

            $row = $this->sql->getLogin($this->usr, (is_numeric($params['value'])) ? $company : $user);

            if (count($row) > 0 && password_verify($this->usr->passwd, $row['senha'])) {
                static::$cookie_options["expires"] = ($params['conectedLogin'] == 18) ? time() + (12 * 30 * 24 * 3600) : time() + (24 * 36000);
                $token = hash("whirlpool", "ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$row["email"]}{$_SERVER['HTTP_USER_AGENT']}");

                $this->usr->id = $row[is_numeric($params['value']) ? "id_empresa" : "id_usuario"];
                $passwd = $this->usr->passwd;
                $this->usr->passwd = $row["senha"];

                $this->sql->verifyUpdateHash($this->usr, $passwd, is_numeric($params['value']) ? "id_empresa" : "id_usuario");

                session_name("ecomais_session");
                $this->implement->getSession();
                setcookie('_id', $this->usr->id, static::$cookie_options);
                setcookie('_sessidcookie', $token, static::$cookie_options);

                echo json_encode(["error" => false, "status" => 200, "data" => (is_numeric($params['value'])) ? $company : $user]);
            } else {
                echo json_encode(["error" => true, "status" => 404, "data" => "Not results"]);
            }
        } catch (Exception | DataException $ex) {
            $this->implement->destroyCookie('_id','_sessidcookie');
            $this->implement->destroyCloseSession();
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        } finally {
            if (session_status() == PHP_SESSION_ACTIVE) session_write_close();
        }
    }

    public function loginAuthGoogle(): void
    {
        try {
            $google  = new AuthGoogle("/manager/logingoogle");


            $code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED, FILTER_SANITIZE_STRING);
            $err  = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED, FILTER_SANITIZE_STRING);
            $state  = filter_input(INPUT_GET, "state", FILTER_SANITIZE_STRIPPED, FILTER_SANITIZE_STRING);

            if ($userConnected =  filter_input(INPUT_GET, "connectedLogin", FILTER_SANITIZE_NUMBER_INT)) {
                session_name("ecomais_session");
                $this->implement->getSession();
                $_SESSION["userConnected"] = $userConnected;
                session_write_close();
            }

            if (empty($code) && empty($err)) exit(header("location: " . $google->getOauthURL()));

            if (!empty($code) && empty($err)) {
                $row = [];
                $row2 = [];
                if ($google->tokenExpired($code)) $code = $google->tokenExpired($code);
                if ($data = $google->getData($code, $state)) {
                    $this->usr->name = $data->getName(); // O método não foi encontrado, mas ele existe no outro objeto
                    $this->usr->email = $data->getEmail();
                    $row =  $this->sql->getLoginAuthGoogle($this->usr, "usuario");
                    $row2 = $this->sql->getLoginAuthGoogle($this->usr, "empresa");
                }

                if (count($row) > 0 || count($row2) > 0) {
                    $this->usr->id = $row['id_usuario'] ?? $row2['id_empresa'] ?? null;
                    $email = $row["email"] ?? $row2["email"] ?? null;

                    $google->unsetSession();
                    session_name("ecomais_session");
                    $this->implement->getSession();
                    static::$cookie_options["expires"] = ($_SESSION["userConnected"] == 18) ? time() + (12 * 30 * 24 * 3600) : time() + (24 * 3600);
                    session_unset();

                    $token = hash("whirlpool", "ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$email}{$_SERVER['HTTP_USER_AGENT']}");

                    setcookie('_id', $this->usr->id, static::$cookie_options);
                    setcookie('_sessidcookie', $token, static::$cookie_options);

                    if (!empty($row)) header("location: " . renderUrl("/user"));
                    if (!empty($row2)) header("location: " . renderUrl("/company"));
                } else 
                    header("location: " .  renderUrl("/login"));
            }
        } catch (Exception | DataException $ex) {
            $this->implement->destroyCookie('_id','_sessidcookie');
            $this->implement->destroyCloseSession();
            header("location: " .  renderUrl("/login"));
        }finally {
            $google->unsetSession();
            if (session_status() == PHP_SESSION_ACTIVE) session_write_close();
        }
    }

    public function logoff(): void
    {
        session_name("ecomais_session");
        $this->implement->getSession();

        if (!empty($_COOKIE['_id']) && !empty($_COOKIE['_sessidcookie'])) {
            $this->implement->destroyCookie('id','_sessidcookie');

            echo json_encode(["error" => false, "status" => 200, "msg" => "ok"]);
        } else {
            echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        }
        $this->implement->destroyCloseSession();
    }

    public function getOauthUrl(array $params): void
    {
        if (empty($params['requestOauthUrl']))  exit(json_encode(["oauthgoogle_url" => null]));
        $requestUrl = filter_var($params['requestOauthUrl'],FILTER_SANITIZE_STRING,FILTER_FLAG_EMPTY_STRING_NULL);
        echo json_encode(["oauthgoogleUrl" => (new \Ecomais\Models\AuthGoogle($requestUrl))->getOauthURL()]);
    }

    public function recoverByKey(array $params): void
    {
        try {
            $token = $this->implement->createToken($params["value"]);
            $row = $this->sql->recoverByKey(trim($params["value"]), 15);
            $row2 = $this->sql->recoverByKey(trim($params["value"]), 10);


            if (count($row) > 0 || count($row2) > 0) {
                session_cache_expire(time() + (1 * 3600));
                session_id($token);

                $this->implement->getSession();

                $_SESSION["ssioninfo"] = ["session_timestamp" => session_cache_expire(), "chveml" => $params["value"]];

                echo json_encode(["error" => false, "status" => 200, "token" => $token]);
            } else
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "chave inválida"]);
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        } finally {
            if (session_start() == PHP_SESSION_ACTIVE) session_write_close();
        }
    }

    public function recoverByMail(array $params): void
    {
        try {
            if ($this->implement->isEmail($params["value"]))
                $row2 = $this->sql->recoverByEmail(trim($params["value"]), 10);
            else if ($params["value"] = $this->implement->isCnpj($params["value"]))
                $row = $this->sql->recoverByCNPJ($params["value"]);

            if ((isset($row) && count($row) > 0) || (isset($row2) && count($row2) > 0)) {
                $token = $this->implement->createToken($params["value"]);
                $env =  null;

                session_cache_expire(time() + (1 * 3600));
                session_id($token);

                $this->implement->getSession();
                session_unset();

                $_SESSION["ssioninfo"] = ["session_timestamp" => session_cache_expire(), "chveml" => $params["value"]];
            }

            if (isset($row2) && count($row2) > 0) {
                ob_start();
                $env = $this->email->add(
                    "Seu pedido de recuperação de senha",
                    componente::mail($params['name'], $token),
                    $params["name"],
                    $params["value"],
                )->send();
                ob_clean();

                if ($env)
                    echo json_encode(["error" => false, "status" => 200, "msg" => "ok"]);
                else
                    echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Verifique os dados"]);
            } else if (isset($row) && count($row) > 0) {
                echo json_encode(["error" => false, "status" => 200, "token" => $token]);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Verifique os dados"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        } finally {
            ob_end_flush();
            if (session_status() === PHP_SESSION_ACTIVE) session_write_close();
        }
    }

    public function recoverPasswd($params): void
    {
        try {
            $response = false;
            $this->usr->passwd = $this->implement->criptPasswd($params['passwd']);

            if ($cnpj = $this->implement->isCnpj($params["value"]))
                $response = $this->sql->recoverByCNPJAndUpdatePasswd($this->usr, $cnpj);
            else {
                $verification = $params["value"];
                $response = $this->sql->updatePasswd($this->usr, $verification);
            }


            if ($response) {
                $this->implement->getSession();
                session_unset();
                $this->implement->destroyCloseSession();
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "ok"]);
            } else
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "ok"]);
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    public function newsLetter($params): void
    {
        try {
            if (filter_var($params["newsletter"], FILTER_VALIDATE_EMAIL)) {
                if ($this->sql->createNewsLetter($params["newsletter"]))
                    exit(json_encode(["res" => true]));
            }
            echo json_encode(["res" => false]);
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }
}
