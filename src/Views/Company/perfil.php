<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

$comp = new Ecomais\Controllers\Company\AccountManagerCompany();

$this->layout("_theme", ["subtitle" => "Meu Perfil"]);

$this->start("css");
?>
<link rel="stylesheet" type="text/css" href=<?= renderUrl("/src/assets/css/company/perfil.css") ?>>
<?= $this->stop(); ?>
<div class="col-12 py-1" style="height: 100vh;">
  <div class="col-xl-4 col-lg-4 col-md-7 col-sm-12 m-auto my-auto">
    <div class="card shadow" style="height: 500px;max-height: 100%">
      <form id="formImage" enctype="multipart/form-data">
        <div class="form-group">
          <div id="logo-company" class="bg-light position-relative pointer overflow-h d-flex flex-column justify-content-center align-items-center" style="height: 300px;border: 1px dotted #000">
            <?php 
            if($this->data['imagem'] && file_exists($this->data['imagem'])): 
              $logoCompany = renderUrl("/{$this->data["imagem"]}");
              echo "<img id='logo' title='Click ou arraste uma imagem aqui' class='card-img-top img-fluid  border-none' src='$logoCompany' alt='Uma Imagem de capa do atacado' class='img-thumbnail' style='width: 100%;height: auto;'>";
              else:
              echo "<p class='text-center'>Click ou arraste uma imagem aqui.</p>";
            endif;
            ?>

          </div>
          <input type="hidden" id='id' name="id" value=<?= $this->data['id_empresa']?> >
          <input type="file" id="image"  name="image" accept="image/*" style="display:none" capture>
        </div>
        <div class="card-body">
          <p class="card-title">
            <div class="form-group row">
              <input type="text" class="form-control-plaintext h2 text-center m-auto" value=<?= $this->data['razao'] ?? "''" ?> readonly>
            </div>
          </p>
        </div>
    </div>
  </div>
  <div class="col-12 py-4">
    <div class="col-xl-4 col-lg-4 col-md-7 col-sm-12 mx-auto my-auto">
      <button id="saveImage" class="btn btn-block bg-red-wine text-white remove-focus font-weight-bold font-size-1-1em">Salvar</button>
    </div>
  </div>
  </form>
</div>
<?php $this->start("scripts") ?>
<script src=<?= renderUrl("/src/assets/js/company/perfil.js") ?>></script>
<?php $this->stop() ?>