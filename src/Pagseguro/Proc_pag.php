<?php
namespace Ecomais\Pagseguro;

use Ecomais\ControllersServices\Company\CompanyHandling;
use Ecomais\Models\DataException;
use Ecomais\Models\Pagamento;
use Exception;

class Proc_pag {

    private Pagamento $pag;
    private CompanyHandling $emp;
    
    
    public function __construct()
    {
        $this->emp = new CompanyHandling();
        $this->pag = new Pagamento();
    }

    public function getDadosPag( array $DadosArray): object
    {
        $buildQuery = http_build_query($DadosArray);
        $url = "{$this->pag->pagInfo["URL_PAGSEGURO"]}transactions";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);
        $retorno = curl_exec($curl);
        curl_close($curl);
        return simplexml_load_string($retorno);
    }


    public function addPayment($data): void
    {
        $Dados = filter_var_array($data, FILTER_DEFAULT);

        $DadosArray["email"] = $this->pag->pagInfo["EMAIL_PAGSEGURO"];
        $DadosArray["token"] = $this->pag->pagInfo["TOKEN_PAGSEGURO"];

        if ($Dados['paymentMethod'] == "creditCard") {
            $DadosArray['creditCardToken'] = $Dados['tokenCartao'];
            $DadosArray['installmentQuantity'] = $Dados['qntParcelas'];
            $DadosArray['installmentValue'] = $Dados['valorParcelas'];
            $DadosArray['noInterestInstallmentQuantity'] = $Dados['noIntInstalQuantity'];
            $DadosArray['creditCardHolderName'] = $Dados['creditCardHolderName'];
            $DadosArray['creditCardHolderCPF'] = $Dados['creditCardHolderCPF'];
            $DadosArray['creditCardHolderBirthDate'] = $Dados['creditCardHolderBirthDate'];
            $DadosArray['creditCardHolderAreaCode'] = $Dados['senderAreaCode'];
            $DadosArray['creditCardHolderPhone'] = $Dados['senderPhone'];
            $DadosArray['billingAddressStreet'] = $Dados['billingAddressStreet'];
            $DadosArray['billingAddressNumber'] = $Dados['billingAddressNumber'];
            $DadosArray['billingAddressComplement'] = $Dados['billingAddressComplement'];
            $DadosArray['billingAddressDistrict'] = $Dados['billingAddressDistrict'];
            $DadosArray['billingAddressPostalCode'] = $Dados['billingAddressPostalCode'];
            $DadosArray['billingAddressCity'] = $Dados['billingAddressCity'];
            $DadosArray['billingAddressState'] = $Dados['billingAddressState'];
            $DadosArray['billingAddressCountry'] = $Dados['billingAddressCountry'];
        } elseif ($Dados['paymentMethod'] == "boleto") {
            
        } elseif ($Dados['paymentMethod'] == "eft") {
            $DadosArray['bankName'] = $Dados['bankName'];
        }

        $DadosArray['paymentMode'] = 'default';
        $DadosArray['paymentMethod'] = $Dados['paymentMethod'];


        $DadosArray['receiverEmail'] = $this->pag->pagInfo["EMAIL_LOJA"];
        $DadosArray['currency'] = $Dados['currency'];
        $DadosArray['extraAmount'] = $Dados['extraAmount'];


        $DadosArray['notificationURL'] = $this->pag->pagInfo["URL_NOTIFICACAO"];
        $DadosArray['reference'] = $Dados['reference'];
        $DadosArray['senderName'] = $Dados['senderName'];
        $DadosArray['senderCPF'] = $Dados['senderCPF'];
        $DadosArray['senderAreaCode'] = $Dados['senderAreaCode'];
        $DadosArray['senderPhone'] = $Dados['senderPhone'];
        $DadosArray['senderEmail'] = $Dados['senderEmail'];
        $DadosArray['senderHash'] = $Dados['hashCartao'];
        $DadosArray['shippingAddressRequired'] = $Dados['shippingAddressRequired'];
        $DadosArray['shippingAddressStreet'] = $Dados['shippingAddressStreet'];
        $DadosArray['shippingAddressNumber'] = $Dados['shippingAddressNumber'];
        $DadosArray['shippingAddressComplement'] = $Dados['shippingAddressComplement'];
        $DadosArray['shippingAddressDistrict'] = $Dados['shippingAddressDistrict'];
        $DadosArray['shippingAddressPostalCode'] = $Dados['shippingAddressPostalCode'];
        $DadosArray['shippingAddressCity'] = $Dados['shippingAddressCity'];
        $DadosArray['shippingAddressState'] = $Dados['shippingAddressState'];
        $DadosArray['shippingAddressCountry'] = $Dados['shippingAddressCountry'];
        $DadosArray['shippingType'] = $Dados['shippingType'];
        $DadosArray['shippingCost'] = $Dados['shippingCost'];

        
        try{
            $xml = $this->getDadosPag($DadosArray);
            $this->pag->type = $xml->paymentMethod->type;
            $this->pag->code_trans = $xml->code;
            $this->pag->status = $xml->status;

            if($xml->paymentMethod->type == 2) $this->pag->link_boleto = $xml->paymentLink;
            if($xml->paymentMethod->type == 3)$this->pag->link_bd_criacao = $xml->paymentLink;
            $this->pag->carrinho_id = $xml->reference;
            $this->pag->createAt();

            if($this->emp->createPayment($this->pag, $xml->paymentMethod->type))
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
            else
                echo json_encode(["error" => true, "status" => DataException::NOT_CONTENT, "msg" => "Não foi possível cadastrar o pagamento"]);
            
        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }
}