<?php
$this->layout("_theme", ["title" => "EcoMais - Cadastro"]);

use Ecomais\Views\Component\ComponenteElement as component;
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
                            <input type="text" id="fantasia" name="fantasy" <?= $name ?> <?= $name ? "readonly" : "" ?> class="form-control inset-shadow nextItem" placeholder="Nome da empresa" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="razao"><span class='required'>*</span> <b>Razão social</b></label>
                            <input type="text" id="razao" name="reason"  class="form-control inset-shadow nextItem" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="cnpj"><span class='required'>*</span> <b>CNPJ</b></label>
                            <input type="text" id="cnpj" name="cnpj" class="form-control inset-shadow nextItem" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="email"><span class='required'>*</span> <b>E-mail</b></label>
                            <input type="text" id="email" name="email" <?= $email ?> <?= $email ? "readonly" : "" ?> class="form-control inset-shadow nextItem" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="password"><span class='required'>*</span> <b>Crie uma senha:</b></label>
                            <div class="input-group">
                                <input type="password" id="passwd" name="passwd" class="form-control inset-shadow nextItem" autocomplete="current-password" maxlength="20" data-required="" />
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
                            <input type="text" id="contato" name="contact" class="form-control inset-shadow nextItem" placeholder="Fixo ou celular" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="inputCep"><b>Cep</b></label>
                            <div class="input-group">
                                <input type="text" id="inputCep" name="cep" class="form-control inset-shadow" />
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-info input-group-text" id="searchCep">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="nome"><span class='required'>*</span><b>Estado</b></label>
                            <select id='uf' name='uf' class="form-control inset-shadow custom-select nextItem" data-required="">
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
                            <input type="text" id="locality" name="locality" class="form-control inset-shadow nextItem" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="nome"><b>Endereço</b></label>
                            <input type="text" id="address" name="address" class="form-control inset-shadow nextItem" placeholder="Rua, bairro e número" data-required="">
                        </div>
                        <div class="form-group col-12">
                            <?= $svgCeta ?>
                            <label for="nome"><span class='required'>*</span> <b>Plano</b></label>
                            <select id="plano" name="plano" class="form-control inset-shadow custom-select nextItem" data-required="">
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
                        <div class="form-row mt-3">
                            <div class='col-xl-9 col-md-9 col-sm-12 m-auto'>
                                <?= component::buttonGoogle("registerGoogle","Registrar com o Google",$authGoogleUrl)?>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-xl-9 col-md-9 col-sm-12 m-auto">
                                <button type="button" id="btnRegisterCompany" class="btn btn-block btn-primary font-size-1-1em remove-focus text-weight-700 nextItem">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
    $this->start("footer");
        echo component::footer();
    $this->stop();

    $this->start("scripts");
        echo  Bundles::render([ "mainMethods.js", "registerCompany.js"], 
        fn($file) => print_r("<script src=\"$file\"></script>"));
        echo $clearRequest;
    $this->stop();
?>