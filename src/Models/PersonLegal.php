<?php
namespace Ecomais\Models;

use Ecomais\Models\Person;

class PersonLegal extends person 
{
    protected int $cnpj;
    protected string $fantasy; 
    protected string $reason;
    protected int $contact;
    protected int $typePackage;
    protected string $image;
}
