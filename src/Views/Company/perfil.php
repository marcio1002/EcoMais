<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

$comp = new Ecomais\Controllers\Company\AccountManagerCompany();

$this->layout("_theme", ["subtitle" => "Seu Perfil"]);

if(isset($_COOKIE['_id'])) {
  $row = $comp->listenInfoCompany($_COOKIE['_id']);
}

?>

<div class="col-12 py-1" style="height: 91vh;">
  <div class="col-xl-4 col-lg-4 col-md-7 col-sm-12 m-auto my-auto">
    <div class="card shadow" style="height: 50%;">
    <div class="form-group">
      <img id="logo-company" style="cursor: pointer;" class="card-img-top img-fluid img-thumbnail border-none" src=<?= $row["image"] ?? renderUrl("/src/assets/imgs/logo-atacado-default.jpg"); ?> alt="Uma Imagem de capa do atacado" class="img-thumbnail" style="width: 100%;height: auto;">
      <input type="file" id="fil" style="display: none">
    </div>
      <div class="card-body">
        <p class="card-title">
          <div class="form-group row">
            <input type="text" class="form-control-plaintext h2 text-center m-auto" value=<?= $row['razao'] ?> readonly>
          </div>
        </p>
      </div>
    </div>
  </div>
  <div class="col-12 py-4">
    <div class="col-xl-4 col-lg-4 col-md-7 col-sm-12 mx-auto my-auto">
      <button type="button" class="btn btn-block bg-red-wine text-white font-weight-bold font-size-1-1em">Salvar</button>
    </div>
  </div>
</div>
<?php $this->start("scripts")?>
<script src=<?= renderUrl("/src/assets/js/company/perfil.js")?> ></script>
<?php $this->stop()?>