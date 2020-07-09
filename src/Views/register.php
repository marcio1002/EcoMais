<?php

use Ecomais\Web\Bundles;
use Ecomais\Controllers\ComponenteElement;


$google  = new \Ecomais\Models\AuthGoogle("/cadastro");

$authGoogleUrl = $google->getAuthURL();

$code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED);
$err  = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED);

$name = "";
$email = "";
$clearResquest = "";

if (!empty($code)) {

  if($data = $google->getData($code)) {
    $name = "value='{$data->getName()}'";
    $email = "value='{$data->getEmail()}'";
  } else {
    $clearResquest =  "<script>window.history.replaceState('', '', window.location.pathname)</script>";
  }
}
$this->layout("_theme", ["title" => "EcoMais - Cadastro"]);
?>
<?php
$this->start("css");
echo  Bundles::renderCss(["css/manipulation"]);
$this->stop();
?>


<div class="container p-3 pb-4">
  <div class="mb-3">
    <div class="col-12">
      <div class='col-xl-4 col-lg-4 col-md-7 col-sm-12 m-auto'>
        <div class="btn-group btn-large btn-block">
          <button class="btn-color-red text-white btn btn-focus-shadow-none">
            <i class='icon-google fab fa-google'></i>
          </button>
          <a title='Registrar com o Google' id="registerGoogle" href=<?= $authGoogleUrl ?> class='btn btn-large btn-block btn-color-red btn-focus-shadow-none text-center font-size-1-2em text-weight-700 text-white align-middle p-2'>
            Registrar com o Google
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <form onsubmit="return false">
      <div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="text"><span class='required'>*</span> Nome:</label>
            <input type="text" <?=$name?>  <?= $name? "readonly": "" ?> class="form-control nextItem" id="name"  data-required="" />
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="text"><span class='required'>*</span> Email:</label>
            <input type="text" <?=$email?>   <?=$email? "readonly": "" ?> class="form-control nextItem" id="cadEmail" placeholder="seumail@test.dominio" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputCep">Cep</label>
            <div class="input-group">
              <input type="text" class="form-control" id="inputCep" maxlength="8" />
              <div class="input-group-prepend">
                <button type="button" class="btn btn-info input-group-text" id="searchCep">Buscar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputPassword4"><span class='required'>*</span> Crie uma senha:</label>
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
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="cpf"><span class='required'>*</span> Cidade: </label>
            <input type="text" class="form-control nextItem" id="locality" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputState"><span class='required'>*</span> Unidade Federativa:</label>
            <select id='uf' name='uf' class="form-control custom-select nextItem" data-required="">
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
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputAddres">Endereço:</label>
            <input type="address" class="form-control nextItem" id="addres" />
          </div>
        </div>
        <div class="custom-control custom-switch pb-5 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group form-check">
            <input type="checkbox" aria-label="Chebox para permitir input text" id="termos">
            <label class="form-check-label" for="termos">Li e concordo com os <a href=<?= renderUrl("/politica-privacidade-e-termos") ?> >Termos de uso</a></label>
          </div>
        </div>
        <div class="col-12">
          <div class="col-xl-5 col-lg-5 col-md-9 col-sm-12 m-auto">
            <button type="button" class="btn btn-block btn-primary nextItem font-size-1-2em text-weight-700" id="btnRegister">Cadastrar</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
$this->start("footer");
echo ComponenteElement::footerHome();
$this->stop()
?>
<?php
$this->start("scripts");
echo  Bundles::renderJs([
  "js/mainMethods",
  "js/regAjax",
  "js/manipulation",
  "js/register",
]);
echo $clearResquest;
$this->stop();
?>