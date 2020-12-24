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
 * @package marcio1002/render-file - Renderizar arquivos js e css
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
$router
    ->namespace("Ecomais\Web")
    ->group(null);

$router->get("/", "Redirect:home", "home");
$router->get("/login", "Redirect:login", "home.login");
$router->get("/cadastro", "Redirect:registerUser", "home.cadastro");
$router->get("/cadastro/empresa", "Redirect:registerCompany", "home.empresa");
$router->get("/recuperarsenha", "Redirect:recoverPasswd", "home.recuperarsenha");
$router->get("/recuperarsenha/novasenha/{token}", "Redirect:newPasswd", "home.novasenha");
$router->get("/politica-privacidade-e-termos", "Redirect:terms", "home.politicahp");
$router->get("/teste/{chv}", "Redirect:test");

$router->group("error");
$router->get("/{errCode}", "Redirect:typeError", "httperro");

/**
 * @group Empresa
 */
$router->group("company");
$router->get("/", "Redirect:indexCompany", "company.index");
$router->get("/configuracoes", "Redirect:configCompany", "company.configuracoes");
$router->get("/cadastro-de-produtos", "Redirect:registerProduct", "company.cadastroprodutos");
$router->get("/perfil", "Redirect:perfilCompany", "company.perfil");

/**
 * @group User
 */
$router->group("user");
$router->get("/", "Redirect:indexUser", "user.index");
$router->get("/listadeprodutos", "Redirect:listProduct", "user.listarprodutos");

/**
 * @namespace Controller
 * 
 * rotas para os métodos de manipulações e controllers dos dados
 * */
$router
    ->namespace("Ecomais\Controllers")
    ->group("manager");

$router->post("/login", "Main:login","manager.login");
$router->get("/logoff", "Main:logoff","manager.logoff");
$router->get("/logingoogle", "Main:loginAuthGoogle","manager.loginauthgoogle");
$router->get("/registergoogle", "Main:registerAuthGoogle","manager.registerauthgoogle");
$router->post("/getoauthurl", "Main:getOauthUrl","manager.getoauthurl");
$router->post("/recoverByKey", "Main:recoverByKey","manager.recoverbykey");
$router->post("/recoverByMail", "Main:recoverByMail","manager.recoverbymail");
$router->put("/recoverpasswd", "Main:recoverPasswd","manager.recoverpasswd");
$router->post("/newsletter", "Main:newsLetter","manager.newsletter");

/** rotas para Usuários */
$router
    ->namespace("Ecomais\Controllers\User")
    ->group("manager");

$router->post("/addaccountpersonphysical", "AccountManagerUser:createAccount","manager.user.addaccountpersonphysical");

/** rotas para Empresas*/
$router
    ->namespace("Ecomais\Controllers\Company")
    ->group("manager");

$router->post("/addaccountpersonlegal", "AccountManagerCompany:createAccount","manager.company.createaccount");
$router->get("/listencompany", "AccountManagerCompany:findAll","manager.company.findall");
$router->post("/findcompany", "AccountManagerCompany:findByIdJSON","manager.company.findbyidjson");
$router->get("/listencompanypro", "AccountManagerCompany:listenCompanyPro","manager.company.listencompanypro");
$router->put("/updateinfocompany", "AccountManagerCompany:updateInfoCompany","manager.company.updateinfocompany");
$router->post("/updateimagecompany", "AccountManagerCompany:updateImageCompany","manager.company.updateimagecompany");
$router->post("/searchcompany", "AccountManagerCompany:searchCompany","manager.company.searchcompany");

$router
    ->namespace("Ecomais\Controllers\Product")
    ->group("manager");

$router->post("/addproduct", "ProductManager:createProduct","manager.product.createproduct");
$router->put("/setstatus", "ProductManager:setStatus","manager.product.setstatus");
$router->post("/searchproduct", "ProductManager:searchProd","manager.product.searchprod");

$router->dispatch();

if ($router->error()) $router->redirect("/error/{$router->error()}");

function renderUrl(string $url = "home", ?array $params = null): string
{
    global $router;
    
    $baseUrl = BASE_URL;
    if (preg_match("/^[\w]+\.[\w+\.+]*[\w]$/", $url) || preg_match("/^(home)$/", $url))
        return $router->route($url, $params);
    else
        return ($url <=> "home") == 0 ? $baseUrl : "$baseUrl$url";
}


ob_end_flush();
mb_http_output('UTF-8');
