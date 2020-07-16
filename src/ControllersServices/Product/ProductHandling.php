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
    

    public function updateStatusProduc(Product $prod): bool
    {
        try{

            $this->sql->open();
         
            return $this->sql
                ->update("produto", "statusdoproduto = ?","id_produto = ? AND id_empresa = ?")
                ->prepareParam(array(
                    $prod->status,
                    $prod->id,
                    $prod->fkCompany
                ),array(
                    PDO::PARAM_BOOL,//foi usado o PDO PARAMS porque não tratei os valores
                    PDO::PARAM_INT,
                    PDO::PARAM_INT
                ))
                ->execNotRowSql();

        }catch(DataException $ex){
            throw $ex;
        }finally {
            $this->sql->close();
        }
    }


    public function searchProd(Product $prod): ?array
    {
        try{

            $this->sql->open();
           return $this->sql
            ->show(
                "produto AS p INNER JOIN empresa AS e ON p.id_empresa = e.id_empresa",
                "p.*, e.id_empresa,e.fantasia, e.cnpj,e.email,e.contato,e.cidade, e.endereco,e.uf",
                "e.id_empresa = ?",
                6
            )
            ->prepareParam(
                [$prod->fkCompany],
                [PDO::PARAM_INT])
            ->executeSql();
        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }
}