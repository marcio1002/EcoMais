<?php
require __DIR__.'/./vendor/autoload.php';

require_once "./config.php";


use CoffeeCode\Router\Router;


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

$router->group("error");
$router->get("/{errCode}","WebApp:typeError");

/**
 * @namespace Controller
 */
$router->namespace("Controller");
/** rotas para os metodos controllers */
$router->group("manager");
$router->post("/","AccountManager:login");

/** rotas para product*/
$router->group("product");
$router->get("/","ComponenteElement:showImages");



$router->dispatch();

if($router->error())$router->redirect("/error/{$router->error()}");