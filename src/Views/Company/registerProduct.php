<?php
$this->layout("_theme",  ["subtitle" => "Cadastro de Produtos"]);
?>

<?php $this->start("css"); ?>
  <link rel="stylesheet" href=<?= renderUrl("/src/assets/css/company/registerProduct.css") ?> >
<?php $this->stop(); ?>


<div class="register-form py-xl-4 py-lg-4 py- pb-sm-3 col-12">
<div class="row">
      <div class="col-xl-6 col-lg-6 col-md-8 bg-dark m-auto">
        <form id="formProduct" class="p-4 text-white" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name"><span class='required'>*</span><b>Name:</b></label>
            <input type="text" id="nome" name="name" class="form-control" data-required="">
          </div>
          <div class="form-group">
            <label for="price"><span class='required'>*</span><b>Preço</b></label>
            <input type="text" id="price" name="price" class="form-control" data-required="">
          </div>
          <div class="form-group">
            <label for="brand"><span class='required'>*</span><b>Marca</b></label>
            <input type="text" id="brand" name="brand" class="form-control" data-required="">
          </div>
          <div class="form-group">
            <label for="description"><span class='required'>*</span><b>Descrição</b></label>
            <input type="text" id="description" name="description" class="form-control" data-required="">
          </div>
          <div class="form-group">
            <label for="quantity"><span class='required'>*</span><b>Quantidade</b></label>
            <input type="text" id="quantity" name="quantity" class="form-control" data-required="">
          </div>
          <div class="form-group">
            <label for="date_start"><span class='required'>*</span><b>Data de início da promoção</b></label>
            <input type="date" id="date_start" name="date_start" class="form-control" data-required="">
          </div>
          <div class="form-group">
            <label for="date_start"><span class='required'>*</span><b>hora de início da promoção</b></label>
            <input type="time" id="time_start" name="time_start" class="form-control" data-required="">
          </div>
          <div class="form-group">
            <label for="date_end"><span class='required'>*</span><b>Data de término da promoção</b></label>
            <input type="date" id="date_end" name="date_end" class="form-control" data-required="">
          </div>
          <div class="form-group">
            <label for="date_end"><span class='required'>*</span><b>hora de término da promoção</b></label>
            <input type="time" id="time_end" name="time_end" class="form-control" data-required="">
          </div>
          <div class="form-group">
            <label for="classification"><span class='required'>*</span><b>Classificação</b></label>
            <select id="classification" name="classification" class="custom-select remove-focus" data-required="">
              <option selected disabled value="">Escolher...</option>
              <option value="1">Frutas</option>
              <option value="2">Legumes</option>
              <option value="3">Carnes</option>
              <option value="3">Produtos de limpeza</option>
            </select>
          </div>
          <input type="hidden" name="fkCompany" value=<?= $this->data['id_empresa']?> >
          <div class="form-group py-5">
            <button id="registerProduct" class="btn btn-success my-2 my-sm-3 float-right">Cadastrar</button>
          </div>
        </form>
      </div>
    </div>
</div>

<?= $this->start("scripts"); ?>
<script src=<?= renderUrl("/src/assets/js/product/registerProduct.js") ?>></script>
<?= $this->stop(); ?>