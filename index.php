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
$router->get("/", "Router:home");
$router->get("/cadastro", "Router:register");
$router->get("/recuperarsenha", "Router:recoverPasswd");
$router->get("/recuperarsenha/novasenha/t={token}","Router:newPasswd");
$router->get("/terms", "Router:terms");

$router->group("error");
$router->get("/{errCode}", "Router:typeError");

/**
 * @namespace Controller
 * 
 * * rotas para os metodos controllers */
$router->namespace("Ecomais\Controllers");

$router->group("manager");
$router->post("/login", "AccountManager:login");
$router->get("/logoff", "AccountManager:logoff");
$router->post("/addaccountpersonphysical", "AccountManager:addAccountPersonPhysical");
$router->delete("/removeuser", "AccountManager:deleteAccount");
$router->post("/recoverByKey", "AccountManager:recoverByKey");
$router->post("/recoverByMail", "AccountManager:recoverByMail");

/** rotas para produtos*/
$router->group("produto");
$router->get("/", "ManagerProduct:showProduct");


/** rotas para empresas */
$router->group("empresa");


$router->dispatch();

if ($router->error()) $router->redirect("/error/{$router->error()}");
