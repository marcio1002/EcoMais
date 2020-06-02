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
    <?= $this->section("css"); ?>
    <title><?= $title; ?></title>
</head>

<body>

    <?php
    if ($this->section('error')) :
        echo $this->section('error');
    else :
    ?>
        <header>
        <?php
        componente::navBarHome();
        componente::modalLogin();
    endif;
        ?>
        </header>
        <main>
            <?= $this->section("content"); ?>
        </main>
        <footer>
            <div id="contact-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="main-title">Entre em contato conosco</h3>
                        </div>
                        <div class="col-md-4 contact-box">
                            <i class="fas fa-phone"></i>
                            <p><span class="contact-tile">Ligue para:</span> (48)99999-9999</p>
                            <p><span class="contact-tile">Horários:</span> 8:00 - 19:00</p>
                        </div>
                        <div class="col-md-4 contact-box">
                            <i class="fas fa-envelope"></i>
                            <p><span class="contact-tile">Envie um email:</span> ecomais5354@gmail.com</p>
                        </div>
                        <div class="col-md-4 contact-box">
                            <i class="fas fa-map-marker-alt"></i>
                            <p><span class="contact-tile">numero:</span> Rua Lorem Ipsum - 1314</p>
                        </div>
                        <div class="col-md-6" id="msg-box">
                            <p>Ou nos deixe uma mensagem:</p>
                        </div>
                        <div class="col-md-6" id="contact-form">
                            <form action="" onclick="return false">
                                <input type="text" class="form-control" placeholder="E-mail" name="email">
                                <input type="text" class="form-control" placeholder="Assunto" name="subject">
                                <textarea class="form-control" rows="3" placeholder="Sua mensagem..." name="message"></textarea>
                                <input type="button" class="main-btn" value='enviar' />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="copy-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Desenvolvido por <a href="#" target="_blank">EcoMais</a> &copy; 2020</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src='https://code.jquery.com/jquery-3.4.1.min.js' integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=' crossorigin='anonymous'></script>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
        <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
        <?php
            echo $this->section("scripts");
    
            echo"<script>
                    const BASE_URL = '" . BASE_URL . "';
                </script>";
        ?>
</body>

</html>