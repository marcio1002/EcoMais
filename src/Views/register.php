<?php
$this->layout("_theme", ["title" => "EcoMais - Cadastro"]);

use Ecomais\Web\Bundles;
use Ecomais\Views\Component\ComponenteElement as component;


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

?>
<?php
$this->start("css");
  echo  Bundles::render(["manipulation.css"],fn($file) => print_r("<link rel=\"stylesheet\" href=\"$file\""));
$this->stop();
?>

<div class="container p-3 pb-4">
  <div class="mb-3">
    <div class="col-12">
      <div class="col-xl-4 col-md-8 col-sm-12 m-auto">
        <?=component::buttonGoogle("registerGoogle","Registrar com o Google",$authGoogleUrl)?>
      </div>
    </div>
  </div>
  <div class="col-12">
    <form id="formUser" enctype="multipart/form-data">
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="text">Nome:</label>
            <input type="text" id="name" name="name" <?=$name?>  <?= $name? "readonly": "" ?> class="form-control nextItem" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="text">Email:</label>
            <input type="text" id="email" name="email" <?=$email?>   <?=$email? "readonly": "" ?> class="form-control nextItem" placeholder="seumail@teste.dominio" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputCep">Cep</label>
            <div class="input-group">
              <input type="text" id="inputCep" name="cep" class="form-control" maxlength="8" />
              <div class="input-group-prepend">
                <button type="button" class="btn btn-info input-group-text" id="searchCep">Buscar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputPassword4">Crie uma senha:</label>
            <div class="input-group">
              <input type="password" id="passwd" name="passwd" class="form-control nextItem" autocomplete="current-password" maxlength="20" data-required="" />
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
            <label for="cpf">Cidade: </label>
            <input type="text" id="locality"  name="locality" class="form-control nextItem" data-required="" />
          </div>
        </div>
        <div class="form-row pb-3 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12">
            <label for="inputState">Unidade Federativa:</label>
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
            <label for="address">Endereço:</label>
            <input type="address" id="address" name="address" class="form-control nextItem"/>
          </div>
        </div>
        <div class="custom-control custom-switch pb-5 offset-xl-3 offset-lg-3 offset-md-0 offset-sm-0">
          <div class="form-group form-check">
            <input type="checkbox" id="termos" aria-label="Aceitar termos do sistema" >
            <label class="form-check-label" for="termos">Li e concordo com os <a href=<?= renderUrl("/politica-privacidade-e-termos") ?> >Termos de uso</a></label>
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
  Bundles::render(["register.js"], fn($file) => print_r("<script src=\"$file\"></script>"));
  echo $clearResquest;
$this->stop();
?>