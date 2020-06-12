<?php
namespace Ecomais\Web;

use League\Plates\Engine;

class Router
{
    private Engine $view;
    private Engine $viewCompany;
    private Engine $viewUser;

    public function __construct()
    {
        $this->view  = new Engine(__DIR__ . "/../Views","php");
        $this->viewCompany = new Engine(__DIR__ . "/../Views/company","php");
        $this->viewUser = new Engine(__DIR__ . "/../Views/user","php");
    }

    /**
     * Http erro
     */
    public function typeError($http_err): void
    {
        echo $this->view->render("httperror",[
            "errCode" => $http_err['errCode']
        ]);  
    }

    /**
     * redirecionamento da urls das telas principais
     */
    public  function home(): void
    {
        echo $this->view->render("home");
    }

    public function register(): void
    {
        echo $this->view->render("cadastro");
    }

    public function recoverPasswd(): void
    {
        require_once __DIR__ . "/../Views/recuperarSenha.php";
    }

    public function newPasswd($token): void
    {
        if(count($token) == 0 ) $this->typeError([
            "errCode" => "404"
        ]);
        require_once __DIR__ . "/../Views/novaSenha.php";
    }

    public function terms(): void
    {
        require_once __DIR__ . "/../Views/politicaPrivacidadeTermos.php";
    }

    public function loginTeste():void
    {
        require_once __DIR__ . "/../Views/login.php";
    }


    /**
     * @group Empresa
     */
    public function indexCompany(?array $param = array()): void
    {
        echo $this->viewCompany->render("index", $param);
    }


    public function configCompany(?array $param = array()):void
    {
        echo $this->viewCompany->render("configuration",$param);
    }
}
