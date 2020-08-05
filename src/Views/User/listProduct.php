<?php
  require_once __DIR__ . "/../../../vendor/autoload.php";

use Ecomais\Controllers\ComponenteElement;
use Ecomais\Web\Bundles;

  $this->layout("_theme", ["title" => "EcoMais - My Home"]);

  $this->start("css");
    echo Bundles::renderCss(["css/dataTable"]);
    echo "<link rel='stylesheet' href='" .renderUrl("/src/assets/css/themes/load.css") . "' >";
  $this->stop();
?>

<div class="col-12 p-4 bg-dark">
  <div class="col-4 mx-auto my-auto  rounded bg-transparent" id="logoCompany" style="max-height: 400px;">
  </div>
</div>
<div class="col-12 bg-light">
  <div id="list-product" class="col-11 m-auto py-4 bg-transparent">
    <div id="load">
      <?= ComponenteElement::load()?>
    </div> 
  </div>
</div>
<?php 
$this->start("scripts");
  echo Bundles::renderJs(["js/dataTable"]);
?>

  <script src=<?= renderUrl("/src/assets/js/product/list-product.js")?> ></script>
<?php $this->stop()?>