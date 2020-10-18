<?php
$this->layout("_layout", ["title" => "EcoMais - My Home"]);

$this->func()->verifyLoggedUser();

use Ecomais\Views\Component\ComponenteElement as component;
use Ecomais\Web\Bundles;


$this->start("css");
  Bundles::render(["load.css","datatables.min.css","dataTables.bootstrap4.min.css"],fn($file) => print_r("<link rel=\"stylesheet\" href=\"$file\">"));
$this->stop();
?>
<div class="col-12 p-4 bg-dark">
  <div class="col-4 mx-auto my-auto rounded bg-transparent" id="logoCompany" style="max-height: 400px;">
  </div>
</div>
<div class="col-12 bg-light">
  <div id="list-product" class="m-auto py-4 bg-transparent">
    <div id="load">
      <?= component::load()?>
    </div> 
  </div>
</div>
<?php 
$this->start("scripts");
  echo Bundles::render(["list-product.js","datatables.min.js","dataTables.bootstrap4.min.js"],fn($file) => print_r("<script src=\"$file\"></script>"));
$this->stop();
?>