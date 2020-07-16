<?php
namespace Ecomais\ControllersServices;

use Ecomais\Models\{Safety,DataException, PersonLegal};
use Ecomais\Services\Data;

class CompanyHandling {
    private Data $sql;
    private Safety $safety;

    public function __construct() {
        $this->sql = new Data();
        $this->safety = new Safety();
    }

    public function createAccountPersonPhysical(PersonLegal $personLegal): bool
    {
        try {
            $passwd =  $this->safety->criptPasswd($personLegal->passwd);
            $columns = "fantasia,razao,cnpj,pacote,email,senha,cep,uf,cidade,endereco,statusconta,data_criacao";
            $data = array(
                $personLegal->fantasia,
                $personLegal->razao,
                $personLegal->cnpj,
                $personLegal->typePackage,
                $personLegal->email,
                $passwd,
                $personLegal->cep,
                $personLegal->uf,
                $personLegal->locality,
                $personLegal->addres,
                $personLegal->statusAccount,
                $personLegal->createAt()
            );

            $this->sql->open();

            return $this->sql
                ->add("usuario",$columns,count($data))
                ->prepareParam($data)
                ->execNotRowSql();

        } catch(DataException $ex)  {   
            throw new DataException( $ex->getMessage(),$ex->getCode() );
            
        } finally {
            $this->sql->close();
        }
            
    }
}