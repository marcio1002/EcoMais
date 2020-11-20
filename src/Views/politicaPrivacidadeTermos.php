<?php
 require_once dirname(__DIR__, 2). "/vendor/autoload.php";
 use RenderFile\RenderFile as Bundles;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidade e Termos</title>
    <link rel="shortcut icon" href="./src/assets/logos-icons/ecomais.ico" type="image/x-icon">
    <?php Bundles::render(
        ["bootstrap.min.css.map", "bootstrap.min.css", "bootstrap-reboot.min.css.map", "bootstrap-reboot.min.css", "bootstrap-grid.min.css.map", "bootstrap-grid.min.css","bootstrap-utilities.min.css.map","bootstrap-utilities.min.css"],
        fn ($file) => printf("<link rel='stylesheet' href='%s'>",renderUrl($file)),
    );
    ?>
</head>

<body>
    <div class="col-12 p-3">
        <article class="col-10 m5 container z-depth-3 white line-height-2em">

            <h4 class="text-center">Política de privacidade do <em>EcoMais</em></h4>

            <p>A sua privacidade é importante para nós. A política do <strong>EcoMais</strong> respeitar a sua privacidade em relação a qualquer informação sua que possamos coletar no site EcoMais.</p>
            
            <p>Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço. Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que estamos coletando e como será usado. </p>
            
            <p>Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado. Quando armazenamos dados, protegemos dentro de meios comercialmente aceitáveis ​​para evitar perdas e roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.</p>
            
            <p>Todas as suas informações pessoais recolhidas, serão usadas para o ajudar a tornar a sua visita no nosso site o mais produtiva e agradável possível.</p>

            <p>A garantia da confidencialidade dos dados pessoais dos utilizadores do nosso site é importante para o <strong>Ecomais</strong>.</p>

            <p>Todas as informações pessoais relativas a membros, assinantes, clientes ou visitantes que usem o <strong>Ecomais</strong> serão tratadas em concordância com a <a href="http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2018/Lei/L13709.htm" target="__blank"><strong>Lei da Proteção de Dados Pessoais</strong></a> (LGPD) de 14 de AGOSTO de 2018 <strong>(LEI Nº 13.709)</strong>.</p>

            <p>As informações pessoais recolhida pode incluir o seu nome, e-mail, número de telefone e/ou telemóvel, morada, data de nascimento entre outros.</p>

            <p>O nosso site pode ter links para sites externos que não são operados por nós. Esteja ciente de que não temos controle sobre o conteúdo e práticas desses sites e não podemos aceitar responsabilidade por suas respectivas <strong>políticas de privacidade.</strong> </p>

            <p>O uso do <strong>Ecomais</strong> pressupõe a aceitação deste Acordo de privacidade. A equipe do <strong>Ecomais</strong> reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade de forma a estar sempre atualizado.</p>

            <h4 class="center-align">CONSENTIMENTO</h4>

            <h5>Como vocês obtêm meu consentimento?</h5>

            <p>Quando você nos fornece as suas informações pessoais no cadastro nosso site, preenchimento do cartão de crédito, a localização, você está concordando com a nossa coleta e uso de informações pessoais apenas para esses fins específicos.</p>

            <p>Se pedirmos suas informações pessoais por uma razão secundária, como marketing, vamos pedir seu consentimento, ou te dar a oportunidade de dizer não.</p>

            <h5>Como posso retirar o meu consentimento?</h5>

            <p>Caso depois de fornecer seus dados você mude de ideia, você pode retirar o seu consentimento quando quiser em nossa plataforma. Ou entre em contato conosco através do e-email <strong>ecomais5354@gmail.com</strong></p>

            <h4 class="center-align">Os anúncios</h4>

            <p>Tal como outros sites, coletamos e utilizamos informação contida nos anúncios.
                &nbsp; As informações contida nos anúncios, inclui o seu endereço IP (Internet Protocol), o seu ISP (Internet Service Provider, como o Sapo, Clix, ou outro), o browser que utilizou ao visitar o nosso site (como o Google Chrome ou o Firefox), o tempo da sua visita e que páginas visitou dentro do nosso site.</p>

            <h4 class="center-align"> Os Cookies e Web Beacons</h4>

            <p>Utilizamos <em>cookies</em> para armazenar informação, tais como as suas preferências pessoais quando visita o nosso site. Isto poderá incluir um simples popup, ou uma ligação em vários serviços que providenciamos, tais como notificações de produtos.</p>

            <p>Em adição também utilizamos publicidade de terceiros no nosso site para suportar os custos de manutenção. Alguns destes publicitários, poderão utilizar tecnologias como os <em>cookies</em> e/ou <em>web beacons</em> quando publicitam no nosso site, o que fará com que esses publicitários (como o Google através do Google AdSense) também recebam a sua informação pessoal, como o endereço IP, o seu ISP, o seu browser, etc.
                Esta função é geralmente utilizada para geotargeting (mostrar publicidade de Lisboa apenas aos leitores oriundos de Lisboa por ex.) ou apresentar publicidade direcionada a um tipo de utilizador (como mostrar publicidade de restaurante a um utilizador que visita sites de culinária regularmente, por ex.).</p>

            <p> Você detém o poder de desligar os seus <em>cookies</em>, nas opções do seu browser, ou efetuando alterações nas ferramentas de programas Anti-Virus. No entanto, isso poderá alterar a forma como interage com o nosso site, ou outros sites. Isso poderá afetar ou não permitir que faça logins em programas, sites ou fóruns da nossa e de outras redes.</p>

            <h4 class="center-align">Ligações a Sites de terceiros</h4>

            <p>O <strong>Ecomais</strong> possui ligações para outros sites, os quais, a nosso ver, podem conter informações / ferramentas úteis para os nossos visitantes. A nossa política de privacidade não é aplicada a sites de terceiros, pelo que, caso visite outro site a partir do nosso deverá ler a politica de privacidade do mesmo.

                Não nos responsabilizamos pela política de privacidade ou conteúdo presente nesses mesmos sites.</p>

        </article>
    </div>
    <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>