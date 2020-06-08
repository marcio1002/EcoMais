<?php
namespace Ecomais\Controllers;

use Ecomais\Models\{DataException, Product};

class ProductManager
{

    private Product $prod;
    /**
     * CONSTRUSTOR
     * @return void
     */
    public function __construct()
    {
        $this->prod = new Product();
    }

    /**
     * Ativar e desativar os produtos
     */
    public function activeImage()
    {
    }
}
