<?php
namespace Ecomais\ControllersServices\Company;

use Ecomais\Models\DataException;
use Ecomais\Services\Data;
use PDO;

class CompanyHandling {
    //--- Api Pagamento ---

    private Data $sql;

    public function __construct()
    {
        $this->sql = new Data;
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
            ->show("empresa","id_empresa,fantasia,imagem","statusconta = true",6)
            ->executeSql();

        }catch(DataException $ex){
            throw $ex;
        }finally{
            $this->sql->close();
        }
    }
}