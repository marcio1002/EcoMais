<?php
namespace Ecomais\Models;

use Ecomais\Interfaces\PersonLegalInterface;
use Ecomais\Models\{Person, DataException};

use TypeError;

class PersonLegal extends person implements PersonLegalInterface
{

    private $cnpj;
    private $typePackage;

    public function getCnpj(): int
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): void
    {
        if (empty($cnpj)) throw new DataException('Undefined value');
        $cnpj = preg_replace("/[.\/-]/","",$cnpj);
        if (!is_numeric($cnpj)) throw new TypeError("Expected a number format", 1);
        $this->cnpj = trim($cnpj);
    }

    public function getTypePackage(): int
    {
        return $this->typePackage;
    }

    public function setTypePackage(int $typePackage): void
    {
        $this->typePackage = $typePackage;
    }
}
