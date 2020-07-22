<?php

use Ecomais\Controllers\ComponenteElement;
use Ecomais\Web\Bundles;

$google  = new \Ecomais\Models\AuthGoogle("/cadastro/empresa");

$authGoogleUrl = $google->getAuthURL();

$code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED);
$err  = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED);

$name = "";
$email = "";
$clearRequest = "";

$svgCeta = "<svg class='bi bi-caret-right-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/></svg>";

if (!empty($code)) {

    if ($data = $google->getData($code)) {
        $name = "value='{$data->getName()}'";
        $email = "value='{$data->getEmail()}'";
    } else {
        $clearRequest =  "<script>window.history.replaceState('', '', window.location.pathname)</script>";
    }
}
$this->layout("_theme", ["title" => "EcoMais - Cadastro"]);

$this->start("css");
echo  Bundles::renderCss(["css/manipulation"]);
$this->stop();
?>

<div class="container">
    <div class="row">
        <div class=" col-xl-6 col-lg-6  col-md-10 m-xl-0 m-lg-0 m-md-auto col-sm-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h2 class="text-center h3">Cadastre sua empresa</h2>
                </div>
                <div class="card-body">
                    <p class="text-muted ">Faça postagens públicas de seus produtos em promoção!</p>

                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="fantasia"><span class='required'>*</span> <b>Fantasia</b></label>
                        <input type="text" <?= $name ?> <?= $name ? "readonly" : "" ?> id="fantasia" class="form-control next-item" placeholder="Nome da empresa" data-required="">
                    </div>
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="razao"><span class='required'>*</span> <b>Razão social</b></label>
                        <input type="text" class="form-control next-item" id="razao" data-required="">
                    </div>
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="cnpj"><span class='required'>*</span> <b>CNPJ</b></label>
                        <input type="text" class="form-control next-item" id="cnpj" data-required="">
                    </div>
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="email"><span class='required'>*</span> <b>E-mail</b></label>
                        <input type="text" <?= $email ?> <?= $email ? "readonly" : "" ?> id="email" class="form-control next-item" data-required="">
                    </div>
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="password"><span class='required'>*</span> <b>Crie uma senha:</b></label>
                        <div class="input-group">
                            <input type="password" class="form-control nextItem" autocomplete="current-password" id="passwd" maxlength="20" data-required="" />
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary" id="btnViewPasswd"><i id="iconPasswd" class="fas fa-eye-slash"></i></button>
                            </div>
                        </div>
                        <small class="form-text text-muted">
                            <div class="progress" style="width: 100%; height: 5px;">
                                <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </small>
                    </div>
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="contato"><span class='required'>*</span> <b>Telefone de contato</b></label>
                        <input type="text" id="contato"  class="form-control nextItem" placeholder="Fixo ou celular" data-required="">
                    </div>
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="inputCep"><b>Cep</b></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputCep" />
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-info input-group-text" id="searchCep">Buscar</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span><b>Estado</b></label>
                        <select id='uf' name='uf' class="form-control custom-select nextItem" data-required="">
                            <option value="" selected disabled>Escolha...</option>
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
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span> <b>Cidade</b></label>
                        <input type="text" class="form-control nextItem" id="locality" data-required="">
                    </div>
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="nome"><b>Endereço</b></label>
                        <input type="text" class="form-control nextItem" id="address" placeholder="Rua, bairro e número" data-required="">
                    </div>
                    <div class="form-group col-12">
                        <?= $svgCeta ?>
                        <label for="nome"><span class='required'>*</span> <b>Plano</b></label>
                        <select class="form-control custom-select nextItem" id="plano" data-required="">
                            <option value="" selected disabled>Escolha...</option>
                            <option value="10">Sacolinha</option>
                            <option value="20">Cestinha</option>
                            <option value="30">Carrinho</option>
                        </select>
                    </div>
                    
                    <p>
                        <div class="form-check">
                            <?= $svgCeta ?>
                            <input class="form-check-input nextItem" type="checkbox" id="termos">
                            <label class="form-check-label" for="termos">Li e concordo com os <a href=<?= renderUrl("/politica-privacidade-e-termos") ?>>Termos de uso</a></label>
                        </div>
                    </p>
                    <div class="form-row">
                        <div class='col-xl-10 col-lg-10 col-md-12 col-sm-12 m-auto'>
                            <div class="btn-group btn-large btn-block nextItem">
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
                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-block btn-primary font-size-1-2em text-weight-700 nextItem" id="btnRegisterCompany">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-xl-6 col-lg-6 col-md-10 m-xl-0 m-lg-0 m-md-auto col-sm-12">
            <div class="dropdown">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="text-center h3">Aumente suas vendas com o EcoMais</h2>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <span class="endereco" data-endereco="<?php echo BASE_URL; ?>"></span>
                    <form name="formPagamento" action="" id="formPagamento">
                        <input type="hidden" name="paymentMethod" id="paymentMethod" value="creditCard">

                        <input type="hidden" name="receiverEmail" id="receiverEmail" value="<?php echo EMAIL_LOJA; ?>">

                        <input type="hidden" name="currency" id="currency" value="<?php echo MOEDA_PAGAMENTO; ?>">

                        <input type="hidden" name="extraAmount" id="extraAmount" value="0.00">

                        <input type="hidden" name="itemId1" id="itemId1" value="0001">

                        <input type="hidden" name="itemDescription1" id="itemDescription1" value="plano carrinho">

                        <input type="hidden" name="itemAmount1" id="itemAmount1" value="39.99">

                        <input type="hidden" name="itemQuantity1" id="itemQuantity1" value="1">

                        <input type="hidden" name="notificationURL" id="notificationURL" value="<?php echo URL_NOTIFICACAO; ?>">

                        <input type="hidden" name="reference" id="reference" value="1001">
                        
                        <h2>Dados do Cartão</h2>
                        <label>Número do cartão</label><br>
                        <input type="text" name="numCartao" id="numCartao" required><br>
                        

                        <label>CVV do cartão</label><br>
                        <input type="text" name="cvvCartao" id="cvvCartao" maxlength="3" required><br>

                        <input type="hidden" name="bandeiraCartao" id="bandeiraCartao">

                        <label>Mês de Validade</label><br>
                        <input type="text" name="mesValidade" id="mesValidade" maxlength="2" required><br>

                        <label>Ano de Validade</label><br>
                        <input type="text" name="anoValidade" id="anoValidade" maxlength="4" required><br> 

                        <input type="hidden" name="qntParcelas" id="qntParcelas" class="select-qnt-parcelas"> 
                            
                        
                        <input type="hidden" name="valorParcelas" id="valorParcelas">

                        <label>CPF do dono do Cartão</label><br>
                        <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" placeholder="CPF sem traço" required> <br>

                        <label>Nome no Cartão</label><br>
                        <input type="text" name="creditCardHolderName" id="creditCardHolderName" placeholder="Nome igual ao escrito no cartão" required> 

                        <input type="hidden" name="tokenCartao" id="tokenCartao">
                        <input type="hidden" name="hashCartao" id="hashCartao">

                        <input type="hidden" value="Av. Brig. Faria Lima" name="billingAddressStreet" id="billingAddressStreet" placeholder="Av. Rua" required> 
                        <input type="hidden" value="1384" name="billingAddressNumber" id="billingAddressNumber" placeholder="Número" required> 
                        <input type="hidden" value="1 andar" name="billingAddressComplement" id="billingAddressComplement" placeholder="Complemento"> 
                        <input type="hidden" value="Jardim Paulistano" name="billingAddressDistrict" id="billingAddressDistrict" placeholder="Bairro"> 
                        <input type="hidden" value="01452002" name="billingAddressPostalCode" id="billingAddressPostalCode" placeholder="CEP sem traço" required> 
                        <input type="hidden" value="Sao Paulo" name="billingAddressCity" id="billingAddressCity" placeholder="Cidade" required> 
                        <input type="hidden" value="SP" name="billingAddressState" id="billingAddressState" placeholder="Sigla do Estado" required> 
                        <input type="hidden" value="BRA" name="billingAddressCountry" id="billingAddressCountry" value="BRL">

                        <input type="hidden" value="Jose Comprador" name="senderName" id="senderName" placeholder="Nome completo" required> 
                        <input type="hidden" value="27/10/1987" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" placeholder="Data de Nascimento. Ex: 12/12/1912" required> 
                        <input type="hidden" value="22111944785" name="senderCPF" id="senderCPF" placeholder="CPF sem traço" required> 
                        <input type="hidden" value="11" name="senderAreaCode" id="senderAreaCode" placeholder="DDD" required>
                        <input type="hidden" value="56273440" name="senderPhone" id="senderPhone" placeholder="Somente número" required> 
                        <input type="hidden" value="comprador@sandbox.pagseguro.com.br" name="senderEmail" id="senderEmail" placeholder="E-mail do comprador" required> 
                        <input type="hidden" name="shippingAddressRequired" id="shippingAddressRequired" value="true">
                        <input type="hidden" value="Av. Brig. Faria Lima" name="shippingAddressStreet" id="shippingAddressStreet" placeholder="Av. Rua"> 
                        <input type="hidden" value="1384" name="shippingAddressNumber" id="shippingAddressNumber" placeholder="Número"> 
                        <input type="hidden" value="5o anda" name="shippingAddressComplement" id="shippingAddressComplement" placeholder="Complemento"> 
                        <input type="hidden" value="Jardim Paulistano" name="shippingAddressDistrict" id="shippingAddressDistrict" placeholder="Bairro"> 
                        <input type="hidden" value="01452002" name="shippingAddressPostalCode" id="shippingAddressPostalCode" placeholder="CEP sem traço"> 
                        <input type="hidden" value="Sao Paulo" name="shippingAddressCity" id="shippingAddressCity" placeholder="Cidade"> 
                        <input type="hidden" value="SP" name="shippingAddressState" id="shippingAddressState" placeholder="Sigla do Estado"> 
                        <input type="hidden" value="BRA" name="shippingAddressCountry" id="shippingAddressCountry" value="BRL">
                        
                        <input type="hidden" name="shippingType" value="3">
                        <input type="hidden" value="1.00" name="shippingCost" id="shippingCost" placeholder="Preço do frete. Ex: 2.10">      
                        
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="btnComprar" id="btnComprar" value="Comprar">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$this->start("footer");
echo ComponenteElement::footerHome();
$this->stop();

$this->start("scripts");
echo  Bundles::renderJs([
    "js/mainMethods",
    "js/manipulation",
    "js/registerCompany",
]);
echo $clearRequest;
$this->stop();
?>