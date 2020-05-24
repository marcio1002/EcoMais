<?php
/**
 * Ecomais Webpage
 * @see  Ecomais GitHub project
 * @author Marcio Alemão <marcioalemao190@gmail.com>
 * @author Fernando Jesus <fernandodinho12@gmail.com>
 * @author Emanuel Café <emanuelcafe.santos@gmail.com>
 * @author Carlos Alberto <carlosmtr@hotmail.com.br>
 * @author Renata Genora <Renatagenora@hotmail.com>
 * @copyright 2019 Marcio Alemão
 * @license 
 */

require __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . "/src/config.php";


use CoffeeCode\Router\Router;

$router = new Router(BASE_URL);

/**
 * @namespace Web
 */
$router->namespace("Ecomais\Web");
/**
 * @link pagina principal 
 * Paginas principais como home,login,cadastro etc.
 */
$router->group(null);
$router->get("/", "WebApp:home");
$router->get("/login", "WebApp:login");
$router->get("/cadastro", "WebApp:register");
$router->get("/recuperarsenha", "WebApp:recoverPasswd");
$router->get("/recuperarsenha/novasenha","WebApp:newPasswd");
$router->get("/terms", "WebApp:terms");

$router->group("error");
$router->get("/{errCode}", "WebApp:typeError");

/**
 * @namespace Controller
 * 
 * * rotas para os metodos controllers */
$router->namespace("Ecomais\Controllers");

$router->group("manager");
$router->post("/login", "AccountManager:login");
$router->get("/logoff", "AccountManager:logoff");
$router->post("/addaccount", "AccountManager:addAccount");
$router->delete("/removeuser", "AccountManager:deleteAccount");
$router->put("/recoverpwd", "AccountManager:recoverPasswd");

/** rotas para product*/
$router->group("product");
$router->get("/", "ManagerProduct:showProduct");



$router->dispatch();

if ($router->error()) $router->redirect("/error/{$router->error()}");
