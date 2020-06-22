<?php
namespace Ecomais\Web;

use League\Plates\Engine;

class  Router
{
    protected Engine $view;

    public function __construct(){}


    private function route(?string $dir = null):void 
    {
        $dir = dirname(__DIR__, 1 ) . "/Views/" . $dir ?? dirname(__DIR__, 1 ) . "/Views/";

        $this->view = new Engine($dir,"php");

    } 

    /**
     * Http erro
     */
    public function typeError($http_err): void
    {
        $this->route();
        echo $this->view->render("httperror",[
            "errCode" => $http_err['errCode']
        ]);  
    }

    /**
     * redirecionamento da urls das telas principais
     */
    public  function home(): void
    {
        $this->route();
        echo $this->view->render("home");
    }

    public function register(): void
    {
        $this->route();
        echo $this->view->render("register");
    }

    public function registerCompany():void
    {
        $this->route();
        echo $this->view->render("registerCompany");
    }

    public function recoverPasswd(): void
    {
        $this->route();
        echo $this->view->render("recoverPasswd");
    }

    public function newPasswd($token): void
    {
        $this->route();
        echo $this->view->render("newPasswd",[
            "v" => $token
        ]);
    }

    public function terms(): void
    {
        $this->route();
        echo $this->view->render("politicaPrivacidadeTermos");
    }


    /**
     * @group Empresa
     */
    public function indexCompany(?array $param = array()): void
    {
        $this->route("Company");
        echo $this->view->render("index", $param);
    }


    public function configCompany(?array $param = array()):void
    {
        $this->route("Company");
        echo $this->view->render("configuration",$param);
    }
}
