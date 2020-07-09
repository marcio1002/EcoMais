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
        if (empty($name) || empty($value)) throw new DataException('Null values', DataException::REQ_INVALID);
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

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

        $this->date = date('Y-m-d H:i:s');
        return $this->date;
    }
}
