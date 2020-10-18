<?php
namespace Ecomais\ControllersServices\Company;

use Ecomais\Models\{Implementation,DataException, PersonLegal};
use Ecomais\Services\Data;
use PDO;

class CompanyHandling {
    private Data $sql;
    private Implementation $implement;

    public function __construct() 
    {
        $this->sql = new Data();
        $this->implement = new Implementation();
    }

    public function createAccountPersonLegal(PersonLegal $emp): bool
    {
        try {
            $emp->passwd =  $this->implement->criptPasswd($emp->passwd);
            $columns = "cnpj,fantasia,razao,contato,pacote,email,senha,uf,cidade,endereco,cep,statusconta,data_criacao";

            $this->sql->open();

            return $this->sql
                ->add("empresa",$columns,count($emp->toArray()))
                ->prepareParam($emp->toArray())
                ->execNotRowSql();

        } catch(DataException $ex)  {   
            throw new DataException( $ex->getMessage(),$ex->getCode() );
            
        } finally {
            $this->sql->close();
        }
            
    }

    public function findAll(): ?array
    {
        try{
            $this->sql->open();
            return $this->sql
            ->show("empresa","","statusconta = ?",3)
            ->prepareParam([PersonLegal::ENABLED])
            ->executeSql();

        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }

     public function findById(PersonLegal $emp): ?array
    {
        try{
            $this->sql->open();
            return $this->sql
                ->show("empresa","","statusconta = ? AND id_empresa = ?",3)
                ->prepareParam([PersonLegal::ENABLED,$emp->id],[PDO::PARAM_BOOL, PDO::PARAM_INT])
                ->executeSql();

        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }

    public function listenCompanyPro(): ?array
    {
        try{
            $this->sql->open();
            return $this->sql
            ->show("empresa","id_empresa,fantasia,imagem","statusconta = ? AND pacote = ?",6)
            ->prepareParam([PersonLegal::ENABLED,"30"],[PDO::PARAM_BOOL,PDO::PARAM_STR])
            ->executeSql();

        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }
    
    public function listenInfoCompany(PersonLegal $emp): ?array
    {
        try{
            $this->sql->open();
            return $this->sql
            ->show(
                "empresa AS e LEFT JOIN pagamento AS p ON p.fk_empresa = e.id_empresa",
                "e.*, p.*",
                "statusconta = true AND id_empresa = ?",
                6)
            ->prepareParam([PersonLegal::ENABLED,$emp->id],[PDO::PARAM_BOOL, PDO::PARAM_INT])
            ->executeSql();

        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }

    public function updateInfoCompany(PersonLegal $emp) :bool
    {
        try{
            $columns = "pacote = ?";
            $data = [$emp->typePackage];
            if(!empty($emp->passwd)) {
                $columns .= ", senha = ?";
                array_push($data,$this->implement->criptPasswd($emp->passwd));
            }
                array_push($data,$emp->id);
            
            $this->sql->open();
            return $this->sql
                ->update("empresa",$columns,"id_empresa = ?")
                ->prepareParam($data)
                ->execNotRowSql();

        }catch(DataException $ex) {
            throw $ex;
        }finally {
            $this->sql->close();
        }
    }

    public function updateImageCompany(PersonLegal $emp): bool
    {
        try{
           
            $this->sql->open();
            return $this->sql
                ->update("empresa","imagem = ?","id_empresa = ?")
                ->prepareParam([$emp->image, $emp->id])
                ->execNotRowSql();

        }catch(DataException $ex) {
            throw $ex;
        }finally {
            $this->sql->close();
        }
    }

    public function searchCompany(PersonLegal $emp): ?array
    {
        try{
            $where = "null";
            $data = [];
           if(!empty($emp->uf) && !empty($emp->locality)) {
               $where = str_replace("null","",$where);
                $where =  "(uf = ? OR  cidade = ?) AND statusconta = ?";
                array_push($data,$emp->uf, $emp->locality, PersonLegal::ENABLED);
            }
            if(!empty($emp->fantasy)) {
                $where = str_replace("null","",$where);
                $where = "fantasia = ? AND statusconta = ?";
                array_push($data,$emp->fantasy, PersonLegal::ENABLED );
            } 
            $this->sql->open();
            return $this->sql
            ->show("empresa","id_empresa,fantasia,imagem",$where,6)
            ->prepareParam($data)
            ->executeSql();

        }catch(DataException $ex) {
            throw $ex;
        }finally {
            $this->sql->close();
        }
    }
}