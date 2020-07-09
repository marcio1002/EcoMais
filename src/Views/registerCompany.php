<?php

use Ecomais\Web\Bundles;

$google  = new \Ecomais\Models\AuthGoogle("/cadastro/empresa");

$authGoogleUrl = $google->getAuthURL();

$code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED);
$err  = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED);

$name = "";
$email = "";
$clearResquest = "";

$svgCeta = "<svg class='bi bi-caret-right-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/></svg>";

if (!empty($code)) {

    if ($data = $google->getData($code)) {
        $name = "value='{$data->getName()}'";
        $email = "value='{$data->getEmail()}'";
    } else {
        $clearResquest =  "<script>window.history.replaceState('', '', window.location.pathname)</script>";
    }
}
$this->layout("_theme", ["title" => "EcoMais - Cadastro"]);

$this->start("css");
echo  Bundles::renderCss(["css/manipulation"]);
$this->stop();
?>

<div class="container">
    <div class="row">
        <div class=" col-xl-6 col-lg-6  col-md-10 col-sm-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h2 class="text-center h3">Cadastre sua empresa</h2>
                </div>
                <div class="card-body">
                    <p class="text-muted ">Faça postagens públicas de seus produtos em promoção!</p>

                    <div class="form-group col-md-12">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span> <b>Fantasia</b></label>
                        <input type="text" <?= $name ?> class="form-control" placeholder="Nome da empresa" data-required="">
                    </div>
                    <div class="form-group col-md-12">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span> <b>Razão social</b></label>
                        <input type="text" class="form-control" data-required="">
                    </div>
                    <div class="form-group col-md-12">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span> <b>CNPJ</b></label>
                        <input type="text" class="form-control" data-required="">
                    </div>
                    <div class="form-group col-md-12">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span> <b>E-mail</b></label>
                        <input type="text" <?= $email ?> <?= $email ? "readonly" : "" ?> class="form-control" data-required="">
                    </div>
                    <div class="form-group col-md-12">
                        <?= $svgCeta ?>
                        <label for="nome"><b>Telefone de contato</b></label>
                        <input type="text" class="form-control" placeholder="Fixo ou celular">
                    </div>
                    <div class="form-group col-md-12">
                        <svg class="bi bi-caret-right-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                        <label for="inputCep">Cep</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputCep" maxlength="8" />
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-info input-group-text" id="searchCep">Buscar</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span> <b>Cidade</b></label>
                        <input type="text" class="form-control" id="locality" data-required="">
                    </div>
                    <div class="form-group col-md-8">
                        <svg class="bi bi-caret-right-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                        <label for="nome"><b>Estado</b></label>
                        <select id='uf' name='uf' class="form-control custom-select nextItem" data-required="">
                            <option selected disabled>Escolha...</option>
                            <option value="" selected>Escolha...</option>
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
                    </div>
                    <div class="form-group col-md-12">
                        <?= $svgCeta ?>
                        <label for="nome"><b>Endereço</b></label>
                        <input type="text" class="form-control" id="addres" placeholder="Rua, bairro e número">
                    </div>
                    <div class="form-group col-md-8">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span> <b>Plano</b></label>
                        <select id="inputState" class="form-control custom-select">
                            <option selected disabled>Escolha...</option>
                            <option value="10">Sacolinha</option>
                            <option value="20">Cestinha</option>
                            <option value="30">Carrinho</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <svg class="bi bi-caret-right-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                        <label for="nome"><span class='required'>*</span> <b>Tipo de Pagamento</b></label>
                        <select id="tipo_pag" class="form-control custom-select">
                            <option selected disabled>Escolha...</option>
                            <option value="1">Boleto</option>
                            <option value="2">Cartão de Crédito</option>
                            <option value="3">Débito Automatico</option>
                        </select>
                    </div>

                    <input type="hidden" name="bandeiraCartao" id="bandeiraCartao">
                    <input type="hidden" name="valorParcelas" id="valorParcelas">
                    <input type="hidden" name="tokenCartao" id="tokenCartao">
                    <input type="hidden" name="hashCartao" id="hashCartao">
                    
                    <div class="form-group col-md-12">
                        <svg class="bi bi-caret-right-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                        <label for="nome"><b>Numero do Cartão</b></label>
                        <input type="text"  name="numCartao" class="form-control" id="numCartao">
                    </div>
                    <div class="form-group col-md-12">
                        <svg class="bi bi-caret-right-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                        <div class="col-md-6 mb-3 creditCard">
                            <label class="creditCard"><b>Mês de Validade</b></label>
                            <input type="text" name="mesValidade" id="mesValidade" maxlength="2" value="12"  class="form-control creditCard">
                        </div>
                        <div class="col-md-6 mb-3 creditCard">
                            <label class="creditCard"><b>Ano de Validade</b></label>
                            <input type="text" name="anoValidade" id="anoValidade" maxlength="4" value="2030" class="form-control creditCard">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <svg class="bi bi-caret-right-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                        <label class="creditCard"><b>CVV do cartão</b></label>
                            <input type="text" name="numCartao" class="form-control creditCard" id="cvvCartao" maxlength="3" value="123">
                            <small id="cvvCartao" class="form-text text-muted creditCard">
                                Código de 3 digitos impresso no verso do cartão
                            </small>
                    </div>

                    <div class="form-group col-md-12">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span> <b>Defina uma senha</b></label>
                        <input type="text" class="form-control">
                    </div>
                    <p>
                        <div class="form-check">
                            <?= $svgCeta ?>
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">Li e concordo com os <a href=<?= renderUrl("/politica-privacidade-e-termos") ?>>Termos de uso</a></label>
                        </div>
                    </p>
                    <div class="form-row">
                        <div class='col-xl-10 col-lg-10 col-md-12 col-sm-12 m-auto'>
                            <div class="btn-group btn-large btn-block">
                                <button class="btn-color-red text-white btn btn-focus-shadow-none">
                                    <i class='icon-google fab fa-google'></i>
                                </button>
                                <a title='Registrar com o Google' id="registerGoogle" href=<?= $authGoogleUrl ?> class='btn btn-large btn-block btn-color-red btn-focus-shadow-none text-center font-size-1-2em text-weight-700 text-white align-middle p-2'>
                                    Registrar com o Google
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 m-auto">
                            <button type="button" class="btn btn-block btn-primary nextItem font-size-1-2em text-weight-700" id="btnRegisterCompany">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-xl-6 col-lg-6 col-md-10 col-sm-12">
            <div class="dropdown">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="text-center h3">Aumete as vendas com o ECOMAIS</h2>
                    </div>
                    <div class="card-body ">
                        <fieldset>
                            <img src=<?= renderUrl("/src/assets/imgs/aumente_vendas.png") ?> alt="aumente_vendas" class="img-thumbnail mb-3">
                        </fieldset>
                        <div id="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4">Planos!</h1>
                                <p class="lead"> Escolha o pacote que mais se adequá ao seus objetivos.</p>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-xl-2 mt-lg-2 m-md-0">
                                    <div class="col-xl-5 col-lg-5 col-md-8 col-sm-12 float-left">
                                        <img src=<?= renderUrl("/src/assets/imgs/sacolinha.png") ?> alt="sacolinha de compras com um desenho de carrinho" class="float-left border rounded img-fluid img-thumbnail" />
                                    </div>
                                    <h3 class="font-weight-bold text-xl-left text-lg-left  text-md-center text-sm-center text-uppercase h6">Plano sacolinha! </h3>
                                    <p class="text-green-dark text-weight-600">R$10:99 mês</p>
                                    <p class="small">2 promoções por semana com 10 itens cadastrados em cada.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-xl-2 mt-lg-2 m-md-0">
                                    <div class="col-xl-5 col-lg-5 col-md-8 col-sm-12 float-left">
                                        <img src=<?= renderUrl("/src/assets/imgs/cestinha.png ") ?> class="float-left border rounded img-fluid img-thumbnail" alt="Cestinha de compras" />
                                    </div>
                                    <h3 class="font-weight-bold text-xl-left text-lg-left  text-md-center text-sm-center text-uppercase h6">Plano cestinha!</h3>
                                    <p class="text-green-dark text-weight-600">R$29:99 mês</p>
                                    <p class="small">3 promoções por semana com 20 itens cadastrados em cada.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-xl-2 mt-lg-2 m-md-0">
                                    <div class="col-xl-5 col-lg-5 col-md-8 col-sm-12 float-left">
                                        <img src=<?= renderUrl("/src/assets/imgs/carrinho.png") ?> alt="Carrinho de compras" class="float-left border rounded img-fluid img-thumbnail" />
                                    </div>
                                    <h3 class="font-weight-bold text-xl-left text-lg-left  text-md-center text-sm-center text-uppercase h6">Plano carrinho!</h3>
                                    <p class="text-green-dark text-weight-600">R$39:99 mês</p>
                                    <p class="small">5 promoçoes por semana com 30 itens cadastrados em cada.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</div>

<?php
$this->start("scripts");
echo  Bundles::renderJs([
    "js/apis",
    "js/mainMethods",
    "js/regAjax",
    "js/manipulation",
    "js/register",
]);
echo $clearResquest;
$this->stop();
?>