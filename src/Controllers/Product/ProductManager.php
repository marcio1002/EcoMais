<?php

namespace Ecomais\Controllers\Product;

use Ecomais\Models\{DataException, Product, Safety};
use Ecomais\ControllersServices\Product\productHandling;

class ProductManager
{

    private Product $prod;
    private Safety $safety;
    private productHandling $sql;

    public function __construct()
    {
        $this->prod = new Product();
        $this->safety = new Safety();
        $this->sql = new productHandling();
    }

    public function createProduct(array $param)
    {
        try {
            $this->prod->name = filter_var($param['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->price = filter_var(str_replace(",", ".", $param['price']), FILTER_VALIDATE_FLOAT, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->brand = filter_var($param['brand'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->classification = filter_var($param['classification'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->description = filter_var($param['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->quantity = filter_var($param['quantity'], FILTER_VALIDATE_INT, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->period_start = date("Y-m-d H:i:s", strtotime($param['date_start']));
            $this->prod->period_end = date("Y-m-d H:i:s", strtotime($param['date_end']));
            $this->prod->fkCompany = filter_var($param['fkCompany'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->status = Product::ACTIVATED;
            $this->prod->createAt();


            if($this->sql->createProduct($this->prod)) {
                echo "tudo certo :)";
            }else {
                echo "<script>alert('deu errado')</script>";
            }

        } catch (DataException $ex) {
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
