<?php
namespace Web;

    class WebApp {

        public  function home():void
        {
            require_once "https://ecomais.herokuapp.com/home.php";
        }

        public function register():void
        {
            require_once "https://ecomais.herokuapp.com/view/register.php";
        }

        public function terms():void 
        {
            require_once "https://ecomais.herokuapp.com/view/politicaPrivacidadeTermos.php";
        }
        
        public function typeError($http_err):void
        {
            $codeError = $http_err['errCode'] ;

            if($codeError == 404){
                require_once "https://ecomais.herokuapp.com/registro/view/error404.php";
            } else {
                if(session_status() == PHP_SESSION_DISABLED) session_start();
                $_SESSION['codeError'] = $codeError;
                require_once "https://ecomais.herokuapp.com/registro/view/httperror.php";
            }
        }
    }
