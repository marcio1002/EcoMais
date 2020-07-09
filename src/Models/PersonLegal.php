<?php
namespace Ecomais\Models;

use Ecomais\Models\{Person, DataException};

use TypeError;

class PersonLegal extends person 
{
    private int $cnpj;
    private string $fantasy; 
    private string $reason;
    private string $contact;
    private int $typePackage;
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
