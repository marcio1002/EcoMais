<?php
use Ecomais\Controllers\ComponenteElement as componente;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=7"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
    <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>
    <link rel='stylesheet' type='text/css' href=<?=renderUrl("src/assets/css/estilo.css") ?> />
    <link rel="stylesheet" href=<?= renderUrl("src/assets/css/modalLogin.css"); ?> >
    <?= $this->section("css"); ?>
    <title><?=$title?></title>
</head>

<body>
    <header>
    <?php
    if(!$this->section("error"))
        componente::navBarHome();
        componente::modalLogin();
    ?>
    </header>
    <main>
        
        <?php
            if($this->section("error")):
                echo $this->section("error");
            else:
                echo $this->section("content"); 
            endif;
        ?>
    </main>
    <footer>
    <?php
        if($this->section('footer')):
            echo $this->section('footer');
        endif;
    ?>
    </footer>
    <script src='https://code.jquery.com/jquery-3.4.1.min.js' integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=' crossorigin='anonymous'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
    <script src=<?= renderUrl("src/assets/js/login.js"); ?> ></script>
    <?php
        echo $this->section("scripts");

        echo"<script>
                const BASE_URL = '" . BASE_URL . "';
            </script>";
    ?>
</body>

</html>