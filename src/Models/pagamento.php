<?php
namespace Ecomais\Models;

use Ecomais\Models\{Pagamento, DataException};

use TypeError;

class PersonLegal extends person 
{
    private int $id;
    private int $tipo; 
    private string $code_trans;
    private int $status;
    private string $link_boleto;
    private string $link_bd_online;
    private string $data_criacao;
    private string $data_update;
    private int $fk_empresa;

    public function __set($name, $value)
    {
        if (empty($name) || empty($value)) throw new DataException('Null values', DataException::REQ_INVALID);
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}