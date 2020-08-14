<?php 
$this->layout("_theme", ["title" => "Ecomais - $errCode"]);

$this->start("error");
$info = ($errCode == "404") ? "Pagina Não encontrada" : "Ocorreu um erro no servidor volte para a página principal ou relate ao suporte sobre o erro";
   
echo <<<html
    <div style="height: 100vh" class="w-100 text-center ">
        <h1>{$errCode}</h1> 
        <p class="text-red-wine font-size-1-5em">$info</p> 
    </div>
html;
$this->stop()?>

