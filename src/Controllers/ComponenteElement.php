<?php
namespace Ecomais\Controllers;
use Ecomais\Models\DataException;
use Ecomais\Web\Bundles;

class ComponenteElement
{
  public static function navBarHome(): void
  {
    $urlRegister = BASE_URL . '/cadastro';
    $logo = BASE_URL . '/src/assets/imgs/ecomais-logo-sem-fundo.png';
    $index = BASE_URL;
echo <<<navBar
      <div class='container' id='nav-container'>
        <nav class='navbar navbar-expand-lg fixed-top navbar-dark'>
          <a class='navbar-brand' href='$index' >
            <img id='logo' src='$logo' alt='ecom'>
          </a>
          <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbar-links'
            aria-controls='navbar-links' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
          </button>
          <div class='collapse navbar-collapse justify-content-end' id='navbar-links'>
            <div class='navbar-nav'>
              <a class='nav-item nav-link item-hover position-relative' id='home-menu' href='{$index}'>Home</span></a>
              <a class='nav-item nav-link item-hover position-relative' id='about-menu' href='$urlRegister' >Cadastre-se</a>
              <a class='nav-item nav-link item-hover position-relative' id='services-menu' href='#'>Serviços</a>
              <a class='nav-item nav-link item-hover position-relative' id='portfolio-menu' href='#'>Projetos</a>
              <a class='nav-item nav-link item-hover position-relative' id='contact-menu' data-toggle='modal' data-target='#modalLogin' href=''>Entrar</a>
            </div>
          </div> 

        </nav>
      </div>
    </header>
          <header>
      <div class='container' id='nav-container'>
        <nav class='navbar navbar-expand-lg fixed-top navbar-dark'>
          <a class='navbar-brand' href='$index' >
            <img id='logo' src='$logo' alt='ecom'>
          </a>
          <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbar-links'
            aria-controls='navbar-links' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
          </button>
          <div class='collapse navbar-collapse justify-content-end' id='navbar-links'>
            <div class='navbar-nav'>
              <a class='nav-item nav-link item-hover position-relative' id='home-menu' href='$index'>Home</span></a>
              <a class='nav-item nav-link item-hover position-relative' id='about-menu' href='$urlRegister' >Cadastre-se</a>
              <a class='nav-item nav-link item-hover position-relative' id='services-menu' href='#'>Serviços</a>
              <a class='nav-item nav-link item-hover position-relative' id='portfolio-menu' href='#'>Projetos</a>
              <a class='nav-item nav-link item-hover position-relative' id='contact-menu' data-toggle='modal' data-target='#modalLogin' href=''>Entrar</a>
            </div>
          </div> 

        </nav>
      </div>
    <div class='subNavBar' style='background: #fff'>
    </div>
navBar;
  }

  public static function modalLogin():void
  {
    $face = new \Ecomais\ControllersServices\AuthFacebook();
    $authFacebookUrl = $face->getAuthURL("email");
    $urlRegister =  BASE_URL . '/cadastro';
    $urlRecoverPasswd = BASE_URL . "/recuperarsenha";

echo <<<ModalLogin
    <div class='modal fade' id='modalLogin' role='dialog' aria-labelledby='login' aria-hidden='false'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body p-3'>
                <div class='modal-title mb-4 text-center'>
                    <h3>Login</h3>
                </div>
                <form>
                    <div class='form-group col-md-12'>
                        <label for='inputEmail' class='label-login'>Email ou CNPJ :</label>
                        <input type='email' class='form-control border-bottom-solid-2px' id='inputEmail'>
                    </div>
                    <div class='form-group col-md-12'>
                        <label for='inputPwd' class='label-login'>Senha :</label>
                        <input type='password' class='form-control border-bottom-solid-2px' id='inputPwd'>
                    </div>
                    <div class='form-check'>
                        <input type='checkbox' class='form-check-input' id='manterConectado'>
                        <label class='form-check-label ' for='dropdownCheck'>
                            Mantenha-me conectado
                        </label>
                    </div>

                    <div class='p-3 text-right'>
                        <a href='$urlRecoverPasswd' class='a'>
                            <button type='button' class='btn btn-link text-danger'>Esqueceu a Senha?</button>
                        </a>
                    </div>
                </form>
                <div class='col-12'>
                    <div class='text-center'>
                        <button type='button' class='button-login text-center btn-login font-weigth-800 font-size-1-5em' id='btnLogar'>Entrar</button>
                    </div>
                </div>

                <div class='col-12 pt-4 pb-4 d-sm-flex justify-content-center' id='container-account-login'>
                    <a title='Entrar com o Facebook' href='$authFacebookUrl' class='mr-3 a' 
                        onclick='window.open(this.href, this.target, "width=604,height=560,left="+ (window.innerWidth-600)/2 +", top="+  (window.innerWidth-100)/2 +" "); return false;'>   
                        <div class='item-account-login facebook'>
                            <i class='fab fa-facebook i'></i>
                        </div>
                    </a>
                    <a title='Entrar com o Google' href='' class='a'>
                        <div class='item-account-login google' class='mr-3'>
                            <i class='i fab fa-google'></i>
                        </div>
                    </a>
                </div>
                <div class='pt-4 text-center'>
                    <p>Não tem uma conta ?</p>
                    <a href='$urlRegister'> <button type='button' class='btn btn-link'> Cadastre-se </button></a>
                </div>
            </div>
        </div>
    </div>
    </div>  
ModalLogin;

  }

  public static function mail($name,$token):string
  {
    $font1 = "padding:0;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif";
    $font2 ="font-size:20px;font-weight:600;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif;color:#272726;display:inline-block;padding:16px 24px;text-decoration:none";
    $font3 = "font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif";
    $background = "https://ci4.googleusercontent.com/proxy/zi2B0d_rqBrjZUnbvWBsWVB8fe8l8zm2FoPZ47PHEU2ogMXdxR09xVIKWM8QHcCmFCTyyzH0kRR1HLgukAU2J3cKuZGRln3KRpGokTAh0qER=s0-d-e1-ft#https://img.fortawesome.com/349cfdf6/tile-info-icons-misc1.png";
      return
<<<mail
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
                                                                                    $name 
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
                                                                                <a style='text-decoration:none' href='https://www.localhost/www/EcoMais/recuperarsenha/novasenha/t=$token' style='$font2' target='_blank'>Redefinir minha senha</a> 
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
                                                                                para o bem estar nossa platadorma leia também a  
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
mail;
  }

}
