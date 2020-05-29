<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Ecomais\Controllers\ComponenteElement;
use Ecomais\Web\Bundles;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <?php
  Bundles::renderCss([
    "css/fonts",
    "js/iconsAwesome",
    "css/manipulation",
    "js/jquery",
    "bootstrap",
    "css/style",
    "alertify",
  ])
  ?>
</head>

<body>
  <?php
  ComponenteElement::navBar();
  ComponenteElement::modalLogin();
  ?>
  <div class="container" id="title-container">
    <h1>Cadastro</h1>
  </div>

  <main>
    <div class="row">
      <div class="col-12">
        <div class="col-8 offset-md-2">
          <form>
            <div class="cad">
              <div class="form-row col-md-12 pb-3">
                <div class="form-group col-md-6 ">
                  <label for="inputName">Nome Completo:</label>
                  <input type="text" class="form-control nextItem" id="inputName" data-required="" />
                </div>
                <div class="form-group col-md-6">
                  <label for="text">Email:</label>
                  <input type="email" class="form-control nextItem" id="email" placeholder="seumail@test.dominio" data-required="" />
                </div>
              </div>
              <div class="form-row col-md-12 pb-3">
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Crie uma senha:</label>
                  <div class="input-group">
                    <input type="password" class="form-control nextItem" id="passwd" maxlength="20" data-required="" />
                    <div class="input-group-prepend">
                      <button type="button" class="btn btn-primary" id="btnViewPasswd"><i id="iconPasswd" class="fas fa-eye-slash"></i></button>
                    </div>
                  </div>
                  <small class="form-text text-muted">
                    <div class="progress" style="width: 100%; height: 5px;">
                      <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </small>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputCep">Cep</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="inputCep" maxlength="8" />
                    <div class="input-group-prepend">
                      <button type="button" class="btn btn-info input-group-text" id="searchCep">Buscar</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row col-md-12 pb-3">
                <div class="form-group col-md-5">
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
                <div class="form-group col-md-6">
                  <label for="cpf">Cidade: </label>
                  <input type="text" class="form-control nextItem" id="localidade" data-required="" />
                </div>
              </div>
              <div class="form-row col-md-12 pb-3">
                <div class="form-group col-md-6 ">
                  <label for="inputAddres">Endereço:</label>
                  <input type="address" class="form-control nextItem" id="inputAddres" />
                </div>
              </div>
              <div class="custom-control custom-switch pb-5">
                <input type="checkbox" class="custom-control-input" id="termos">
                <label class="custom-control-label" for="termos">Li e concordo com os <a href=<?php echo BASE_URL . "/terms"; ?>>Termos de uso</a></label>
              </div>
              <div class="cols-md-12">
                <button type="button" class="btn btn-success nextItem align-center nextItem" id="btnRegister">Cadastrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>
<?php
Bundles::renderJs([
  "js/apis",
  "js/regAjax",
  "js/register",
  "js/manipulation",
  "js/mainMethods"
]);
echo "
<script>
  const BASE_URL = '" . BASE_URL . "'
</script>";
?>

</html>