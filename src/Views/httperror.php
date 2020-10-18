<?php 
$this->layout("_layout", ["title" => "Ecomais - $errCode"]);

$this->start("error");
$info = ($errCode == "404") ? "Página Não encontrada" : "Ocorreu um erro no servidor!<br/> Se erro persistir entre contato com o administrador para obter mais informações.";
   
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