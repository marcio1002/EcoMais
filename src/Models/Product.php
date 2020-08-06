<?php
namespace Ecomais\Models;

use Ecomais\Models\DataException;

class Product
{

    const ACTIVATED = true;
    const DISABLED = false;

    protected int $id;
    protected string $name;
    protected float $price;
    protected string $brand;
    protected string $classification;
    protected string $description;
    protected int $quantity;
    protected string $period_start;
    protected string $period_end;
    protected int $fkCompany;
    protected bool $status;
    protected string $date;

    public function __set($name, $value)
    {
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
    public function toArray(): array
    {
        $array = array();
        foreach($this as $key => $val) $array[$key] = $val;
        return $array;
    }

    
    public function createAt(): string
    {
        date_default_timezone_set("America/Sao_paulo");

        $this->date = date('Y-m-d H:i:s');
        return $this->date;
    }
}
