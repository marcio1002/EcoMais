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
    "css/manipulation",
    "js/jquery",
    "bootstrap",
    "js/jquery",
    "alertify",
    "css/style"
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
                  <label for="inputName1">Nome Completo:</label>
                  <input type="text" class="form-control nextItem" id="inputName1">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email:</label>
                  <input type="email" class="form-control nextItem" id="email">
                </div>
              </div>
              <div class="form-row col-md-12 pb-3">
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Crie uma senha:</label>
                  <div class="input-group">
                    <input type="password" class="form-control nextItem" id="passwd">
                    <div class="input-group-prepend">
                      <button type="button" class="btn btn-info input-group-text" id="searchCep"></button>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-6 pb-3">
                  <label for="cpf">CPF: </label>
                  <input type="text" class="form-control nextItem" id="cpf">
                </div>
              </div>
              <div class="form-row col-md-12 pb-3">
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
                  <select id='stati' name='stati' class="form-control nextItem">
                    <option selected>Escolha...</option>
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
              <div class="form-row col-md-12 pb-3">
                <div class="form-group col-md-6 ">
                  <label for="inputAddress">Endereço:</label>
                  <input type="address" class="form-control nextItem" id="inputAddress">
                </div>

                <div class="form-group col-md-6">
                  <label for="cpf">Cidade: </label>
                  <input type="text" class="form-control nextItem" id="city">
                </div>
              </div>
              <div class="custom-control custom-switch pb-5">
                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1">Li e concordo com os <a href=<?php echo BASE_URL . "/terms"; ?>>Termos de uso</a></label>
              </div>
              <div class="cols-md-12">
                <button type="button" class="btn btn-success nextItem setLoad align-center" id="register">Cadastrar</button>
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
  "js/manipulation",
  "js/mainMethods"
])
?>

</html>