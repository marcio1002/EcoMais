<?php
namespace Ecomais\ControllersServices\Company;

use Ecomais\Models\{Safety,DataException, PersonLegal};
use Ecomais\Services\Data;
use PDO;

class CompanyHandling {
    private Data $sql;
    private Safety $safety;

    public function __construct() {
        $this->sql = new Data();
        $this->safety = new Safety();
    }

    public function listenCompanyPro(): ?array
    {
        try{
            $this->sql->open();
            return $this->sql
            ->show("empresa","id_empresa,fantasia,imagem","statusconta = ? AND pacote = ?",6)
            ->prepareParam([true,"30"],[PDO::PARAM_BOOL,PDO::PARAM_STR])
            ->executeSql();

        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }

    public function listenCompany(): ?array
    {
        try{
            $this->sql->open();
            return $this->sql
            ->show("empresa","","statusconta = true",3)
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
            ->show("empresa","","statusconta = true AND id_empresa = ?",3)
            ->prepareParam($emp->getAll())
            ->executeSql();

        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }

    public function createAccountPersonLegal(PersonLegal $emp): bool
    {
        try {
            $emp->passwd =  $this->safety->criptPasswd($emp->passwd);
            $columns = "cnpj,fantasia,razao,contato,pacote,email,senha,uf,cidade,endereco,cep,statusconta,data_criacao";
            $data = $emp->getAll();

            $this->sql->open();

            return $this->sql
                ->add("empresa",$columns,count($data))
                ->prepareParam($data)
                ->execNotRowSql();

        } catch(DataException $ex)  {   
            throw new DataException( $ex->getMessage(),$ex->getCode() );
            
        } finally {
            $this->sql->close();
        }
            
    }

    public function updateCompany(PersonLegal $emp) :bool
    {
        try{
            $this->sql->open();
        }catch(DataException $ex) {
            throw $ex;
        }finally {
            $this->sql->close();
        }
    }
}