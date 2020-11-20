<?php
$this->layout("_layout", ["title" => "EcoMais - cadastro"]);

use RenderFile\RenderFile as Bundles;
use Ecomais\Views\Component\ComponenteElement as component;

$google  = new \Ecomais\Models\AuthGoogle("home.cadastro");

$code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED,FILTER_SANITIZE_STRING);
$err  = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED,FILTER_SANITIZE_STRING);
$state  = filter_input(INPUT_GET, "state", FILTER_SANITIZE_STRIPPED,FILTER_SANITIZE_STRING);

$name = "";
$email = "";
$clearResquest = "";

if (!empty($code) && $google->tokenExpired($code)) $code = $google->tokenExpired($code);

if (!empty($code) && empty($err)) {
  if($data = $google->getData($code,$state)) {
    $name = "value='{$data->getName()}'";
    $email = "value='{$data->getEmail()}'";
  }
}else 
  if($google->isSession()) $google->unsetSession();
?>
<div class="container p-3 pb-4">
  <div class="mb-3">
    <div class="col-12">
      <div class="col-xl-4 col-md-8 col-sm-12 m-auto">
        <?=component::buttonGoogle("registerGoogle","Registrar com o Google","''")?>
      </div>
    </div>
  </div>
  <div class="col-12">
    <form id="formUser" enctype="multipart/form-data">
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="text"><span class='required'>*</span>Nome:</label>
            <input type="text" id="name" name="name" <?=$name?>  <?= $name ? "readonly": "" ?> class="form-control inset-shadow nextItem" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="text"><span class='required'>*</span>Email:</label>
            <input type="text" id="email" name="email" <?=$email?>   <?= $email ? "readonly": "" ?> class="form-control inset-shadow nextItem" placeholder="seumail@teste.dominio" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputCep">Cep</label>
            <div class="input-group">
              <input type="text" id="inputCep" name="cep" class="form-control inset-shadow"inset-shadow  maxlength="8" />
              <div class="input-group-prepend">
                <button type="button" class="btn btn-primary remove-focus input-group-text" id="searchCep">Buscar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputPassword4"><span class='required'>*</span>Crie uma senha:</label>
            <div class="input-group">
              <input type="password" id="passwd" name="passwd" class="form-control inset-shadow nextItem" autocomplete="current-password" maxlength="20" data-required="" />
              <div class="input-group-prepend">
                <button type="button" class="btn btn-primary remove-focus" id="btnViewPasswd"><i id="iconPasswd" class="fas fa-eye-slash"></i></button>
              </div>
            </div>
            <small class="form-text text-muted">
              <div class="progress mt-1" style="width: 100%; height: 5px;">
                <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </small>
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="cpf"><span class='required'>*</span>Cidade: </label>
            <input type="text" id="locality"  name="locality" class="form-control inset-shadow nextItem" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputState"><span class='required'>*</span> Unidade Federativa:</label>
            <select id='uf' name='uf' class="form-control inset-shadow custom-select nextItem" data-required="">
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
            <label for="address">Endereço:</label>
            <input type="address" id="address" name="address" class="form-control inset-shadow nextItem"/>
          </div>
        </div>
        <div class="custom-control custom-switch pb-5 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group form-check">
            <input type="checkbox" id="termos" aria-label="Aceitar termos do sistema" >
            <label class="form-check-label" for="termos">Li e concordo com os <a href=<?= renderUrl("home.politicahp") ?> >Termos de uso</a></label>
          </div>
        </div>
        <div class="col-12">
          <div class="col-xl-4 col-lg-4 col-md-7 col-sm-12 m-auto">
            <button class="btn btn-block btn-primary remove-focus nextItem font-size-1-1em text-weight-700 btn-bg-shadow-hover" id="btnRegister">Cadastrar</button>
          </div>
        </div>
    </form>
  </div>
</div>
<?php
$this->start("footer");
  echo component::footer();
$this->stop()
?>
<?php
$this->start("scripts");
  Bundles::render(["register.js"], fn($file) => printf("<script src='%s'></script>",renderUrl($file)));
  echo "<script>window.history.replaceState('', '', window.location.pathname)</script>";
$this->stop();
?>