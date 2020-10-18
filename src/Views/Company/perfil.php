<?php
$this->layout("_layout", ["subtitle" => "Meu Perfil"]);
$data =  $this->func()->verifyLoggedCompany();

use Ecomais\Web\Bundles;

$comp = new Ecomais\Controllers\Company\AccountManagerCompany();

$this->start("css");
Bundles::render(["perfil.css"], fn ($file) => print_r("<link rel=\"stylesheet\" href=\"$file\">"));
$this->stop();
?>
<div class="d-flex flex-column justify-content-center align-content-center py-1" style="height: 100vh;">
  <form id="formImage" enctype="multipart/form-data">
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3 m-auto my-auto">
      <div class="card shadow-lg bg-white border-secondary text-light w-100">
        <div class="form-group">
          <div id="logo-company" class="bg-light position-relative pointer overflow-h d-flex flex-column justify-content-center align-items-center border-secondary" style="height: 300px;">
            <?php
            if ($data->imagem && file_exists($data->imagem)) :
              $logoCompany = renderUrl("/{$data->imagem}");
              echo "<img id='logo' title='Click ou arraste uma imagem aqui' class='card-img-top img-fluid' style='max-height: 100%; height: 20em' src='$logoCompany' alt='Uma Imagem de capa do atacado'>";
            else :
              echo "<p class='text-center'>Click ou arraste uma imagem aqui.</p>";
            endif;
            ?>
            <input type="hidden" id='id' name="id" value=<?= $data->id_empresa ?>>
            <input type="file" id="inputFile" class="d-none" name="image" accept="image/*" capture>
          </div>
          <div class="card-body border-top">
            <input type="text" class="form-control-plaintext h2 text-center m-auto" value=<?= $data->razao ?? "''" ?> readonly>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 d-flex justify-content-center  py-4">
      <div class="col-xl-3  col-md-4 col-sm-12">
        <button id="saveImage" class="btn btn-block bg-success btn-bg-shadow text-white remove-focus font-weight-bold font-size-1-1em">Salvar</button>
      </div>
      <div class="col-xl-3 col-md-4 col-sm-12">
        <button id="removeImage" class="btn btn-block bg-danger btn-bg-shadow text-white remove-focus font-weight-bold font-size-1-1em">Excluir</button>
      </div>
    </div>
  </form>
</div>
<?php
$this->start("scripts");
Bundles::render(["perfil.js"], fn ($file) => print_r("<script src=\"$file\"></script>"));
$this->stop() ?>