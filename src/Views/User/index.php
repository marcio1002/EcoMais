<?php
$this->layout("_theme", ["title" => "EcoMais - My Home"]);
?>

<!-- Masthead -->
<header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Encontre os melhores descontos perto da sua casa</h1>
      </div>
      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <form>
          <div class="form-row">
            <div class="col-12 col-md-9 mb-2 mb-md-0">
              <div class="input-group">
                <input type="text" id="search" class="form-control form-control-lg">
                <div class="input-group-append">
                  <select name="" id="option" autocomplete="on" autofocus="true" autocorrect="on" class="custom-select border-0 remove-focus h-auto">
                    <option value="" disabled selected>opção</option>
                    <option value="4">Região</option>
                    <option value="5">Produto</option>
                    <option value="6">Atacados</option>
                    <option value="7">Categoria</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <button type="button" id="btnSearch" class="btn btn-block remove-focus btn-lg bg-red-wine text-white font-weight-bold">Pesquisar!</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</header>

<!-- Mostrar Atacados relevantes -->
<section class="text-center bg-light-1 py-5">
  <div id="showCompany" class="carousel slide">
    <div class="corousel-inner" id="container-items"></div>
    <a href="#showCompany" class="carousel-control-prev" role="button" data-slide="prev">
      <span aria-hidden="true"><img src="https://img.icons8.com/material/48/000000/circled-chevron-left--v1.png" /></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a href="#showCompany" class="carousel-control-next" role="button" data-slide="next">
      <span aria-hidden="true"><img src="https://img.icons8.com/material/48/000000/circled-chevron-right--v1.png" /></span>
      <span class="sr-only">Próximo</span>
    </a>
  </div>
</section>

<!-- Icons Conteúdo -->
<section class="features-icons bg-white text-center">
  <div class="col-12">
    <div class="row">
      <div class="col-xl-3 col-md-6 col-sm-12 py-3">
        <div class="card text-white shadow-lg border-radius-30 pointer hover-animate m-auto" style="width: 18rem;">
          <div class="card-after-color"></div>
          <a href="http://" class="position-absolute w-100 h-100" style="z-index:1"></a>
          <img class="card-img-top img-fluid" src=<?= renderUrl("/src/assets/imgs/fruta.jpg"); ?> alt="Imagem de fruta">
          <div class="card-img-overlay">
            <h5 class="card-title text-shadow text-uppercase mb-0 mp-0">Frutas</h5>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 col-sm-12 py-3">
        <div class="card text-white shadow-lg border-radius-30 pointer hover-animate m-auto" style="width: 18rem;">
          <div class="card-after-color"></div>
          <a href="http://" class="position-absolute w-100 h-100" style="z-index:1"></a>
          <img class="card-img-top img-fluid" src=<?= renderUrl("/src/assets/imgs/verduras.jpg"); ?> alt="Imagem de fruta">
          <div class="card-img-overlay">
            <h5 class="card-title text-shadow text-uppercase"">Legumes</h5>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 col-sm-12 py-3">
        <div class="card text-white  position-relative shadow-lg border-radius-30 pointer hover-animate m-auto" style="width: 18rem;">
          <div class="card-after-color "></div>
            <a href="http://" class="position-absolute w-100 h-100" style="z-index:1"></a>
            <img class="card-img-top img-fluid" src=<?= renderUrl("/src/assets/imgs/carnes-congeladas.jpg"); ?> alt="Imagem de fruta">
          <div class="card-img-overlay overlay-content">
            <h5 class="card-title text-shadow text-uppercase"">Carnes</h5>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 col-sm-12 py-3">
        <div class="card text-white  shadow-lg border-radius-30 pointer hover-animate m-auto" style="width: 18rem;">
          <div class="card-after-color"></div>
          <a href="http://" class="position-absolute w-100 h-100" style="z-index:1"></a>
          <img class="card-img-top img-fluid" src=<?= renderUrl("/src/assets/imgs/produtos-limpeza.jpg"); ?> alt="Imagem de fruta">
          <div class="card-img-overlay overlay-content">
            <h5 class="card-title text-shadow text-uppercase"">Produtos de limpeza</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->start("scripts"); ?>
<script src=<?= renderUrl("/src/assets/js/user/index.js");?> ></script>
<script src=<?= renderUrl("/src/assets/js/user/search.js");?> ></script>
<?php $this->stop(); ?>