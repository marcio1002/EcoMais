<?php

use Ecomais\Web\Bundles;

$this->layout("_theme", ["subtitle" => "Configurações"]);

$this->func()->verifyLoggedCompany();

if (isset($data)) {  
  switch ($data->pacote) {
    case "10":
      $package = "<option value='10' selected>Sacolinha</option>";
      break;
    case "20":
      $package = "<option value='20' selected>Cestinha</option>";
      break;
    case "30":
      $package = "<option value='30' selected>⭐Carrinho</option>";
      break;
  }
}
?>

<div class="col-12 p-2">
  <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12 m-xl-auto m-lg-auto">
    <div class="card shadow-sm">
      <div class="card-header">
        <h2>Informações da conta</h2>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Fantasia:</label>
          <div class="col-sm-10 mb-3">
            <input type="text" id="disabledTextInput" class="form-control text-dark" value=<?= $data->fantasia ?? "''"; ?> disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Razão:</label>
          <div class="col-sm-10 mb-3">
            <input type="text" id="reason" class="form-control text-dark" value=<?= $data->razao ?? "''"; ?> disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">CNPJ:</label>
          <div class="col-sm-10 mb-3">
            <input type="text" id="cnpj" class="form-control text-dark" value=<?= $data->cnpj ?? "''"; ?> disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Cidade:</label>
          <div class="col-sm-10 mb-3">
            <input type="text" id="locality" class="form-control text-dark col-xl-8 col-lg-8 col-md-8 col-sm-12" value=<?= $data->cidade ?? "''"; ?> disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Estado:</label>
          <div class="col-sm-10 mb-3">
            <input type="text" id="uf" class="form-control text-dark col-xl-2 col-lg-2 col-md-5 col-sm-12" value=<?= $data->uf ?? "''"; ?> disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Email:</label>
          <div class="col-sm-10 mb-3">
            <input type="text" id="email" data-modify="" class="form-control text-dark" value=<?= $data->email ?? "''"; ?> disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Telefone:</label>
          <div class="col-sm-10 mb-3">
            <input type="text" id="contact" data-modify="" class="form-control text-dark col-xl-8 col-lg-8 col-md-8 col-sm-12" value=<?= $data->contato ?? "''"; ?> disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Plano:</label>
          <div class="col-sm-10">
            <select id="typePackage" class="custom-select text-dark col-xl-5 col-lg-5 col-md-10 col-sm-12" disabled>
              <?= $package ?? "<option value='' selected disabled>...</option>" ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="input-group mb-3">
            <label for="staticEmail" class="col-sm-2 col-form-label">Senha:</label>
            <input id="passwd" type="password" data-modify="" class="form-control text-dark ml-3 col-xl-8 col-lg-8 col-md-10 col-sm-12 rounded" autocomplete="current-password" maxlength="20" disabled/>
            <div class="input-group-prepend">
              <button type="button" class="btn btn-primary rounded" id="btnViewPasswd" disabled><i id="iconPasswd" class="fas fa-eye-slash"></i></button>
            </div>
          </div>
        </div>
        <div class="form-group row confirmPasswd" style="display: none;">
          <label for="staticEmail" class="col-sm-2 col-form-label">Confirme:</label>
          <div class="col-sm-10">
            <input id="confirmPasswd" type="password" class="form-control text-dark col-xl-10 col-lg-10 col-md-5 col-sm-12" disabled>
          </div>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="id_company" value=<?= $data->id_empresa ?? ""; ?>>
  <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 m-xl-auto m-lg-auto p-3 mb-2">
    <div class="row justify-content-between">
      <button type="button" id="save-config-company" class="btn btn-success font-weight-bold shadow" disabled>Salvar alterações</button>
      <button type="button" id="edit-info" class="btn btn-success bg-red-wine font-weight-bold shadow">Editar</button>
      <button type="button" id="delete-company" class='btn text-danger btn-focus-shadow-none bg-white shadow'>Excluir conta</button>
    </div>
  </div>
</div>
<?php
$this->start("scripts");
  Bundles::render(["config.js"], fn($file) => print_r("<script src=\"$file\"></script>"));
$this->stop();
?>