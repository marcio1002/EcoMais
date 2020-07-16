<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Ecomais\Web\Bundles;
use Ecomais\Controllers\ComponenteElement;

$this->layout("_theme", ["title" => "EcoMais - Home"]);
?>

<?
  $this->start("css");
    Bundles::renderCss(["css/alertify"]);
  $this->stop();
?>

<div class="col-12 img-fluid" id="title-container">
  <h1 class="h1">EcoMais</h1>
</div>
<div id="about-area">
  <div class="container p-3">
    <div class="row col-12">
      <div class="col-12">
        <h3 class="main-title">Bem Vindo Ao EcoMais</h3>
      </div>
      <div class="col-md-6 ">
        <img class="img-fluid mb-md-3" src=<?= renderUrl("/src/assets/logos-icons/ecomais-logo.png"); ?> alt="Ecomais">
      </div>
      <div class="col-md-6">
        <h3 class="about-title">Uma Organização que pensa no futuro e saúde do planeta</h3>
        <p>O EcoMais tem como grande desafio propor economia e sustentabilidade aos seus clientes, trazendo um retorno
          lucrativo, rendível e sustentável a sua empresa, divulgando os produtos em plataformas digitais.</p>
        <p> Você micro-empreendedor poderá cadastrar a sua empresa do ramo alimentício em nossa plataforma, poderá
          criar panfletos e anunciar promoções, tudo digital! a plataforma e os arquitetos de software estarão
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
  <div class="col-12 py-4">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card" style="height: 305px">
          <div class="card-header text-center">
            <h5 class="card-title"><b>Mais Economia e Conforto ao cliente</b></h5>
          </div>
          <div class="card-body">
            <p class="card-text">A plataforma Ecomais é pra você também que é consumidor!
              Você poderá realizar um Cadastro no site, entrar para ver produtos, ser notificados de promoções perto de
              você e muito mais!
              Crie o seu cadastro agora mesmo!
            </p>
            <a href=<?= renderUrl("/cadastro"); ?> class="btn btn-large btn-primary  center">Acesse-já</a>
          </div>
        </div>
      </div>
      <div class="w-sm-100"></div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card" style="height: 305px ">
          <div class="card-header text-center">
            <h5 class="card-title"><b>Uma missão para as empresas</b></h5>
          </div>
          <div class="card-body pb-3" style="overflow: auto;">
            <p class="card-text">
              Panfletos, folhetos e encartes são alguns mecanismos de divulgação bastante usados quando
              se quer atrair a atenção do público em cidades da região. De fácil manuseio, essas mídias têm custo de
              produção geralmente baixo, mas pelo mau uso de quem os distribui e recebe pelas ruas, para muitos, eles têm
              se tornado um sinônimo de transtorno e sujeira. Pensando nisso a equipe do EcoMais busca uma solução mais
              sustentável quanto a isso, que é a utilização das plataformas digitais para os anúncios. Toda a empresa
              comprometida deve buscar soluções mais sustentáveis. Por isso não perca tempo, Cadastre a sua empresa e
              venha participar desta missão!
            </p>
            <a href="#" class="btn btn-primary">Acesse-já</a>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div id="mainSlider" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#mainSlider" data-slide-to="0" class="activate"></li>
        <li data-target="#mainSlider" data-slide-to="1"></li>
        <li data-target="#mainSlider" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner ">
        <div class="carousel-item active after-color">
          <img src=<?= renderUrl("/src/assets/imgs/frutas-e-legumes.png"); ?> class="d-block w-100" alt="missao">
          <div class="carousel-caption d-none d-md-block">
            <h2>Impacto Positivo</h2>
            <p> Entre e conheça sobre os benefícios da propaganda digital para o meio ambiente</p>
            <a href="#" class="main-btn text-white">Saiba mais</a>
          </div>
        </div>
        <div class="carousel-item after-color ">
          <img src=<?= renderUrl("/src/assets/imgs/supermarket.png"); ?> class="d-block w-100" alt="iamgem de negocios">
          <div class="carousel-caption d-none d-md-block">
            <h2>Benefícios para os consumidores</h2>
            <p class=""> Entre e conheça sobre os impactos positivos para o bolso do consumidor através da propagenda digital
            </p>
            <a href="#" class="main-btn text-white">Saiba mais!</a>
          </div>
        </div>
        <div class="carousel-item after-color">
          <img src=<?= renderUrl("/src/assets/imgs/carrinho-com-compras.png"); ?> class="d-block w-100" alt="Mercado">
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

  <?php
  $this->start("footer");
  echo ComponenteElement::footerHome();
  $this->stop()
  ?>

  <?php
  $this->start("scripts");
  Bundles::renderJs([
    "js/jquery",
    "js/apis",
  ]);
  $this->stop();

  ?>