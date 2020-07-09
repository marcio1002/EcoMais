<?php

namespace Ecomais\ControllersServices\Product;

use PDO;
use Ecomais\Models\{Safety,DataException, Product};
use Ecomais\Services\Data;

class ProductHandling {

    private Data $sql;
    private Safety $safety;

    public function __construct() {
        $this->sql = new Data();
        $this->safety = new Safety();
    }


    public function createProduct(Product $prod): bool 
    {
        try{

            $this->sql->open();
            $columns = "nome,preco,marca,classificacao,descricao,quantidade,periodo_inicio,periodo_fim,id_empresa,statusdoproduto,data_criacao";
            return $this->sql
                ->add("produto", $columns,count($prod->getAll()))
                ->prepareParam($prod->getAll())
                ->execNotRowSql();

        }catch(DataException $ex){
            throw $ex;
        }finally {
            $this->sql->close();
        }
    }
}