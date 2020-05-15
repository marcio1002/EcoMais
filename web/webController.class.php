<?php
namespace Web;

    class WebApp {

        /**
         * redirecionamento da urls
         */
        public  function home():void
        {
            require_once __DIR__ . "/../views/index.php";
        }

        public function register():void
        {
            require_once __DIR__ . "/../views/cadastro.php";
        }

        public function recoverPasswd():void
        {
            require_once __DIR__ . "/../views/recuperarSenha.php";
        }

        public function terms():void 
        {
           require_once __DIR__ . "/../views/politicaPrivacidadeTermos.php"; 
        }

        public function login():void
        {
            require_once __DIR__ . "/../views/login.php";
        }
        /**
         * Http erro
         */
        public function typeError($http_err):void
        {
            $codeError = $http_err['errCode'] ;

            if($codeError == 404){
                require_once __DIR__ . "/../views/error404.php";
            } else {
                if(session_status() == PHP_SESSION_DISABLED) session_start();
                $_SESSION['codeError'] = $codeError;
                require_once __DIR__ . "/../views/httperror.php";
            }
        }
    }
