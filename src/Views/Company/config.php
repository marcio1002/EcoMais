<?php
$this->layout("_layout", ["subtitle" => "Configurações"]);

$data = ''; //$this->func()->verifyLoggedCompany();

use Ecomais\Web\Bundles;


if (isset($data) && !empty($data)) {
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
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label text-white">Fantasia:</label>
      <div class="col-sm-10 mb-3">
        <input type="text" id="disabledTextInput" class="form-control text-white bg-blue-night remove-focus" value=<?= $data->fantasia ?? "''"; ?> disabled>
      </div>
    </div>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label text-white">Razão:</label>
      <div class="col-sm-10 mb-3">
        <input type="text" id="reason" class="form-control text-white bg-blue-night remove-focus" value=<?= $data->razao ?? "''"; ?> disabled>
      </div>
    </div>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label text-white">CNPJ:</label>
      <div class="col-sm-10 mb-3">
        <input type="text" id="cnpj" class="form-control text-white bg-blue-night remove-focus" value=<?= $data->cnpj ?? "''"; ?> disabled>
      </div>
    </div>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label text-white">Cidade:</label>
      <div class="col-sm-10 mb-3">
        <input type="text" id="locality" class="form-control text-white bg-blue-night remove-focus col-xl-8 col-lg-8 col-md-8 col-sm-12" value=<?= $data->cidade ?? "''"; ?> disabled>
      </div>
    </div>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label text-white">Estado:</label>
      <div class="col-sm-10 mb-3">
        <input type="text" id="uf" class="form-control text-white bg-blue-night remove-focus col-xl-2 col-lg-2 col-md-5 col-sm-12" value=<?= $data->uf ?? "''"; ?> disabled>
      </div>
    </div>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label text-white">Email:</label>
      <div class="col-sm-10 mb-3">
        <input type="text" id="email" data-modify="" class="form-control text-white bg-blue-night remove-focus" value=<?= $data->email ?? "''"; ?> disabled>
      </div>
    </div>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label text-white">Telefone:</label>
      <div class="col-sm-10 mb-3">
        <input type="text" id="contact" data-modify="" class="form-control text-white bg-blue-night remove-focus col-xl-8 col-lg-8 col-md-8 col-sm-12" value=<?= $data->contato ?? "''"; ?> disabled>
      </div>
    </div>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label text-white">Plano:</label>
      <div class="col-sm-10">
        <select id="typePackage" class="custom-select text-white bg-blue-night remove-focus col-xl-5 col-lg-5 col-md-10 col-sm-12" disabled>
          <?= $package ?? "<option value='' selected disabled>...</option>" ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="input-group mb-3">
        <label for="staticEmail" class="col-sm-2 col-form-label text-white">Senha:</label>
        <input id="passwd" type="password" data-modify="" class="form-control text-white bg-blue-night remove-focus ml-3 col-xl-8 col-lg-8 col-md-10 col-sm-12 rounded" autocomplete="current-password" maxlength="20" disabled />
        <div class="input-group-prepend">
          <button type="button" class="btn btn-primary rounded remove-focus" id="btnViewPasswd" disabled><i id="iconPasswd" class="fas fa-eye-slash"></i></button>
        </div>
      </div>
    </div>
    <div class="form-group row confirmPasswd" style="display: none;">
      <label for="staticEmail" class="col-sm-2 col-form-label text-white">Confirme:</label>
      <div class="col-sm-10">
        <input id="confirmPasswd" type="password" class="form-control text-white bg-blue-night remove-focus col-xl-10 col-lg-10 col-md-5 col-sm-12" disabled>
      </div>
    </div>
  </div>
  <input type="hidden" id="id_company" value=<?= $data->id_empresa ?? ""; ?>>
  <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 m-auto m-lg-auto p-3">
    <div class="row flex-nowrap justify-content-around">
      <button type="button" id="save-config-company" class="btn btn-success btn-bg-shadow text-weight-800 shadow mr-3" disabled>Salvar alterações</button>
      <button type="button" id="edit-info" class="btn btn-light btn-bg-shadow text-weight-800 shadow mr-3">Editar</button>
      <button type="button" id="delete-company" class='btn bg-red-wine btn-bg-shadow text-weight-800 text-white  remove-focus shadow mr-3'>Excluir conta</button>
    </div>
  </div>
</div>
<?php
$this->start("scripts");
Bundles::render(["config.js"], fn ($file) => print_r("<script src=\"$file\"></script>"));
$this->stop();
?>