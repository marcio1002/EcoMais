<?php

namespace Ecomais\Views\Component;

class ComponenteElement
{
    public static function navBarHome(): string
    {
        $logo = '{$this->asset("/logos-icons/ecomais-icon-small.png")}';
        $index = renderUrl();
        $login = renderUrl("home.login");
        $registerUser = renderUrl("home.cadastro");
        $registerCompany = renderUrl("home.empresa");
return <<<navBar
      <div class='container text-white' id='nav-container'>
        <nav class='navbar navbar-expand-md fixed-top text-weight-500 bg-blue-dark'>
          <button class='navbar-toggler p-2' type='button' data-toggle='collapse' data-target='#navbar-links'
            aria-controls='navbar-links' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggle-icon'></span>
          </button>
          <div id='navbar-links' class='collapse navbar-collapse justify-content-center'>
            <div class='navbar-nav m-auto align-content-center'>
              <a class='nav-item nav-link text-decoration-none  text-white item-hover position-relative ' id='home-menu' href='$index'>Home</span></a>
              <a class='nav-item nav-link text-decoration-none  text-white item-hover position-relative' id='about-menu' href="$registerUser" >Cadastre-se</a>
              <a class='nav-item nav-link text-decoration-none  text-white item-hover position-relative' id='services-menu' href='$registerCompany'>Serviços</a>
            </div>
            <div class="">
                <a class='nav-item btn w-xm-50 w-sm-50 mr-xl-2 mr-lg-2 text-center text-white text-weight-700 text-white rounded bg-red-wine remove-focus' id='login' href='$login'>Entrar <i class="fas fa-sign-in-alt"></i></a>
            </div>
          </div> 
        </nav>
      </div>
    <div class='subNavBar' style='background: transparent'>
    </div>
navBar;
    }

    public static function footer(): string
    {
        $termsPolicy = renderUrl("home.politicahp");
return <<<footer
    <section class="call-to-action bg-blue-dark-1 text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 mx-auto">
                    <div class="col-md-12 p-2" id="contact-form">
                    <p class="h4">Receba nossa Newsletter </p>
                    <div class="">
                    <input type="text" class="form-control inset-shadow" placeholder="email@exemplo.com" id="emailNewsLetter">
                    <div class="row pt-3">
                    <div class="col-xl-6 col-md-8 col-sm-12 m-auto">
                        <button type="button" class="btn bg-red-wine remove-focus text-white text-uppercase font-weight-bold btn-block text-black m-auto" id='btnEnv'>enviar</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </section>
    <footer class="footer bg-blue-dark py-3">
    <div class="container">
        <div class="row">
        <div class="col-lg-7 h-100 text-center text-lg-left my-auto">
            <ul class="list-inline mb-2">
            <li class="list-inline-item">
                <p class="text-white"><i class="fas fa-phone text-red-wine-light-1"></i>&ThinSpace; (48) 4749-0812</p>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
                <p class="text-white"><i class="fas fa-envelope text-red-wine-light-1"></i>&ThinSpace; ecomais5354@gmail.com</p>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
                <a href='${termsPolicy}' class="text-white">Termos</a>
            </li>
            <li class="list-inline-item large">&sdot;</li>
            <li class="list-inline-item">
                <a href='${termsPolicy}' class="text-white">Política de privacidade</a>
            </li>
            </ul>
            <p class="text-white-50 small mb-4 mb-lg-0">Desenvolvido por <a href="#">EcoMais</a> &copy; 2020</p>
        </div>
        <div class="col-lg-5 h-100 text-center text-lg-right my-auto">
            <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
                <a href="https://www.facebook.com/ecomais.ecomais.1">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
                </a>
            </li>
            </ul>
        </div>
        </div>
    </div>
    </footer>
footer;
    }


    public static function mail($name, $token): string
    {
        $url = renderUrl("home.novasenha",["token" => $token]);
        $font1 = "padding:0;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif";
        $font2 = "font-size:20px;font-weight:600;font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif;color:#272726;display:inline-block;padding:16px 24px;text-decoration:none";
        $font3 = "font-family:'Proxima Nova Soft','Proxima Nova','Helvetica Neue',Helvetica,Arial,sans-serif";
        $background = "https://ci4.googleusercontent.com/proxy/zi2B0d_rqBrjZUnbvWBsWVB8fe8l8zm2FoPZ47PHEU2ogMXdxR09xVIKWM8QHcCmFCTyyzH0kRR1HLgukAU2J3cKuZGRln3KRpGokTAh0qER=s0-d-e1-ft#https://img.fortawesome.com/349cfdf6/tile-info-icons-misc1.png";
return <<<mail
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
                                                                                    botão logo abaixo, você será redirecionado para a tela de recupação de senha.<br/><strong>A url se expira em 1 horas.</strong>
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
                                                                                <a style='text-decoration:none' href='$url' style='$font2' target='_blank'>
                                                                                    Redefinir minha senha
                                                                                </a>
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
                                                                                para o bem estar nossa plataforma, leia também a nossa 
                                                                                <a href='https://www.localhost/www/EcoMais/terms' style='color:#329af0' target='_blank'> política de  privacidade</a>. </p>
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

    public static function load(): string
    {
return <<<load
    <div class="sk-folding-cube">
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
    </div>   
load;
    }

    /**
     * @param mixed ...$props
     * id,título e link 
    */
    public static function buttonGoogle(...$props): string 
    {
return <<<btnGoogle
    <div id="{$props[0]}" class="btn btn-group btn-block bg-red-google btn-bg-shadow-hover p-0">
        <button class="btn text-white remove-focus bg-red-google btn-bg-shadow-hover">
            <i class="icon-google fab fa-google"></i>
        </button>
        <a title='{$props[1]}' href="{$props[2]}" class='btn btn-block text-center text-white text-weight-800 text-decoration-none remove-focus font-size-xl-1-1em font-size-sm-9em font-size-xm-9em'>
            {$props[1]}
        </a>
    </div>
btnGoogle;
    }
}
