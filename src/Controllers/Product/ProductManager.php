<?php
namespace Ecomais\Controllers\Product;

use Ecomais\Models\{DataException, Product, Safety};

class ProductManager
{

    private Product $prod;
    private Safety $safety;

    public function __construct()
    {
        $this->prod = new Product();
        $this->safety = new Safety();
    }

    public function createProduct($param):void 
    {
        try{

            $this->prod->name = filter_var($param['name'],FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->name = filter_var($param['price'],FILTER_VALIDATE_INT,FILTER_FLAG_EMPTY_STRING_NULL);
            

        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    /**
     * Ativar e desativar os produtos
    */
    public function activeImage()
    {
    }
}
