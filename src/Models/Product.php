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
    protected string $manufacturer;
    protected string $merchant;
    protected string $clt;
    protected string $date;
    protected string $desc;
    protected string $period;
    protected int $quant;
    protected int $fkCompany;
    protected bool $status;

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
