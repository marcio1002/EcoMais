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
                <input type="text" class="form-control form-control-lg">
                <div class="input-group-append">
                  <select name="category" id="category" class="custom-select border-left remove-focus" style="height: auto;">
                    <option value="" disabled selected>opção</option>
                    <option value="4">Região</option>
                    <option value="6">Produto</option>
                    <option value="6">Atacados</option>
                    <option value="6">Categoria</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <button type="button" class="btn btn-block btn-lg btn-primary">Pesquisar!</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</header>

<!-- Mostrar Atacados relevantes -->
<section class="text-center bg-light py-5">
  <div id="showCompany"  class="carousel slide">
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

<!-- Icons Grid -->
<section class="features-icons bg-light text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="icon-screen-desktop m-auto text-primary"></i>
          </div>
          <h3>Fully Responsive</h3>
          <p class="lead mb-0">This theme will look great on any device, no matter the size!</p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="icon-layers m-auto text-primary"></i>
          </div>
          <h3>Bootstrap 4 Ready</h3>
          <p class="lead mb-0">Featuring the latest build of the new Bootstrap 4 framework!</p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="icon-check m-auto text-primary"></i>
          </div>
          <h3>Easy to Use</h3>
          <p class="lead mb-0">Ready to use with your own content, or customize the source files!</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->start("scripts");?>
<script src=<?= renderUrl("/src/assets/js/user/index.js");?> ></script>
<?php $this->stop();?>