<?php
  require_once __DIR__."/vendor/autoload.php";

    $handling = new Model\AccountHandling();

   if (!$handling->isLogged()) 
    {
      setcookie('_id',"",time() -  36000,"/");
      setcookie('_token',"",time() -  36000,"/");
    }else 
    {
      header("location: ./view/mostrar.php");
    } 

?>
<!DOCTYPE html>
<html lang="pt-BR">
 <head>
     <meta charset="utf-8">
     <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="Stylesheet">
     <link rel="stylesheet" type="text/css" href="./public/css/estilo.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
     <link type='text/css' rel='stylesheet' href='./public/css/style.css'/>
     <link type="text/css" rel="stylesheet" href='./public/css/themes/default.min.css'/>
    <link type='text/css' rel='stylesheet' href='./public/css/alertify.min.css'>
     <title>Login</title>
 </head>
 <body>
  <div class="login">
    <img src="./src/assets/imgs/ecom.jpg" class="usuario" width="100" height="100" alt="xxxxx">
    <h2>Login</h2>
    <form >
            <p>Email:</p>
            <input type="text" name="email" id="email" placeholder/>
            <p> Senha:</p>
            <input type="password" name="pwd" id="pwd" placeholder/>
            <input type="button" value="Login" id="login"/>
            <a href="#">Esqueci minha senha</a><br>
            <a href="http://localhost/WWW/CrudEcoMais/cadastro">Ainda não possuo uma conta?</a>
    </form>
  </div>
   <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <script src='http://localhost/WWW/CrudEcoMais/public/js/alertify.min.js'></script>
   <script src="http://localhost/WWW/CrudEcoMais/public/js/apis.js"></script>
   <script src='http://localhost/WWW/CrudEcoMais/public/js/reqAjax.js'></script>
   </body>
</html>