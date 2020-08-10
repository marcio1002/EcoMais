<?php

namespace Ecomais\Controllers\Product;

use Ecomais\Models\{DataException, Product};
use Ecomais\ControllersServices\Product\ProductHandling;

class ProductManager
{

    private Product $prod;
    private productHandling $sql;

    public function __construct()
    {
        $this->prod = new Product();
        $this->sql = new ProductHandling();
    }

    public function createProduct(array $param): void
    {
        try {
            $this->prod->name = filter_var($param['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->price = filter_var(str_replace(",", ".", $param['price']), FILTER_VALIDATE_FLOAT, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->brand = filter_var($param['brand'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->classification = filter_var($param['classification'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->description = filter_var($param['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->quantity = filter_var($param['quantity'], FILTER_VALIDATE_INT, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->period_start = date("Y-m-d H:i:s", strtotime($param['date_start'].$param['time_start']));
            $this->prod->period_end = date("Y-m-d H:i:s", strtotime($param['date_end'].$param['time_end']));
            $this->prod->fkCompany = filter_var($param['fkCompany'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->prod->status = Product::ACTIVATED;
            $this->prod->createAt();


            if($this->sql->createProduct($this->prod))
                echo json_encode(["error" => false, "status" => 204, "msg" => "ok"]);
            else 
                echo json_encode(["error" => true, "status" => 404, "msg" => "0 rows affected"]);
            

        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    /**
     * Ativar e desativar os produtos
     */
    public function setStatus(array $param): void
    {
        try{
            foreach($param as $k => $v) $this->prod->$k = $v;

            if($this->sql->updateStatusProduc($this->prod))
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "ok"]); 
            else
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "0 rows affected"]);
        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    public function searchProd(array $param): void
    {
        try{
            foreach($param as $k => $v) $this->prod->$k = $v;

            if($row =  $this->sql->searchProd($this->prod))
                echo json_encode(["error" => false, DataException::NOT_CONTENT, "data" => is_array($row)? $row : [$row]]); 
            else
                echo json_encode(["error" => true, DataException::NOT_FOUND, "data" => []]);
        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }
}
