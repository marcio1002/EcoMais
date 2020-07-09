<?php
namespace Ecomais\Models;

use Ecomais\Models\{Person, DataException};

use TypeError;

class PersonLegal extends person 
{
    private int $id;
    private int $cnpj;
    private string $fantasy; 
    private string $reason;
    private string $contact;
    private int $typePackage;
    private int $fk_empresa;
    private string $email;
    private string $uf;
    private string $locality;
    private ?string $addres;
    private int $number;
    private ?int $cep;
    private bool $statusAccount;

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
