<?php
namespace Ecomais\ControllersServices\Company;

use Ecomais\Models\{Implementation,DataException, Pagamento, PersonLegal};
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
            ->show(
                "empresa AS e LEFT JOIN pagamento AS p ON p.fk_empresa = e.id_empresa",
                "e.*, p.*",
                "statusconta = true AND id_empresa = ?",
                6)
            ->prepareParam($emp->toArray())
            ->executeSql();

        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }

    public function userCompanyInfo(PersonLegal $emp): ?array
    {
        try{
            $this->sql->open();
            return $this->sql
                ->show("empresa","","statusconta = true AND id_empresa = ?",3)
                ->prepareParam([$emp->id],[PDO::PARAM_INT])
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
}