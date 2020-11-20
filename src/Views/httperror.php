<?php 
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use RenderFile\RenderFile as Bundles;

Bundles::render(
    ["bootstrap.min.css.map", "bootstrap.min.css", "eco.style.css"],
    fn($file) => printf("<link rel='stylesheet' href='%s'>",renderUrl($file)),
);

$info = ($errCode == "404") ? "Página Não encontrada" : "Ocorreu um erro no servidor!<br/> Se erro persistir entre contato com o administrador para obter mais informações.";
   
echo <<<html
</div>
    <div style="height: 100vh" class="w-100 text-center">
        <div class="my-auto mx-auto py-5"></div>
        <div class="my-auto mx-auto py-5">
            <h1>{$errCode}</h1> 
            <p class="lead text-gray-800 text-weight-800 mb-5">{$info}</p>
            <a id="back" href="#">&larr; Voltar página anterior</a>
        </div>
        <div class="my-auto mx-auto py-5"></div>
    </div>
html;
Bundles::render(["jquery-3.5.1.min.js"], fn($file) => printf("<script src='%s'></script>",renderUrl($file)));
echo "<script> $('#back').click(() =>  window.history.back()) </script>";

?>