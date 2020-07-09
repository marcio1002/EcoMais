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

/*
 * Rotas mostrada para o usuario são mostrada em português (pt-BR)
 */

require __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . "/src/config.php";


use CoffeeCode\Router\Router;

ob_start();
ob_clean();
$router = new Router(BASE_URL);

/**
 * @namespace Web
 * @link pagina principal 
 * Paginas principais como home,login,cadastro etc.
 */
$router->namespace("Ecomais\Web");

    $router->group(null);
    $router->get("/", "Router:home");
    $router->get("/login", "Router:login");
    $router->get("/cadastro", "Router:register");
    $router->get("/cadastro/empresa","Router:registerCompany");
    $router->get("/recuperarsenha", "Router:recoverPasswd");
    $router->get("/recuperarsenha/novasenha/{token}","Router:newPasswd");
    $router->get("/politica-privacidade-e-termos", "Router:terms");
    $router->get("/teste/{chv}","Router:test");

    $router->group("error");
    $router->get("/{errCode}", "Router:typeError");

/**
 * @group Empresa
 */
    $router->group("empresa");
    $router->get("/","Router:indexCompany");
    $router->get("/configuracoes","Router:configCompany");

/**
 * @group User
 */
    $router->group("user");
    $router->get("/","Router:indexUser");

/**
 * @namespace Controller
 * 
 * rotas para os metodos controllers 
 * */
$router->namespace("Ecomais\Controllers");

    $router->group("manager");
    $router->post("/login", "Main:login");
    $router->get("/logoff", "Main:logoff");
    $router->get("/logingoogle","Main:loginAuthGoogle");
    $router->get("/registergoogle","Main:registerAuthGoogle");
    $router->post("/recoverByKey", "Main:recoverByKey");
    $router->post("/recoverByMail", "Main:recoverByMail");
    $router->put("/recoverpasswd", "Main:recoverPasswd");
    $router->post("/newsletter","Main:newsLetter");


/** rotas para Usuários */
$router->namespace("Ecomais\Controllers\User");

    $router->group("manager");
    $router->post("/addaccountpersonphysical", "AccountManagerUser:createAccount");

/** rotas para Empresas*/
$router->namespace("Ecomais\Controllers\Company");
    
    $router->group("manager");
    //--- Api Pagamento ---

$router->namespace("Ecomais\Controllers\Product");

    $router->group("manager");
    $router->post("/addproduct","ProductManager:createProduct");
    $router->put("/setstatus","ProductManager:setStatus");
    $router->post("/searchproduct","ProductManager:searchProd");

$router->dispatch();

if ($router->error()) $router->redirect("/error/{$router->error()}");

$content =  ob_get_contents();
ob_end_clean();

echo $content;

mb_http_output('UTF-8');