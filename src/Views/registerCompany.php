<?php
require_once __DIR__ . "/../../vendor/autoload.php";

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
    <div class="row py-5">
        <div class=" col-xl-6 col-lg-6 col-md-10 m-xl-0 m-lg-0 m-md-auto col-sm-12">
            <div class="dropdown">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="text-center h3">Aumente suas vendas com o EcoMais</h2>
                    </div>
                    <div class="card-body ">
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
        <div class=" col-xl-6 col-lg-6  col-md-10 m-xl-0 m-lg-0 m-md-auto col-sm-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h2 class="text-center h3">Cadastre sua empresa</h2>
                </div>
                <div class="card-body">
                    <p class="text-muted ">Faça postagens públicas de seus produtos em promoção!</p>

                    <form id="formCompany" enctype="multipart/form-data">
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="fantasia"><span class='required'>*</span> <b>Fantasia</b></label>
                            <input type="text" id="fantasia" name="fantasy" <?= $name ?> <?= $name ? "readonly" : "" ?> class="form-control nextItem" placeholder="Nome da empresa" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="razao"><span class='required'>*</span> <b>Razão social</b></label>
                            <input type="text" id="razao" name="reason"  class="form-control nextItem" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="cnpj"><span class='required'>*</span> <b>CNPJ</b></label>
                            <input type="text" id="cnpj" name="cnpj" class="form-control nextItem" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="email"><span class='required'>*</span> <b>E-mail</b></label>
                            <input type="text" id="email" name="email" <?= $email ?> <?= $email ? "readonly" : "" ?> class="form-control nextItem" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="password"><span class='required'>*</span> <b>Crie uma senha:</b></label>
                            <div class="input-group">
                                <input type="password" id="passwd" name="passwd" class="form-control nextItem" autocomplete="current-password" maxlength="20" data-required="" />
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
                            <input type="text" id="contato" name="contact" class="form-control nextItem" placeholder="Fixo ou celular" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="inputCep"><b>Cep</b></label>
                            <div class="input-group">
                                <input type="text" id="inputCep" name="cep" class="form-control" />
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
                            <input type="text" id="locality" name="locality" class="form-control nextItem" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="nome"><b>Endereço</b></label>
                            <input type="text" name="address" class="form-control nextItem" placeholder="Rua, bairro e número" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="nome"><span class='required'>*</span> <b>Plano</b></label>
                            <select id="plano" name="plano" class="form-control custom-select nextItem" data-required="">
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
                                    <button class="btn-color-red text-white btn remove-focus">
                                        <i class='icon-google fab fa-google'></i>
                                    </button>
                                    <a title='Registrar com o Google' id="registerGoogle" href=<?= $authGoogleUrl ?> class='btn btn-large btn-block btn-color-red remove-focus text-center font-size-1-2em text-weight-700 text-white align-middle p-2'>
                                        Registrar com o Google
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 m-auto">
                                <button type="button" id="btnRegisterCompany" class="btn btn-block btn-primary font-size-1-2em remove-focus text-weight-700 nextItem">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade bg-dark-transparent" id="modalPagamento" tabindex="-1" role="Pagamento" aria-labelledby="Pagamento" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" title="Precione ESC para voltar" style="cursor: help;">
                    <h5 class="modal-title m-auto">Dados do Cartão</h5>
                </div>
                <div class="modal-body">
                    <form id="formPagamento" enctype="multipart/form-data">
                        <label>Número do cartão</label><br>
                        <input type="text" name="numCartao" id="numCartao" data-required=""><br>


                        <label>CVV do cartão</label><br>
                        <input type="text" name="cvvCartao" id="cvvCartao" maxlength="3" data-required=""><br>

                        <input type="hidden" name="bandeiraCartao" id="bandeiraCartao">

                        <label>Mês de Validade</label><br>
                        <input type="text" name="mesValidade" id="mesValidade" maxlength="2" data-required=""><br>

                        <label>Ano de Validade</label><br>
                        <input type="text" name="anoValidade" id="anoValidade" maxlength="4" data-required=""><br>

                        <input type="hidden" name="qntParcelas" id="qntParcelas" class="select-qnt-parcelas">


                        <input type="hidden" name="valorParcelas" id="valorParcelas">

                        <label>CPF do dono do Cartão</label><br>
                        <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" placeholder="CPF sem traço" data-required=""> <br>

                        <label>Nome no Cartão</label><br>
                        <input type="text" name="creditCardHolderName" id="creditCardHolderName" placeholder="Nome igual ao escrito no cartão" data-required="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="btnComprar" id="btnComprar" value="Comprar">Finalizar cadastro</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$this->start("footer");
echo ComponenteElement::footer();
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