<?php

namespace Ecomais\Controllers;

use Ecomais\Models\{DataException, Person, Implementation, AuthGoogle};
use Ecomais\Views\Component\ComponenteElement as componente;
use Ecomais\ControllersServices\AccountHandling;
use Ecomais\Services\EmailECM;

class Main
{
    private $sql;
    private $usr;
    private $implement;
    private $email;

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
            if (preg_match("/\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}/", $params['value'])) {
                $params['value'] = preg_replace("/\D/", "", $params['value']);
            }
            $this->usr->email = $params['value'];
            $this->usr->passwd = $params['passwd'];
            $company = 10;
            $user = 11;

            $row = $this->sql->setLogin($this->usr, (is_numeric($params['value'])) ? $company : $user);

            if (count($row) > 0 && password_verify($this->usr->passwd, $row['senha'])) {

                $expire = ($params['conectedLogin'] == 18) ? time() + (12 * 30 * 24 * 3600) : time() + (24 * 36000);
                $token = hash("whirlpool", "ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$row["email"]}{$_SERVER['HTTP_USER_AGENT']}");

                $this->usr->id = $row[is_numeric($params['value']) ? "id_empresa" : "id_usuario"];
                $passwd = $this->usr->passwd;
                $this->usr->passwd = $row["senha"];

                $this->sql->verifyUpdateHash($this->usr, $passwd, is_numeric($params['value']) ? "id_empresa" : "id_usuario");

                $this->implement->getSession();
                setcookie('_id', $this->usr->id, $expire, '/', SERVER["HOST_NAME"], false, true);
                setcookie("_sessidcookie", $token, $expire, "/", SERVER["HOST_NAME"], false, true);

                echo json_encode(["error" => false, "status" => 200, "data" => (is_numeric($params['value'])) ? $company : $user]);
            } else {
                echo json_encode(["error" => true, "status" => 404, "data" => "Not results"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        } finally {
            if (session_status() == PHP_SESSION_ACTIVE) session_write_close();
        }
    }

    public function loginAuthGoogle(): void
    {
        $google  = new AuthGoogle("/manager/logingoogle");


        $code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED, FILTER_SANITIZE_STRING);
        $err  = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED, FILTER_SANITIZE_STRING);
        $state  = filter_input(INPUT_GET, "state", FILTER_SANITIZE_STRIPPED, FILTER_SANITIZE_STRING);

        if ($userConnected =  filter_input(INPUT_GET, "connectedLogin", FILTER_SANITIZE_NUMBER_INT)) {
            $this->implement->getSession();
            $_SESSION["userConnected"] = $userConnected;
            session_write_close();
        }

        if (empty($code) && empty($err)) exit(header("location: " . $google->getOauthURL()));


        if (!empty($code) && empty($err)) {
            if ($google->tokenExpired($code)) $code = $google->tokenExpired($code);
            $data = $google->getData($code, $state);
            $this->usr->name = $data->getName(); // O método não foi encontrado, mas ele existe no outro objeto
            $this->usr->email = $data->getEmail();

            $row =  $this->sql->getLoginAuthGoogle($this->usr, "usuario");
            $row2 = $this->sql->getLoginAuthGoogle($this->usr, "empresa");

            if (count($row) > 0 || count($row2) > 0) {
                $this->usr->id = $row['id_usuario'] ?? $row2['id_empresa'] ?? null;
                $email = $row["email"] ?? $row2["email"] ?? null;

                $this->implement->getSession();
                $expire = ($_SESSION["userConnected"] == 18) ? time() + (12 * 30 * 24 * 3600) : time() + (24 * 3600);
                session_destroy();

                $token = hash("whirlpool", "ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$email}{$_SERVER['HTTP_USER_AGENT']}");

                $this->implement->getSession();
                setcookie('_id', $this->usr->id, $expire, '/', SERVER["HOST_NAME"], false, true);
                setcookie("_sessidcookie", $token, $expire, "/", SERVER["HOST_NAME"], false, true);

                if (!empty($row)) header("location: " . renderUrl("/usuario"));
                if (!empty($row2)) header("location: " . renderUrl("/empresa"));
            } else
                header("location: " .  renderUrl("/login"));
        }
        if (session_status() == PHP_SESSION_ACTIVE) session_write_close();
    }

    public function logoff(): void
    {
        $this->implement->getSession();

        if (!empty($_COOKIE['_id']) && !empty($_COOKIE['_sessidcookie'])) {
            setcookie('_id', "", 0, "/");
            setcookie('_sessidcookie', "", 0, "/");
            session_unset();

            echo json_encode(["error" => false, "status" => 200, "msg" => "ok"]);
        } else {
            echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        }
        $this->implement->destroyCloseSession();
    }

    public function getOauthUrl(array $params): void
    {
        if(empty($params['requestOauthUrl']))  exit(json_encode(["oauthgoogle_url" => null]));

        echo json_encode(["oauthgoogleUrl" => (new \Ecomais\Models\AuthGoogle($params['requestOauthUrl']))->getOauthURL()]);
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
