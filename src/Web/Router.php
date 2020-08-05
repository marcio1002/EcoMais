<?php

namespace Ecomais\Web;

use Ecomais\Controllers\Company\AccountManagerCompany;
use League\Plates\Engine;

class  Router
{
    private Engine $view;
    private AccountManagerCompany $comp;

    public function __construct()
    {
        $this->comp = new AccountManagerCompany();
    }


    private function directory(?string $dir = null): void
    {
        $dir = dirname(__DIR__, 1) . "/Views/" . $dir ?? dirname(__DIR__, 1) . "/Views/";

        $this->view = new Engine($dir, "php");
    }

    public function test(array $param): void
    {   
        if($param['chv'] !== "0878") {
            header("location: " . BASE_URL . "/error/404");
            exit();
        }

        $this->directory();
        echo $this->view->render("teste");
    }

    /**
     * Http erro
     */
    public function typeError(array $http_err): void
    {
        $this->directory();
        echo $this->view->render("httperror", [
            "errCode" => $http_err['errCode']
        ]);
    }

    /**
     * redirecionamento da urls das telas principais
     */
    public  function home(): void
    {
        $this->directory();
        echo $this->view->render("home");
    }

    public function login(): void
    {
        $this->directory();
        echo $this->view->render("login");
    }

    public function register(?array $data): void
    {
        $this->directory();
        echo $this->view->render("register", [
            "data" => $data
        ]);
    }

    public function registerCompany(): void
    {
        $this->directory();
        echo $this->view->render("registerCompany");
    }

    public function recoverPasswd(): void
    {
        $this->directory();
        echo $this->view->render("recoverPasswd");
    }

    public function newPasswd($token): void
    {
        $this->directory();
        echo $this->view->render("newPasswd", [
            "v" => $token
        ]);
    }

    public function terms(): void
    {
        $this->directory();
        echo $this->view->render("politicaPrivacidadeTermos");
    }


    /**
     * @group Company
     */
    public function indexCompany(): void
    {
        $this->directory("Company");
        echo $this->view->render("index");
    }

    public function configCompany():void
    {
        $this->directory("Company");
        if (isset($_COOKIE['_id'])) $row = $this->comp->listenInfoCompany($_COOKIE['_id']);

        echo $this->view->render("config", $row ?? []);
    }

    public function perfilCompany(): void
    {
        $this->directory("Company");
        if (isset($_COOKIE['_id'])) $row = $this->comp->listenInfoCompany($_COOKIE['_id']);

        echo $this->view->render("perfil", $row ?? []);
    }

    public function registerProduct(): void
    {
        $this->directory("Company");
        if (isset($_COOKIE['_id'])) $row = $this->comp->listenInfoCompany($_COOKIE['_id']);

        echo $this->view->render("registerProduct", $row ?? []);
    }

    /**
     * @group User
     */
    public function indexUser(): void
    {
        $this->directory("User");
        echo $this->view->render("index");
    }

    public function listProduct(): void
    {
        $this->directory("User");
        echo $this->view->render("listProduct");
    }
}
