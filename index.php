<?php
require __DIR__.'/./vendor/autoload.php';

require_once "./config.php";


use CoffeeCode\Router\Router;



header('Access-Control-Allow-Origin: *');   
header('Access-Control-Allow-Headers: X-PINGARUNER');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Content-type: text/html');

$router = new Router(BASE_URL);

/**
 * @namespace Web
 */
$router->namespace("Web");
/**
 * @link pagina principal home
 */
$router->group(null);
$router->get("/","WebApp:home");
$router->get("/registro","WebApp:register");
$router->get("/terms","WebApp:terms");

$router->group("error");
$router->get("/{errCode}","WebApp:typeError");

/**
 * @namespace Controller
 * 
 * * rotas para os metodos controllers */
$router->namespace("Controller");

$router->group("manager");
$router->post("/login","AccountManager:login");
$router->get("/logoff","AccountManager:logoff");
$router->post("/addconta","AccountManager:addAccount");
$router->post("/removeusuario","AccountManager:deleteAccount");
$router->put("/recuperasenha","Account:recoverPasswd");

/** rotas para product*/
$router->group("product");
$router->get("/","ManagerProduct:showProduct");



$router->dispatch();

if($router->error()) $router->redirect("/error/{$router->error()}");