<?php
namespace Ecomais\Web;

use League\Plates\Engine;

class  Router
{
    protected Engine $view;

    public function __construct(){}


    private function route(?string $dir = null):void 
    {
        $dir = __DIR__ . "/../Views/" . $dir ?? dirname(__DIR__, 2 ) . "/Views/";

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


    /**
     * @group Empresa
     */
    public function indexCompany(?array $param = array()): void
    {
        $this->route("company");
        echo $this->view->render("index", $param);
    }


    public function configCompany(?array $param = array()):void
    {
        $this->route("company");
        echo $this->view->render("configuration",$param);
    }
}
