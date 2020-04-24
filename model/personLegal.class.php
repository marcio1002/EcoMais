<?php

namespace Model;

use Interfaces\PersonLegalInterface;
use Model\{Person,DataException};

use TypeError;

class PersonLegal extends person implements PersonLegalInterface
{

    protected $cnpj;

    public function getCnpj(): int
    {
        return $this->cnpj;
    }

    public function setCnpj(int $cnpj): void
    {
        if (empty($cnpj)) throw new DataException('Undefined value');
        if (!is_numeric($cnpj)) throw new TypeError("Expected a number format", 1);
        $this->cnpj = trim($cnpj);
    }
}