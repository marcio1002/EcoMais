<?php
namespace Ecomais\Web;

class WebApp
{
    /**
     * redirecionamento da urls
     */
    public  function home(): void
    {
        require_once __DIR__ . "/../Views/home.php";
    }

    public function register(): void
    {
        require_once __DIR__ . "/../Views/cadastro.php";
    }

    public function recoverPasswd(): void
    {
        require_once __DIR__ . "/../Views/recuperarSenha.php";
    }

    public function newPasswd(): void
    {
        require_once __DIR__ . "/../Views/novaSenha.php";
    }

    public function terms(): void
    {
        require_once __DIR__ . "/../Views/politicaPrivacidadeTermos.php";
    }

    public function login(): void
    {
        require_once __DIR__ . "/../Views/login.php";
    }
    /**
     * Http erro
     */
    public function typeError($http_err): void
    {
        $codeError = $http_err['errCode'];

        if ($codeError == 404) {
            require_once __DIR__ . "/../Views/error404.php";
        } else {
            if (session_status() == PHP_SESSION_DISABLED) session_start();
            $_SESSION['codeError'] = $codeError;
            require_once __DIR__ . "/../Views/httperror.php";
        }
    }
}
