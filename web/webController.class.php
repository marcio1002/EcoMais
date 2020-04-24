<?php
namespace Web;

    class WebApp {

        public  function home():void
        {
            require_once __DIR__."/../home.php";
        }

        public function register():void
        {
            require_once __DIR__."/../view/register.php";
        }
        
        public function typeError($http_err):void
        {
            $codeError = $http_err['errCode'] ;

            if($codeError == 404){
                require_once __DIR__."/../view/error404.php";
            } else {
                if(session_status() == PHP_SESSION_DISABLED) session_start();
                $_SESSION['codeError'] = $codeError;
                require_once __DIR__."/../view/httperror.php";
            }
        }
    }
