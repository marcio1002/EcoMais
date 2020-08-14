<?php

namespace Ecomais\Web;

use Ecomais\Controllers\Company\AccountManagerCompany;
use League\Plates\Engine;

class  Redirect
{
    private AccountManagerCompany $comp;

    public function __construct()
    {
        $this->comp = new AccountManagerCompany();
    }


    private function directory(?string $dir = null): \League\Plates\Engine
    {
        $dir = dirname(__DIR__, 1) . "/Views/" . $dir ?? dirname(__DIR__, 1) . "/Views/";

        return new Engine($dir, "php");
    }

    public function test(array $param): void
    {   
        if($param['chv'] !== "0878") {
            header("location: " . BASE_URL . "/error/404");
            exit();
        }

        ;
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
     * redirecionamento da urls das telas principais
     */
    public  function home(): void
    {
        echo $this->directory()->render("home");
    }

    public function login(): void
    {
        echo $this->directory()->render("login");
    }

    public function register(?array $data): void
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
        echo $this->directory("Company")->render("index");
    }

    public function configCompany():void
    {        
        if (isset($_COOKIE['_id'])) $row = $this->comp->listenInfoCompany($_COOKIE['_id']);

        echo $this->directory("Company")->render("config", $row ?? []);
    }

    public function perfilCompany(): void
    {
        if (isset($_COOKIE['_id'])) $row = $this->comp->listenInfoCompany($_COOKIE['_id']);

        echo $this->directory("Company")->render("perfil", $row ?? []);
    }

    public function registerProduct(): void
    {
        if (isset($_COOKIE['_id'])) $row = $this->comp->listenInfoCompany($_COOKIE['_id']);

        echo $this->directory("Company")->render("registerProduct", $row ?? []);
    }

    /**
     * @group User
     */
    public function indexUser(): void
    {
        echo $this->directory("User")->render("index");
    }

    public function listProduct(): void
    {
        echo $this->directory("User")->render("listProduct");
    }
}
