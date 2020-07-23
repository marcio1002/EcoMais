<?php
$this->layout("_theme", ["title" => "Empresa"]);
?>

<?php $this->start("css"); ?>
<link rel="stylesheet" href=<?= renderUrl("/src/assets/css/company/registerProduct.css") ?>>
<?php $this->stop(); ?>


<div class="register-form mt-3 mb-3">
  <div class="container">
    <div class="row">
      <div class="col-md-6 bg-dark">
        <form id="#formProduct" class="p-4 text-white">
          <div class="form-group">
            <label for="name"><i class="nome"></i> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-octagon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
              </svg> Name</label>
            <input type="text" class="form-control" id="nome">
          </div>
          <div class="form-group">
            <label for="price"><i class="price"></i><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-octagon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
              </svg> Preço</label>
            <input type="text" class="form-control" id="price">
          </div>
          <div class="form-group">
            <label for="brand"><i class="brand"></i><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-octagon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
              </svg> Marca</label>
            <input type="text" class="form-control" id="brand">
          </div>
          <div class="form-group">
            <label for="description"><i class="description"></i><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-octagon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
              </svg> Descrição</label>
            <input type="text" class="form-control" id="description">
          </div>
          <div class="form-group">
            <label for="quantity"><i class="quantity"></i><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-octagon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
              </svg> Quantidade</label>
            <input type="text" class="form-control" id="quantity">
          </div>
          <div class="form-group">
            <label for="date_start"><i class="date_start"></i><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-octagon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
              </svg> Data/hora início da promoção</label>
            <input type="date" class="form-control" id="date_start">
          </div>
          <div class="form-group">
            <label for="date_end"><i class="date-end"></i><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-octagon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
              </svg> Data/hora término da promoção</label>
            <input type="date" class="form-control" id="date_end">
          </div>
          <div class="form-group">
            <label for="classification"><i class="classification"></i><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-octagon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
              </svg> Classificação</label>
            
            <select class="custom-select remove-focus" id="classification">
              <option selected disabled>Escolher...</option>
              <option value="1">Frutas</option>
              <option value="2">Legumes</option>
              <option value="3">Carnes</option>
              <option value="3">Produtos de limpeza</option>
            </select>
            <input type="text" class="form-control">
          </div>
          <button type="button" id="registerProduct" class="btn btn-success my-2 my-sm-3 float-right">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->start("scripts"); ?>
<script src=<?= renderUrl("/src/assets/js/product/registerProduct.js") ?>></script>
<?= $this->stop(); ?>