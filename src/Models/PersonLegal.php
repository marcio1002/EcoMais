<?php
namespace Ecomais\Models;

use Ecomais\Models\{Person, DataException};

use TypeError;

class PersonLegal extends person 
{
    protected int $id;
    protected int $cnpj;
    protected string $fantasy; 
    protected string $reason;
    protected string $contact;
    protected int $typePackage;
    protected string $email;
    protected string $uf;
    protected string $locality;
    protected ?string $addres;
    protected int $number;
    protected ?int $cep;
    protected bool $statusAccount;

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
