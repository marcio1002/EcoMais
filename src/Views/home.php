<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Ecomais\Web\Bundles;
use Ecomais\Controllers\ComponenteElement;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  Bundles::renderCss([
    "css/fonts",
    "js/jquery",
    "bootstrap",
    "css/style"
  ])
  ?>
  <title>Apresentação</title>
</head>

<body>
  <?php
  ComponenteElement::navBar();
  ComponenteElement::modalLogin();
  ?>
  <div class="container" id="title-container">
    <h1>EcoMais</h1>
  </div>
  <div id="about-area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h3 class="main-title">Bem Vindo Ao EcoMais</h3>
        </div>
        <div class="col-md-6">
          <img class="img-fluid" src=<? echo BASE_URL . "/src/assets/imgs/nlogo.png" ?> alt="Ecomais">
        </div>
        <div class="col-md-6">
          <h3 class="about-title">Uma Organização que pensa no futuro e saúde do planeta</h3>
          <p>O EcoMais tem como grande desafio propor economia e sustentabilidade aos seus clientes, trazendo um retorno
            lucrativo, rendível e sustentável a sua empresa, divulgando os produtos em plataformas digitais.</p>
          <p> Você micro-empreendedor poderá cadastrar a sua empresa do ramo alimentício em nossa plataforma, poderá
            criar panfletos e anunciar promoções, tudo digial! a plataforma e os arquitetos de software estarão
            disponibilizando todo suporte para você aproveitar as melhores tecnologias para seus anúncios.</p>
          <p>E nossos designers trabalharão na sua interface/layout para impulsionar os seus anúncios.</p>
          <p>Veja outros diferenciais da equipe:</p>
          <ul id="about-list">
            <li><i class="fas fa-check"></i> Suporte 24h</li>
            <li><i class="fas fa-check"></i> Layout responsivo para todos os dispositivos</li>
            <li><i class="fas fa-check"></i> Integração com diversos sistemas do mercado</li>
            <li><i class="fas fa-check"></i> Desenvolvimento com metodologia ágil</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><b>Mais Economia e Conforto ao cliente</b></h5>
          <p class="card-text">A plataforma Ecomais é pra você também que é consumidor!
            Você poderá realizar um Cadastro no site, entrar para ver produtos, ser notificados de promoções perto de
            você e muito mais!
            Crie o seu cadastro agora mesmo!
          </p>
          <a href=<?php echo BASE_URL . "/cadastro"; ?> class="btn btn-primary">Acesse-já</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><b>Uma missão para as empresas</b></h5>
          <p class="card-text">Panfletos, folhetos e encartes são alguns mecanismos de divulgação bastante usados quando
            se quer atrair a atenção do público em cidades da região. De fácil manuseio, essas mídias têm custo de
            produção geralmente baixo, mas pelo mau uso de quem os distribui e recebe pelas ruas, para muitos, eles têm
            se tornado um sinônimo de transtorno e sujeira. Pensando nisso a equipe do EcoMais busca uma solução mais
            sustentável quanto a isso, que é a utilização das plataformas digitais para os anúncios. Toda a empresa
            compremetida deve buscar soluções mais sústentavéis. Por isso não perca tempo, Cadastre a sua empresa e
            venha participar desta missão!</p>
          <a href="#" class="btn btn-primary">Acesse-já</a>
        </div>
      </div>
    </div>
  </div><br>
  <main>
    <div class="container-fluid">
      <div id="mainSlider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#mainSlider" data-slide-to="0" class="activate"></li>
          <li data-target="#mainSlider" data-slide-to="1"></li>
          <li data-target="#mainSlider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">

          <div class="carousel-item active">
            <img src=<? echo BASE_URL . "/src/assets/imgs/planta.jpg" ; ?> class="d-block w-100" alt="missao">
            <div class="carousel-caption d-none d-md-block">
              <h2>Impacto Positivo</h2>
              <p> Entre e conheça sobre os benefícios da propaganda digital para o meio ambiente</p>

              <a href="#" class="main-btn">Saiba mais</a>
            </div>
          </div>
          <div class="carousel-item">
            <img src=<? echo BASE_URL . "/src/assets/imgs/maca.jpg" ; ?> class="d-block w-100" alt="iamgem de negocios">
            <div class="carousel-caption d-none d-md-block">
              <h2>Benefícios para os consumidores</h2>
              <p> Entre e conheça sobre os impactos positivos para o bolso do consumidor através da propagenda digital
              </p>
              <a href="#" class="main-btn">Saiba mais!</a>
            </div>
          </div>
          <div class="carousel-item ">
            <img src=<? echo BASE_URL . "/src/assets/imgs/mission.jpg" ; ?> class="d-block w-100" alt="Mercado">
            <div class="carousel-caption d-none d-md-block">

              <h2>Mais que um simples negócio, uma missão</h2>
              <p> A equipe EcoMais zela pelo meio ambiente e pelo cuidado com planeta</p>

            </div>
          </div>
        </div>
        <a href="#mainSlider" class="carousel-control-prev" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a href="#mainSlider" class="carousel-control-next" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    </div>
  </main>
  <footer>
    <div id="contact-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="main-title">Entre em contato conosco</h3>
          </div>
          <div class="col-md-4 contact-box">
            <i class="fas fa-phone"></i>
            <p><span class="contact-tile">Ligue para:</span> (48)99999-9999</p>
            <p><span class="contact-tile">Horários:</span> 8:00 - 19:00</p>
          </div>
          <div class="col-md-4 contact-box">
            <i class="fas fa-envelope"></i>
            <p><span class="contact-tile">Envie um email:</span> ecomais5354@gmail.com</p>
          </div>
          <div class="col-md-4 contact-box">
            <i class="fas fa-map-marker-alt"></i>
            <p><span class="contact-tile">numero:</span> Rua Lorem Ipsum - 1314</p>
          </div>
          <div class="col-md-6" id="msg-box">
            <p>Ou nos deixe uma mensagem:</p>
          </div>
          <div class="col-md-6" id="contact-form">
            <form action="" onclick="return false">
              <input type="text" class="form-control" placeholder="E-mail" name="email">
              <input type="text" class="form-control" placeholder="Assunto" name="subject">
              <textarea class="form-control" rows="3" placeholder="Sua mensagem..." name="message"></textarea>
              <input type="button" class="main-btn" value='enviar' />
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id="copy-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>Desenvolvido por <a href="#" target="_blank">EcoMais</a> &copy; 2020</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <?php
  echo "
    <script type='text/javascript'>
        const BASE_URL = '" . BASE_URL . "';
    </script>";
  ?>
</body>

</html>