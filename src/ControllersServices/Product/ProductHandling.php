<?php

namespace Ecomais\ControllersServices\Product;

use PDO;
use Ecomais\Models\{Implementation,DataException, Product};
use Ecomais\Services\Data;

class ProductHandling {

    private Data $sql;
    private Implementation $implement;

    public function __construct() 
    {
        $this->sql = new Data();
        $this->implement = new Implementation();
    }


    public function createProduct(Product $prod): bool 
    {
        try{

            $this->sql->open();
            $columns = "nome,preco,marca,classificacao,descricao,quantidade,periodo_inicio,periodo_fim,id_empresa,statusdoproduto,data_criacao";
            return $this->sql
                ->add("produto", $columns,count($prod->toArray()))
                ->prepareParam($prod->toArray())
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
            $data = [];
            $data_type = [];
            $where = "null";

            if(!empty($prod->fkCompany)) {
                $where = str_replace("null","",$where);
                $where .= "e.id_empresa = ?";
                array_push($data,$prod->fkCompany);
                array_push($data_type,PDO::PARAM_INT);
            }
            if(!empty($prod->name)) {
                $where = str_replace("null","",$where);
                $where .= "p.nome = ?";
                array_push($data,$prod->name);
                array_push($data_type,PDO::PARAM_STR);
            }
            if(!empty($prod->classification)) {
                $where = str_replace("null","",$where);
                $where .= "p.classificacao = ?";
                array_push($data,$prod->classification);
                array_push($data_type,PDO::PARAM_STR);
            }

            $this->sql->open();
           return $this->sql
            ->show(
                "produto AS p INNER JOIN empresa AS e ON p.id_empresa = e.id_empresa",
                "p.*, e.id_empresa,e.fantasia, e.cnpj,e.email,e.contato,e.cidade, e.endereco,e.uf,e.imagem",
                $where,
                6
            )
            ->prepareParam($data, $data_type)
            ->executeSql();
        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }
}