<?php

use Ecomais\Web\Bundles;

$this->layout("_theme", ["title" => "EcoMais - Cadastro"]);
?>
<?php
$this->start("css");
echo  Bundles::renderCss(["css/manipulation"]);
$this->stop();
?>

<div class="container" id="title-container">
</div>
<div class="container">
  <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 offset-xl-2 offset-lg-2 offset-md-1">
    <form onsubmit="return false">
      <div class="cad">
        <div class="form-row pb-3">
          <div class="form-group col-xl-5 col-lg-5 col-md-12 col-sm-12">
            <label for="inputName">Nome Completo:</label>
            <input type="text" class="form-control nextItem" id="inputName" data-required="" />
          </div>
          <div class="form-group col-xl-5 col-lg-5 col-md-12 col-sm-12">
            <label for="text">Email:</label>
            <input type="text" class="form-control nextItem" id="cadEmail" placeholder="seumail@test.dominio" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3">
          <div class="form-group col-xl-5 col-lg-5 col-md-12 col-sm-12">
            <label for="inputPassword4">Crie uma senha:</label>
            <div class="input-group">
              <input type="password" class="form-control nextItem" id="passwd" maxlength="20" data-required="" />
              <div class="input-group-prepend">
                <button type="button" class="btn btn-primary" id="btnViewPasswd"><i id="iconPasswd" class="fas fa-eye-slash"></i></button>
              </div>
            </div>
            <small class="form-text text-muted">
              <div class="progress" style="width: 100%; height: 5px;">
                <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </small>
          </div>
          <div class="form-group col-xl-5 col-lg-5 col-md-12 col-sm-12">
            <label for="inputCep">Cep</label>
            <div class="input-group">
              <input type="text" class="form-control" id="inputCep" maxlength="8" />
              <div class="input-group-prepend">
                <button type="button" class="btn btn-info input-group-text" id="searchCep">Buscar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row pb-3">
          <div class="form-group col-xl-5 col-lg-5 col-md-12 col-sm-12">
            <label for="inputState">Unidade Federativa:</label>
            <select id='uf' name='uf' class="form-control nextItem" data-required="">
              <option value="" selected>Escolha...</option>
              <option value='AC'>Acre</option>
              <option value='AL'>Alagoas</option>
              <option value='AP'>Amapá</option>
              <option value='AM'>Amazonas</option>
              <option value='BA'>Bahia</option>
              <option value='CE'>Ceará</option>
              <option value='DF'>Distrito Federal*</option>
              <option value='ES'>Espírito Santo</option>
              <option value='GO'>Goiás</option>
              <option value='MA'>Maranhão</option>
              <option value='MS'>Mato Grosso do Sul</option>
              <option value='MG'>Minas Gerais</option>
              <option value='PA'>Pará</option>
              <option value='PB'>Paraíba</option>
              <option value='PR'>Paraná</option>
              <option value='PE'>Pernambuco</option>
              <option value='PI'>Piauí</option>
              <option value='RJ'>Rio de Janeiro</option>
              <option value='RN'>Rio Grande do Norte</option>
              <option value='RS'>Rio Grande do Sul</option>
              <option value='RO'>Rondônia</option>
              <option value='RR'>Roraima</option>
              <option value='SC'>Santa Catarina</option>
              <option value='SP'>São Paulo</option>
              <option value='SE'>Sergipe</option>
              <option value='TO'>Tocantins</option>
            </select>
          </div>
          <div class="form-group col-xl-5 col-lg-5 col-md-12 col-sm-12">
            <label for="cpf">Cidade: </label>
            <input type="text" class="form-control nextItem" id="localidade" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3">
          <div class="form-group col-md-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 offset-xl-2 offset-lg-2">
            <label for="inputAddres">Endereço:</label>
            <input type="address" class="form-control nextItem" id="inputAddres" />
          </div>
        </div>
        <div class="custom-control custom-switch pb-5">
          <input type="checkbox" class="custom-control-input" id="termos">
          <label class="custom-control-label" for="termos">Li e concordo com os <a href=<?= renderUrl("/politica-privacidade-e-termos") ?>>Termos de uso</a></label>
        </div>
        <div class="col-12">
          <div class="container">
            <div class="col-xl-6 col-lg-6 col-md-10 col-sm-12 col-xl-0 offset-xl-2 offset-lg-2">
              <button type="button" class="btn btn-block btn-primary nextItem" id="btnRegister">Cadastrar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $this->start("footer") ?>
<div id="contact-area">
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
<?php
$this->start("scripts");
echo  Bundles::renderJs([
  "js/apis",
  "js/mainMethods",
  "js/regAjax",
  "js/manipulation",
  "js/register",
]);
$this->stop();
?>