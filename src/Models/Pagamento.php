<?php
namespace Ecomais\Models;

use Ecomais\Models\DataException;

class Pagamento extends PersonLegal 
{
    protected int $id;
    protected int $type; 
    protected string $code_trans;
    protected int $status;
    protected ?string $link_boleto;
    protected ?string $link_bd_online;
    protected int $carrinho_id;
    protected string $data_criacao;
    protected string $data_update;
    //dados padrão
    protected $pagInfo = array(
        "URL_PAGSEGURO" => "https://ws.sandbox.pagseguro.uol.com.br/v2/",
        "SCRIPT_PAGSEGURO" => "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js",
        "MOEDA_PAGAMENTO" => "BRL",
        "URL_NOTIFICACAO" => "https://sualoja.com.br/notifica.html"
    );

    public function __construct(bool $sandbox = true,array $dataPagArray = null)
    {
        if ($sandbox) {
            $this->pagInfo["EMAIL_PAGSEGURO"] =  "emanuelcafe.santos@gmail.com";
            $this->pagInfo["TOKEN_PAGSEGURO"] =  "D146D1FA2079439EB485AEF5B23EA68C";
            $this->pagInfo["EMAIL_LOJA"] = "emanuelcafe175@gmail.com";
        } else {
            $this->pagInfo["EMAIL_PAGSEGURO"] =  $dataPagArray[0];
            $this->pagInfo["TOKEN_PAGSEGURO"] =  $dataPagArray[1];
            $this->pagInfo["EMAIL_LOJA"] = $dataPagArray[3];
        }

    }

    public function __set($name, $value)
    {
        if (empty($name) || empty($value)) throw new DataException('Null values', DataException::REQ_INVALID);
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * Pega todos os valores nos atributos da classe
     * @return array
     */
    public function getAll(): array
    {
        $array = array();
        foreach($this as $key => $val) {
            $array += array($key => $val);
        }
        return $array;
    }

    public function createAt(): string
    {
        date_default_timezone_set("America/Sao_paulo");

        $this->data_criacao = date('Y-m-d H:i:s');
        return $this->data_criacao;
    }
}