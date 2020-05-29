<?php
namespace Ecomais\Controllers;

use Ecomais\Models\{DataException, PersonLegal, PersonPhysical, Safety};
use Ecomais\ControllersServices\AccountHandling;
use Ecomais\Services\EmailECM;

class AccountManager
{
    private $account;
    private $usrPhysical;
    private $usrLegal;
    private $safety;
    private $email;

    function __construct()
    {
        $this->account = new AccountHandling();
        $this->usrLegal = new PersonLegal();
        $this->usrPhysical = new PersonPhysical();
        $this->safety = new Safety();
        $this->email = new EmailECM();
    }

    public function  addAccountPersonPhysical($param): void
    {
        try {

            $this->usrPhysical->setName($param['name']);
            $this->usrPhysical->setEmail($param['email']);
            $this->usrPhysical->setPassword($param['passwd']);
            $this->usrPhysical->setCep($param['cep']);
            $this->usrPhysical->setUF($param['uf']);
            $this->usrPhysical->setAddres($param['addres']);
            $this->usrPhysical->setLocality($param['localidade']);
            $this->usrPhysical->setStatusAccount(1);

            if ($this->account->createAccountPersonPhysical($this->usrPhysical)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]); 
            }
        } catch (DataException $ex) {
            die(header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}"));
        }
    }

    public function updateAccount(): void
    {
        try {

            $this->usr->setName($_POST['name']);
            $this->usr->setEmail($_POST['email']);
            $this->usr->setPassword($_POST['passwd']);
            $this->usr->setId($_POST['id']);


            if ($this->account->updateAccount($this->usr)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"],);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}"); 
        }
    }

    public function  deleteAccount($person): void
    {
        try {

            $this->usr->setId($person['id']);

            if ($this->account->deleteAccount($this->usr)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"],);
            } else {
                echo json_encode(["error" => true, "status" => 404, "msg" => ""]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}"); 
        }
    }
    // login server para os dois tipos de usuario empresa/usuario
    public function login($person): void
    {
        try {
            $this->usrPhysical->setEmail($person['email']);
            $this->usrPhysical->setPassword($person['passwd']);
            $temp = time() + (24 * 36000);

            if ($res = $this->account->setLogin($this->usrPhysical)) {
                
                if($person['conectedLogin'] == 18) $temp = time() + (1 * 12 * 30 * 24 * 3600);

                $this->usrPhysical->setId($res['id_usuario']);
                
                $token =  md5("ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}");
                session_name($token);

                if (session_status() == PHP_SESSION_DISABLED) session_start();

                setcookie('_id', $this->usrPhysical->getId(), $temp, '/', "", false, true);
                setcookie('_token', $token, $temp, '/', "", false, true);
                
                echo json_encode(["error" => false, "status" => 200, "msg" => "Ok"]);
                
            } else {
                echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]); 
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}");
        }
        finally 
        { 
            if(session_status() == PHP_SESSION_ACTIVE) session_destroy();
        }
    }

    public function logoff(): void
    {
        if (session_status() == PHP_SESSION_DISABLED) session_start();

        if (!empty($_COOKIE['_id']) && !empty($_COOKIE['_token'])) 
        {
            setcookie('_id', "", 0, "/");
            setcookie('_token', "", 0, "/");
           
            header("location:" . BASE_URL);
        } else 
        {
           
            header("location: " . BASE_URL . "/product");
        }
       if(session_status() == PHP_SESSION_ACTIVE) session_destroy();
    }
// recuperar senha server para os dois tipos de usuario empresa/usuario
    public function recoverPasswd($param):void 
    {
        try {
            $font1 = "padding:0;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif";
            $font2 ="font-size:20px;font-weight:600;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif;color:#272726;display:inline-block;padding:16px 24px;text-decoration:none";
            $font3 = "font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif";
            $background = "https://ci4.googleusercontent.com/proxy/zi2B0d_rqBrjZUnbvWBsWVB8fe8l8zm2FoPZ47PHEU2ogMXdxR09xVIKWM8QHcCmFCTyyzH0kRR1HLgukAU2J3cKuZGRln3KRpGokTAh0qER=s0-d-e1-ft#https://img.fortawesome.com/349cfdf6/tile-info-icons-misc1.png";
            
            if($param['option'] == 0) { 
                $token = $this->safety->createToken($param["value"]);         
                $this->email->add(
                    "Seu pedido de recuperação de senha no EcoMais",
                    "
                    <div id=':19t' class='ii gt'>
                    <div id=':19s' class='a3s aXjCH undefined' dir='ltr'><u></u>
                        <div bgcolor='#f8f9fa'>
                            <table width='100%' cellspacing='0' cellpadding='0' border='0'>
                                <tbody>
                                    <tr>
                                        <td style='padding:50px 15px 25px 15px' class='m_3883943874581931121mobile-padding' width='100%' valign='top' bgcolor='#f8f9fa' align='center'>
                                            <table class='m_3883943874581931121mobile-wrapper' width='600' cellspacing='0' cellpadding='0' border='0' align='center'>
                                                <tbody></tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding:25px 15px 25px 15px' class='m_3883943874581931121mobile-padding'
                                            width='100%' valign='top' height='100%' bgcolor='#f8f9fa' align='center'>
                                            <table class='m_3883943874581931121mobile-wrapper' width='600' cellspacing='0' cellpadding='0' border='0' align='center'>
                                                <tbody>
                                                    <tr>
                                                        <td style=$font1 valign='top' align='center'>
                                                            <table width='100%' cellspacing='0' cellpadding='0' border='0'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style='border-radius:8px 8px 0 0;padding:40px;background:#1864ab url($background);border-bottom:4px solid #155591'  align='center'>
                                                                            <table width='100%' cellspacing='0' cellpadding='0' border='0'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align='left'>
                                                                                            <p style='color:#a3daff;font-size:20px;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:1.25px;line-height:24px;margin:0 0 20px 0;display:block' >
                                                                                                Olá! 
                                                                                            </p>
                                                                                            <h2 style='font-size:32px;font-weight:600;color:#f8f9fa;margin:0 0 20px 0'>
                                                                                                $param[name] 
                                                                                            </h2>
                                                                                            <p
                                                                                                style='color:#a3daff;font-size:20px;line-height:30px;margin:0'>
                                                                                                Para redefinir sua senha click no
                                                                                                botão logo abaixo, você será redirecionado para a tela de recupação de senha.<br/><strong>A url se expira em um dia.</strong>
                                                                                            </p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='padding:0;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif'  valign='top' align='center'>
                                                            <table width='100%' cellspacing='0' cellpadding='0' border='0'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style='border-radius:0 0 8px 8px; padding:40px 40px 0 40px' bgcolor='#ffffff' align='center'>
                                                                            <table width='100%' cellspacing='0' cellpadding='0' border='0'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style='text-decoration: none;font-weight: 700;font-size: 25px; background-color:#FEF56F;border-radius:4px;border: 1px solid #F1E53D; border-bottom: 3px solid #F1E53D; border-right: 3px solid #F1E53D; padding:20px;' align='center'>
                                                                                            <a style='text-decoration:none' href='https://www.localhost/www/EcoMais/recuperarsenha/novasenha/$token' style='$font2' target='_blank'>Redefinir minha senha</a> 
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style='border-radius:0 0 8px 8px;padding:40px' bgcolor='#ffffff' align='center'>
                                                                            <table width='100%' cellspacing='0' cellpadding='0' border='0'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style=$font3 align='left'>
                                                                                            <h3>
                                                                                                <p style='color:#a3daff;font-size:20px;line-height:30px;margin:0'>
                                                                                                    Se este endereço de email não é
                                                                                                    o seu ignore-o.
                                                                                                </p>
                                                                                            </h3>
                                                                                            <p style='color:#868e96;font-size:16px;line-height:24px;margin:0'>
                                                                                                O EcoMais sempre buscando o melhor
                                                                                                para você a sua economia. Você pode ler
                                                                                                mais sobre os 
                                                                                            <a href='#' style='color:#329af0' target='_blank'>termos de serviço</a> 
                                                                                            para as contas bem a nossa 
                                                                                            <a href='https://www.localhost/www/EcoMais/terms' style='color:#329af0' target='_blank'> política de  privacidade</a> , se você gostaria. </p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding:25px 15px 50px 15px' class='m_3883943874581931121mobile-padding' width='100%' valign='top' height='100%' bgcolor='#f8f9fa' align='center'>
                                            <table class='m_3883943874581931121mobile-wrapper' width='600' cellspacing='0' cellpadding='0' border='0' align='center'>
                                                <tbody>
                                                    <tr>
                                                        <td style='padding:0 0 15px 0' valign='top' align='center'> 
                                                        <a style='display:block' width='33' height='33' bo  alt='Acessar website ecomais' target='_blank'>
                                                            <svg aria-hidden='true' focusable='false' data-prefix='fad' data-icon='shopping-cart' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512' class='svg-inline--fa fa-shopping-cart fa-w-18 fa-3x'><g class='fa-group'><path fill='currentColor' d='M552 64H159.21l52.36 256h293.15a24 24 0 0 0 23.4-18.68l47.27-208a24 24 0 0 0-18.08-28.72A23.69 23.69 0 0 0 552 64z' class='fa-secondary'></path><path fill='currentColor' d='M218.12 352h268.42a24 24 0 0 1 23.4 29.32l-5.52 24.28a56 56 0 1 1-63.6 10.4H231.18a56 56 0 1 1-67.05-8.57L93.88 64H24A24 24 0 0 1 0 40V24A24 24 0 0 1 24 0h102.53A24 24 0 0 1 150 19.19z' class='fa-primary'></path></g></svg>
                                                        </a> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='padding:0 0 5px 0;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif;color:#868e96'
                                                            valign='top' align='center'>
                                                            <p style='font-size:14px;line-height:20px;color:#868e96'> 
                                                            <a href='#' style='color:#adb5bd' target='_blank'>Descontos</a> • 
                                                            <a href='#' style='color:#adb5bd' target='_blank'>Sua Conta</a> •
                                                            <a href='#' style='color:#adb5bd' target='_blank'>Fale Conosco</a>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style='padding:0 0 5px 0;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif;color:#adb5bd'
                                                            valign='top' align='center'>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                ",
                    $param["name"],
                    $param["value"],
                )->send();
            } else {
                if($this->account->recoverPasswdKey($param["value"]))
                    echo json_encode(["error" => false, "status" => 200, "msg" => $param["name"]]);
                else 
                    echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Found"]);
            }


        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} {$ex->getMessage()}"); 
        }
    }
}
