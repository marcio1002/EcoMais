<?php

namespace Ecomais\Web;

use Ecomais\Controllers\Company\AccountManagerCompany;
use Ecomais\Controllers\User\AccountManagerUser;
use League\Plates\Engine;
use League\Plates\Extension\{Asset};
use Ecomais\Models\Implementation;
use CoffeeCode\Router\Router;


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

    private static function directory(?string $dir = null): \League\Plates\Engine
    {
        $dir = dirname(__DIR__, 1) . '/Views/' . $dir ?? dirname(__DIR__, 1) . '/Views/';
        return new Engine($dir, 'php');
    }

    /* Funções registrada pelo plates */

    /**
     * @return object|void
     */
    public  function verifyLoggedCompany()
    {
        if ($this->implement->isLogged('empresa')) {
            $this->comp->id = $_COOKIE['_id'];
            return $this->implement->toObject($this->comp->findById($_COOKIE['_id']));
        } else {
            exit($this::directory()->render('login'));
        }
    }

    /**
     * @return object|void
     */
    public  function verifyLoggedUser()
    {
        if ($this->implement->isLogged('usuario')) {
            $this->comp->id = $_COOKIE['_id'];
            return $this->implement->toObject($this->user->findById($_COOKIE['_id']));
        } else {
            exit($this::directory()->render('login'));
        }
    }

    /* Redirecionamento de páginas */

    public function test(array $params): void
    {
        if ($params['chv'] !== '0878') {
            header('location: ' . BASE_URL . '/error/404');
            exit();
        };
        echo $this::directory()->render('teste');
    }

    /**
     * Http erro
     */
    public function typeError(array $http_err): void
    {
        echo $this::directory()->render('httperror', [
            'errCode' => $http_err['errCode']
        ]);
    }

    /**
     * @group null
     * Páginas da principais
     */
    public  function home(): void
    {
        echo $this::directory()->render('home');
    }

    public function login(): void
    {
        echo $this::directory()->render('login');
    }

    public function registerUser(): void
    {
        echo $this::directory()->render('register');
    }

    public function registerCompany(): void
    {
        echo $this::directory()->render('registerCompany');
    }

    public function recoverPasswd(): void
    {
        echo $this::directory()->render('recoverPasswd');
    }

    public function newPasswd($token): void
    {
        echo $this::directory()->render('newPasswd', [
            'token' => $token['token']
        ]);
    }

    public function terms(): void
    {
        echo $this::directory()->render('politicaPrivacidadeTermos');
    }


    /**
     * @group Company
     */
    public function indexCompany(): void
    {
        echo $this::directory('Company')
            ->registerFunction('func', fn () => $this)
            ->render('index');
    }

    public function configCompany(): void
    {

        echo $this::directory('Company')
            ->registerFunction('func', fn () => $this)
            ->render('config');
    }

    public function perfilCompany(): void
    {
        echo $this::directory('Company')
            ->registerFunction('func', fn () => $this)
            ->render('perfil');
    }

    public function registerProduct(): void
    {
        echo $this::directory('Company')
            ->registerFunction('func', fn () => $this)
            ->render('registerProduct');
    }

    /**
     * @group User
     */
    public function indexUser(): void
    {
        echo $this::directory('User')
            ->registerFunction('func', fn () => $this)
            ->render('index');
    }

    public function listProduct(): void
    {
        echo $this::directory('User')
            ->registerFunction('func', fn () => $this)
            ->render('listProduct');
    }
}
