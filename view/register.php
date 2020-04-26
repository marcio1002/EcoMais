<?php
    $bundle = new  Bundles\Bundles();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <?php
        
        $bundle->loadCss([
            "css/materialize",
            "css/alertify",
            "css/style"
            ]);
    ?>
</head>

<body>
    <form id='validate'>
        <div class='row'>
            <div class='input-field col s6'>
                <input type="text" name="name" maxlength='35' id='name'/>
                <label for='name'>Nome:</label>
            </div>
        </div>
        <div class='row'>
            <div class='input-field col s6'>
                <input type="email" name="email" id="email" maxlength='55' />
                <label for='email'>Email:</label>
            </div>
        </div>
        <div class='row'>
            <div class='input-field col s6'>
                <input type="password" name="password" id='pwd' maxlength="15" /> <input type="button" value="Ver" class='btn small indigo lighten-1' id='btnPwd' />
                <label for='pwd'>Senha:</label>
                <span id='length'></span>
            </div>
        </div>
        <div class='row'>
            <div class='input-field col s6'>
                <input type='text' id='cpf' pattern='\d{3}.\d{3}.\d{3}-\d{2}' title='Digite o CPF no formato nnn.nnn.nnn-nn' maxlength='14' />
                <label for='cpf'>CPF:</label>
            </div>
        </div>
        <div class='row'>
            <div class='input-field col s6'>
                <input type='text' name='cep' id='cep' maxlength='8' title='Digite o cep no formato: nnnnnnnn. Não é aceito letras, traços, virgula e caracteres especiais' /> <input type='button' value='Pesquisar' class='btn small indigo lighten-1' id='search' />
                <label for='cep'>cep:</label>
            </div>
        </div>
        <div class='row'>
        <div class='input-field col s6'>
                <select name='stati' id='stati'>
                    <option value='AC'>Acre</option>
                    <option value='AL'>Alagoas</option>
                    <option value='AP'>Amapá</option>
                    <option value='AM'>Amazonas</option>
                    <option value='BA'>Bahia</option>
                    <option value='CE'>Ceará</option>
                    <option value='DF'>Distrito Federal*</option>
                    <option value='ES'>Espírito Santo</option>
                    <option value='GO'>Goiás</option>
                    <option value='MA'>Maranhão</option>
                    <option value='MS'>Mato Grosso do Sul</option>
                    <option value='MG'>Minas Gerais</option>
                    <option value='PA'>Pará</option>
                    <option value='PB'>Paraíba</option>
                    <option value='PR'>Paraná</option>
                    <option value='PE'>Pernambuco</option>
                    <option value='PI'>Piauí</option>
                    <option value='RJ'>Rio de Janeiro</option>
                    <option value='RN'>Rio Grande do Norte</option>
                    <option value='RS'>Rio Grande do Sul</option>
                    <option value='RO'>Rondônia</option>
                    <option value='RR'>Roraima</option>
                    <option value='SC'>Santa Catarina</option>
                    <option value='SP'>São Paulo</option>
                    <option value='SE'>Sergipe</option>
                    <option value='TO'>Tocantins</option>
                </select>
            <label>Estado:</label>
        </div>
        </div>
        <div class='row'>
            <div class='input-field col s6'>
                <input type='text' name='city' id='city' maxlength='35' />
                <label for='city'>Cidade:</label>
            </div>
        </div>
        <div class='row'>
            <div class='input-field col s6'>
                <input type='text' name='addre' id='addre' maxlength='35' />
                <label for='addre'>Endereço:</label>
            </div>
        </div>
        <div class='row'>
            <div class='input-field col s6'>
                <input type='text' name='number' id='number' maxlength='10' />
                <label for='number'>numero:</label>
            </div>
        </div>
        <div class='row'>
            <input type='button' class='btn indigo lighten-1 ' id="submit" value="Cadastra-se"/>
        </div>
    </form>
    <button  class='btn indigo lighten-1'><a  class='black-text' href='https://ecomais.herokuapp.com/product'>Visualizar</a></button>

   <?php
    $bundle->loadJs([
        "js/jquery",
        "js/alertify",
        "js/axios",
        "js/ajax",
        "js/regAjax",
        "js/apis",
        "js/manipulation",
    ])
   ?>
</body>

</html>