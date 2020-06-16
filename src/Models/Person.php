<?php
namespace Ecomais\Models;

use Ecomais\Models\DataException;
use TypeError;

class Person
{
    const ENABLED = true; 
    const DISABLED = false;

    protected int $id;
    protected string $name;
    protected string $email;
    protected string $passwd;
    protected string $uf;
    protected string $locality;
    protected ?string $addres;
    protected int $number;
    protected string $date;
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

    public function createAt(): string
    {
        date_default_timezone_set("America/Sao_paulo");

        $this->date = date('Y-m-d H:i:s');
        return $this->date;
    }
}
