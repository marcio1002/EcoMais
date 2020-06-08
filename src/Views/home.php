<?php
require_once __DIR__ . "/../../vendor/autoload.php";

$this->layout("_theme", ["title" => "EcoMais - Home"]);

?>
<div class="container" id="title-container">
  <h1 class="h1">EcoMais</h1>
</div>
<div id="about-area">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="main-title">Bem Vindo Ao EcoMais</h3>
      </div>
      <div class="col-md-6">
        <img class="img-fluid" src=<?= renderUrl("src/assets/imgs/nlogo.png"); ?> alt="Ecomais">
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
        <a href=<?= renderUrl("cadastro"); ?> class="btn btn-primary">Acesse-já</a>
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
<div class="container-fluid">
  <div id="mainSlider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#mainSlider" data-slide-to="0" class="activate"></li>
      <li data-target="#mainSlider" data-slide-to="1"></li>
      <li data-target="#mainSlider" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src=<?= renderUrl("src/assets/imgs/planta.jpg"); ?> class="d-block w-100" alt="missao">
        <div class="carousel-caption d-none d-md-block">
          <h2>Impacto Positivo</h2>
          <p> Entre e conheça sobre os benefícios da propaganda digital para o meio ambiente</p>

          <a href="#" class="main-btn">Saiba mais</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src=<?= renderUrl("src/assets/imgs/maca.jpg"); ?> class="d-block w-100" alt="iamgem de negocios">
        <div class="carousel-caption d-none d-md-block">
          <h2>Benefícios para os consumidores</h2>
          <p> Entre e conheça sobre os impactos positivos para o bolso do consumidor através da propagenda digital
          </p>
          <a href="#" class="main-btn">Saiba mais!</a>
        </div>
      </div>
      <div class="carousel-item ">
        <img src=<?= renderUrl("src/assets/imgs/mission.jpg"); ?> class="d-block w-100" alt="Mercado">
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
<?php $this->start("footer") ?>
<div id="contact-area" style="background: #fff">
  <div class="container">
    <div class="row pb-4">
    <div class="col-md-12" id="contact-form">
      <p>Receba nossa Newsletter </p>
      <div class="col-md-5 m-auto">
        <input type="text" class="form-control" placeholder="email@exemplo.com" name="email">
        <input type="button" class="main-btn" value='enviar' />
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h3 class="main-title">Entre em contato conosco</h3>
      </div>
      <div class="col-md-4 contact-box">
        <i class="fas fa-phone"></i>
        <p><span class="contact-tile">Telefone:</span> (48)99999-9999</p>
        <p><span class="contact-tile">Horários de atendimento:</span><br /> 8:00 - 19:00</p>
      </div>
      <div class="col-md-4 contact-box">
        <i class="fas fa-envelope"></i>
        <p><span class="contact-tile">Envie um email:</span> ecomais5354@gmail.com</p>
      </div>
      <div class="col-md-4 contact-box">
        <i class="fas fa-map-marker-alt"></i>
        <p><span class="contact-tile">Endereço:</span><br /> Itaquá Garden Shopping Itaquaquecetuba - SP - 1314</p>
      </div>
    </div>
    <div class="col-md-12">
      <p>Desenvolvido por <a href="#">EcoMais</a> &copy; 2020</p>
    </div>
  </div>
</div>
<?php $this->stop() ?>