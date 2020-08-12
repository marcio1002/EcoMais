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
 * Rotas vista pelos usuários são mostrada em português (pt-BR)
 */

require __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . "/src/config/config.php";


$router = new CoffeeCode\Router\Router(BASE_URL);

ob_start();
ob_clean();
/**
 * @namespace Web
 * @link pagina principal 
 * Paginas principais como home,login,cadastro etc.
 */
$router->namespace("Ecomais\Web");

    $router->group(null);
    $router->get("/", "Redirect:home");
    $router->get("/login", "Redirect:login");
    $router->get("/cadastro", "Redirect:register");
    $router->get("/cadastro/empresa","Redirect:registerCompany");
    $router->get("/recuperarsenha", "Redirect:recoverPasswd");
    $router->get("/recuperarsenha/novasenha/{token}","Redirect:newPasswd");
    $router->get("/politica-privacidade-e-termos", "Redirect:terms");
    $router->get("/teste/{chv}","Redirect:test");

    $router->group("error");
    $router->get("/{errCode}", "Redirect:typeError");

/**
 * @group Empresa
 */
    $router->group("empresa");
    $router->get("/","Redirect:indexCompany");
    $router->get("/configuracoes","Redirect:configCompany");
    $router->get("/cadastro-de-produtos","Redirect:registerProduct");
    $router->get("/perfil","Redirect:perfilCompany");

/**
 * @group User
 */
    $router->group("usuario");
    $router->get("/","Redirect:indexUser");
    $router->get("/listadeprodutos","Redirect:listProduct");

/**
 * @namespace Controller
 * 
 * rotas para os métodos controllers 
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
    $router->post("/addaccountpersonlegal","AccountManagerCompany:createAccount");
    $router->get("/listencompany","AccountManagerCompany:listenCompany");
    $router->get("/listencompanypro","AccountManagerCompany:listenCompanyPro");
    $router->put("/updateinfocompany","AccountManagerCompany:updateInfoCompany");
    $router->post("/updateimagecompany","AccountManagerCompany:updateImageCompany");
    $router->post("/searchcompany","AccountManagerCompany:searchCompany");

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