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

                $this->usr->id = $row[is_numeric($params['value']) ? "id_empresa" : "id_usuario"];

                $this->sql->verifyUpdateHash($row['senha'], $this->usr);
                session_name("ECOSESLOGIN");
                session_id(hash("whirlpool", "ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}"));

                $this->implement->getSession();
                    setcookie('_id', $this->usr->id, $expire, '/', "", false, true);

                echo json_encode(["error" => false, "status" => 200, "data" => (is_numeric($params['value'])) ? $company : $user]);
            } else {
                echo json_encode(["error" => true, "status" => 404, "data" => "Not results"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        } finally {
            if (session_status() == PHP_SESSION_ACTIVE) {
                session_destroy();
                session_write_close();
            }
        }
    }

    public function loginAuthGoogle(): void
    {
        $google  = new AuthGoogle("/manager/logingoogle");

        $authGoogleUrl = $google->getAuthURL();

        $code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED);
        $err  = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED);

        if ($userConnected =  filter_input(INPUT_GET, "connectedLogin", FILTER_SANITIZE_NUMBER_INT)) {
            $this->implement->getSession();
                $_SESSION["userConnected"] = $userConnected;
            session_write_close();
        }

        if (empty($code) && empty($err)) exit(header("location: $authGoogleUrl"));


        if (!empty($code) && empty($err)) {
            $data = $google->getData($code);
            $this->usr->name = $data->getName(); // O método não foi encontrado, mas ele existe no outro objeto
            $this->usr->email = $data->getEmail();

            $row =  $this->sql->getLoginAuthGoogle($this->usr, "usuario");
            $row2 = $this->sql->getLoginAuthGoogle($this->usr, "empresa");

            if (count($row) > 0 || count($row2) > 0) {
                $this->usr->id = $row['id_usuario'] ?? $row2['id_empresa'] ?? null;

                $this->implement->getSession();
                    $expire = ($_SESSION["userConnected"] == 18) ? time() + (12 * 30 * 24 * 3600) : time() + (24 * 36000);
                session_destroy();

                session_name("ECOSESLOGIN");
                session_id(hash("whirlpool", "ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}"));

                $this->implement->getSession();
                    setcookie('_id', $this->usr->id, $expire, '/', "", false, true);

                if (!empty($row)) header("location: " . BASE_URL . "/usuario");
                if (!empty($row2)) header("location: " . BASE_URL . "/empresa");
            } else
                header("location: " . BASE_URL . "/login");
        }
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
            session_write_close();
        }
    }

    public function logoff(): void
    {
        $this->implement->getSession();

        if (!empty($_COOKIE['_id']) && !empty($_COOKIE['_token'])) {
            setcookie('_id', "", 0, "/");
            setcookie('_token', "", 0, "/");
            session_unset();

            echo json_encode(["error" => false, "status" => 200, "msg" => "ok"]);
        } else {
            echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        }
        if (session_status() == PHP_SESSION_ACTIVE) session_destroy();
    }

    public function recoverByKey(array $params): void
    {
        try {
            $token = $this->implement->createToken($params["value"]);
            $row = $this->sql->recoverByKey(trim($params["value"]), 15);
            $row2 = $this->sql->recoverByKey(trim($params["value"]), 10);


            if (count($row) > 0 || count($row2) > 0) {
                session_cache_expire(time() + (2 * 3600));
                session_id(hash("crc32", $params['name'] . "ECOID"));

                $this->implement->getSession();

                $_SESSION["ssioninfo"] = ["session_id" => session_id(), "timestamp" => session_cache_expire(), "tnk" => $token, "chveml" => $params["value"]];

                echo json_encode(["error" => false, "status" => 200, "token" => $token]);
            } else
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "chave inválida"]);
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        } finally {
            session_write_close();
            sleep(1);
        }
    }

    public function recoverByMail(array $params): void
    {
        try {
            $row = $this->sql->recoverByCNPJ(trim($params["value"] = preg_replace("/\D/", "", $params["value"])));
            $row2 = $this->sql->recoverByEmail(trim($params["value"]), 10);
            $token = $this->implement->createToken($params["value"]);
            $env =  null;

            if (count($row) > 0 || count($row2) > 0) {
                session_cache_expire(time() + (2 * 3600));
                session_id(hash("crc32", $params['name'] . "ECOID"));

                $this->implement->getSession();

                session_unset();
                $_SESSION["ssioninfo"] = ["session_id" => session_id(), "timestamp" => session_cache_expire(), "tnk" => $token, "chveml" => $params["value"]];
            }

            if (count($row2) > 0) {
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
            } else if (count($row) > 0) {
                echo json_encode(["error" => false, "status" => 200, "token" => $token]);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Verifique os dados"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        } finally {
            ob_end_flush();
            session_write_close();
            sleep(1);
        }
    }

    public function recoverPasswd($params): void
    {
        try {
            $email = 1;
            $chave = 2;
            $option = ($this->implement->isEmail($params["value"])) ? $email : $chave;
            $verification = $params["value"];
            $this->usr->passwd = $this->implement->criptPasswd($params['passwd']);


            if ($this->sql->recoverPasswd($this->usr, $verification, $option))
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "ok"]);
            else
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
