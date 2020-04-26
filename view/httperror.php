<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0; charset=utf-8">
    <title><?php if(isset( $_SESSION['codeError'])) echo  $_SESSION['codeError'];?></title>
    <style>
        body{
            background: url("../src/assets/svgs/codeerror.svg");
            background-size: 100%;
        }
        .center-align {
            text-align: center;
        }
        .size-1em {
            font-size: 1em;
        }
        .size-2em {
            font-size: 2em;
        }
        .size-3em {
            font-size: 3em;
        }
        .text-white {
            color: #fff;
        }
    </style>
</head>
<body>
        <h1 class="center-align size-3em"> Erro: <?php if(isset( $_SESSION['codeError'])) echo  $_SESSION['codeError'];?></h1>
        <p class='text-white center-align size-2em'>
            Houve um erro no servidor volte para a página principal ou relate ao suporte sobre o erro;
        </p>
</body>
</html>