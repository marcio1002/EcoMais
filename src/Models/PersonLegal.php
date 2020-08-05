<?php
namespace Ecomais\Models;

use Ecomais\Models\{Person, DataException};

use TypeError;

class PersonLegal extends person 
{
    protected int $cnpj;
    protected string $fantasy; 
    protected string $reason;
    protected int $contact;
    protected int $typePackage;
    protected string $image;
}
