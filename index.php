<?php
/**
 * Ecomais Webpage
 * @see  Ecomais GitHub project
 * @author Marcio Alemão <marcioalemao190@gmail.com>
 * @author Carlos Alberto <carlosmtr@hotmail.com.br>
 * @author Renata Genora <Renatagenora@hotmail.com>
 * @author Fernando Jesus <fernandodinho12@gmail.com>
 * @author Emanuel Café <emanuelcafe.santos@gmail.com>
 * @copyright 2019 Ecomais
 * @license 
 */

 /**
  * Dependências do projeto
  * @package coffeecode/router - Gerenciamento de rotas http
  * @package phpmailer/phpmailer - Envio de emails
  * @package league/plates - Criação de templates
  * @package league/oauth2-google - Autenticação com a conta do Google
  * @package coffeecode/uploader - Upload de imagens
  */

/*
 * Rotas vista pelos usuários são mostrada em português (pt-BR)
 */

require_once __DIR__ . "/vendor/autoload.php";

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
    $router->get("/", "Redirect:home","home");
    $router->get("/login", "Redirect:login","home.login");
    $router->get("/cadastro", "Redirect:registerUser","home.cadastro");
    $router->get("/cadastro/empresa","Redirect:registerCompany","home.empresa");
    $router->get("/recuperarsenha", "Redirect:recoverPasswd","home.recuperarsenha");
    $router->get("/recuperarsenha/novasenha/{token}","Redirect:newPasswd","home.novasenha");
    $router->get("/politica-privacidade-e-termos", "Redirect:terms","home.politicahp");
    $router->get("/teste/{chv}","Redirect:test");

    $router->group("error");
    $router->get("/{errCode}", "Redirect:typeError","httperro");

/**
 * @group Empresa
 */
    $router->group("empresa");
    $router->get("/","Redirect:indexCompany","empresa.index");
    $router->get("/configuracoes","Redirect:configCompany","empresa.configuracoes");
    $router->get("/cadastro-de-produtos","Redirect:registerProduct","empresa.cadastroprodutos");
    $router->get("/perfil","Redirect:perfilCompany","empresa.perfil");

/**
 * @group User
 */
    $router->group("usuario");
    $router->get("/","Redirect:indexUser","usuario.index");
    $router->get("/listadeprodutos","Redirect:listProduct","usuario.listarprodutos");

/**
 * @namespace Controller
 * 
 * rotas para os métodos de manipulações e controllers dos dados
 * */
$router->namespace("Ecomais\Controllers");

    $router->group("manager");
    $router->post("/login", "Main:login");
    $router->get("/logoff", "Main:logoff");
    $router->get("/logingoogle","Main:loginAuthGoogle");
    $router->get("/registergoogle","Main:registerAuthGoogle");
    $router->post("/getoauthurl","Main:getOauthUrl");
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
    $router->get("/listencompany","AccountManagerCompany:findAll");
    $router->post("/findcompany", "AccountManagerCompany:findByIdJSON");
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


ob_end_flush();
mb_http_output('UTF-8');