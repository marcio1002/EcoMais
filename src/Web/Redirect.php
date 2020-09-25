<?php

namespace Ecomais\Web;

use Ecomais\Controllers\Company\AccountManagerCompany;
use Ecomais\Controllers\User\AccountManagerUser;
use League\Plates\Engine;
use Ecomais\Models\Implementation;

class  Redirect
{
    private Implementation $implement;
    private AccountManagerCompany $comp;
    private AccountManagerUser $user;

    public function __construct()
    {
        $this->comp = new AccountManagerCompany();
        $this->implement = new Implementation();
        $this->user = new AccountManagerUser();
    }

    private function directory(?string $dir = null): \League\Plates\Engine
    {
        $dir = dirname(__DIR__, 1) . "/Views/" . $dir ?? dirname(__DIR__, 1) . "/Views/";

        return new Engine($dir, "php");
    }

                                /* Funções registrada pelo plates */

    /**
     * @return object|void
     */
    public  function verifyLoggedCompany()
    {        
        if ($this->implement->isLogged("empresa")) {
            $this->comp->id = $_COOKIE['_id'];
            return $this->implement->toObject($this->comp->findById($_COOKIE['_id']));
        } else {
            exit($this->directory()->render("login"));        
        }
    }

    /**
     * @return object|void
     */
    public  function verifyLoggedUser()
    {        
        if ($this->implement->isLogged("usuario")) {
            $this->comp->id = $_COOKIE['_id'];
            return $this->implement->toObject($this->user->findById($_COOKIE['_id']));
        } else {
            exit($this->directory()->render("login"));
        }
    }

                                /* Redirecionamento de páginas */

    public function test(array $params): void
    {
        if ($params['chv'] !== "0878") {
            header("location: " . BASE_URL . "/error/404");
            exit();
        };
        echo $this->directory()->render("teste");
    }

    /**
     * Http erro
     */
    public function typeError(array $http_err): void
    {
        echo $this->directory()->render("httperror", [
            "errCode" => $http_err['errCode']
        ]);
    }

    /**
     * @group null
     * Páginas da principais
     */
    public  function home(): void
    {
        echo $this->directory()->render("home");
    }

    public function login(): void
    {
        echo $this->directory()->render("login");
    }

    public function registerUser(?array $data): void
    {
        echo $this->directory()->render("register", [
            "data" => $data
        ]);
    }

    public function registerCompany(): void
    {
        echo $this->directory()->render("registerCompany");
    }

    public function recoverPasswd(): void
    {
        echo $this->directory()->render("recoverPasswd");
    }

    public function newPasswd($token): void
    {
        echo $this->directory()->render("newPasswd", [
            "token" => $token["token"]
        ]);
    }

    public function terms(): void
    {
        echo $this->directory()->render("politicaPrivacidadeTermos");
    }


    /**
     * @group Company
     */
    public function indexCompany(): void
    {
        echo $this->directory("Company")
            ->registerFunction("func", fn() => $this)
            ->render("index");
    }

    public function configCompany(): void
    {
        if (isset($_COOKIE['_id'])) $row = $this->comp->listenInfoCompany($_COOKIE['_id']);

        echo $this->directory("Company")
            ->registerFunction("func", fn() => $this)
            ->render("config",  ["data" => $this->implement->toObject($row)]);
    }

    public function perfilCompany(): void
    {
        if (isset($_COOKIE['_id'])) $row = $this->comp->listenInfoCompany($_COOKIE['_id']);

        echo $this->directory("Company")
            ->registerFunction("func", fn() => $this)
            ->render("perfil", $row ?? []);
    }

    public function registerProduct(): void
    {
        if (isset($_COOKIE['_id'])) $row = $this->comp->listenInfoCompany($_COOKIE['_id']);

        echo $this->directory("Company")
            ->registerFunction("func", fn() => $this)
            ->render("registerProduct", $row ?? []);
    }

    /**
     * @group User
     */
    public function indexUser(): void
    {
        echo $this->directory("User")
            ->registerFunction("func",fn() => $this)
            ->render("index");
    }

    public function listProduct(): void
    {
        echo $this->directory("User")
            ->registerFunction("func",fn() => $this)
            ->render("listProduct");
    }
}
