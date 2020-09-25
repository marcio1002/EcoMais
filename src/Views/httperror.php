<?php 
$this->layout("_theme", ["title" => "Ecomais - $errCode"]);

$this->start("error");
$info = ($errCode == "404") ? "Pagina Não encontrada" : "Ocorreu um erro no servidor volte para a página principal ou relate ao suporte sobre o erro";
   
echo <<<html
</div>
    <div style="height: 100vh" class="w-100 text-center">
        <div class="my-auto mx-auto py-5"></div>
        <div class="my-auto mx-auto py-5">
            <h1>{$errCode}</h1> 
            <p class="lead text-gray-800 mb-5">{$info}</p>
            <a id="back" href="#">&larr; Voltar página anterior</a>
        </div>
        <div class="my-auto mx-auto py-5"></div>
    </div>
html;
$this->stop();

$this->start("scripts"); 
 echo "<script> $('#back').click(() =>  window.history.back()) </script>";
$this->stop(); 

?>