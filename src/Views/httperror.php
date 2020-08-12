<?php 
$this->layout("_theme", ["title" => "Ecomais - $errCode"]);

$this->start("error");
$info = ($errCode == "404") ? "Pagina Não encontrada" : "Ocorreu um erro no servidor volte para a página principal ou relate ao suporte sobre o erro";
$background  = ($errCode == "404") ? renderUrl("/src/assets/imgs/error404.png") : renderUrl("/src/assets/imgs/error404.jpg");
   
echo "
        <div style='background: url($background) no-repeat #777982; background-size: 90%; background-position: 25% 53%; width:100%; height: 100vh;font-size: 2em;'>
        </div>
    ";
$this->stop()?>