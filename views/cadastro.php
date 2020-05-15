<?php
require_once __DIR__ . "/../vendor/autoload.php";
use Controllers\ComponenteElement;
use Web\Bundles;
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
    <h5>Já Possui uma conta? Faça um <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalLogin">Login</button></h5>
  </div>

  <main>
    <form>
      <div class="cad">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName1">Nome Completo:</label>
            <input type="text" class="form-control nextItem" id="inputName1">
          </div>
          <div class="form-group col-md-6">
            <label for="date1">Data De Nascimento:</label>
            <input type="date" class="form-control nextItem" id="date1">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Endereço:</label>
          <input type="address" class="form-control nextItem" id="inputAddress">
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control nextItem" id="cpf">
          </div>
          <div class="form-group col-md-6">
            <label for="stati">Cidade</label>
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
          <div class="form-group col-md-2">
            <label for="inputState">Estado</label>
            <select id="inputState" class="form-control nextItem">
              <option selected>Escolha...</option>
              <option>...</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputCep">Cep</label>
            <input type="text" class="form-control" id="inputCep">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Insira Seu Email:</label>
            <input type="email" class="form-control nextItem" id="email">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Crie uma senha:</label>
            <input type="password" class="form-control nextItem" id="passwd">
          </div>
        </div>
        <div class="custom-control custom-switch ">
          <input type="checkbox" class="custom-control-input" id="customSwitch1">
          <label class="custom-control-label" for="customSwitch1">Li e concordo com os <a href="#">Termos de uso</a></label>
        </div>
        <button type="button" class="btn btn-success nextItem setLoad" id="register">Cadastrar</button>
      </div>
    </form>

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