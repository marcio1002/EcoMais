<?php 
namespace Ecomais\ControllersServices;

use Ecomais\Models\{Implementation,DataException, Person, PersonLegal};
use Ecomais\Services\Data;
use PDOException;

class AccountHandling {

    private Data $sql;
    private Implementation $implement;

    public function __construct() 
    {
        $this->sql = new Data();
        $this->implement = new Implementation();
    }

    /**
     * Verifica se o hash precisa ser atualizada, se sim ela é atualizada no banco
     * @param string $passwd
     * O password hash
     * @param Person $person
     * O password a ser atualizado se necessário
     * @return void
     */
    public function verifyUpdateHash(Person $person, string $senha,string $table_name):void
    {
        try{
            if(password_needs_rehash($person->passwd, PASSWORD_DEFAULT)) {
                $params = [$this->implement->criptPasswd($senha), $person->id];
                $this->sql
                    ->open()
                    ->update($table_name,"senha = ?","id_usuario = ?")
                    ->prepareParam($params)
                    ->execNotRowSql();
            }
        }catch(DataException $ex) {
           throw $ex;
        }finally {
            $this->sql->close();
        }
    }

    public function getLogin(Person $person,int $typeUser): ?array
    {
        try {
             $table = ($typeUser == 10) ? "empresa" : "usuario";
             $where = ($typeUser == 10) ? "cnpj = ?" : "email = ?";

            return $this->sql
                ->open()
                ->show($table,"",$where,3)
                ->prepareParam([$person->email])
                ->executeSql();
        }
        catch(DataException $ex) { 
            throw $ex;
            
        } finally {
            $this->sql->close();
        }
    }

    public function getLoginAuthGoogle(Person $person, string $table): ?array
    {
        try {
            $where = [$person->name, $person->email];

            $columnName = ($table == "empresa") ? "fantasia" : "nome";

            return $this->sql
                ->open()
                ->show($table,"","$columnName = ? AND email = ?",3)
                ->prepareParam($where)
                ->executeSql();

        }catch(DataException $ex) {
            throw $ex;
        } finally {
            $this->sql->close();
        }
    }

    public function recoverByKey(string $key,int $typeUser): ?array 
    {
        try {
            $preWhere = [$key];

            $table = ($typeUser == 10) ? "empresa" : "usuario";

            $this->sql
                ->open()
                ->show($table,"senha","senha = ?",6)
                ->prepareParam($preWhere)
                ->executeSql();
            
        }catch(DataException $ex) {
           throw $ex;

        }finally {
            $this->sql->close();
        }

    }

    public function recoverByCNPJ(string $cnpj): ?array
    {
        try {
            return $this->sql
                ->open()
                ->show("empresa","*","CNPJ = ?",6)
                ->prepareParam([$cnpj])
                ->executeSql();
            
        }catch(DataException $ex) {
           throw $ex;

        }finally {
            $this->sql->close();
        }

    }

    public function recoverByEmail(string $email,int $typeUser): ?array
    {
        try {
            $table = ($typeUser == 10) ? "empresa" : "usuario";
            return $this->sql
                ->open()
                ->show($table,"*","email = ?",6)
                ->prepareParam([$email])
                ->executeSql();
            
        }catch(DataException $ex) {
           throw $ex;

        }finally {
            $this->sql->close();
        }

    }

    public function updatePasswd(Person $usr,string $value): bool
    {
        try{
            $where = ($this->implement->isEmail($value)) ? "email = ?" : "senha = ?";

            $this->sql->open();
            $tableEmp = $this->sql->show("empresa","",$where,3)
                ->prepareParam([$value])
                ->executeSql();
            $tableUser = $this->sql->show("usuario","",$where,3)
                ->prepareParam([$value])
                ->executeSql();
                
            if(count($tableEmp) == 0 && count($tableUser) == 0 ) return false;
            
            $table = (count($tableEmp) > 0) ? "empresa" : "usuario";

            $where .= (count($tableEmp) > 0) ? " AND id_empresa = ?" : " AND id_usuario = ?";

            $usr->id = (count($tableEmp) > 0) ? $tableEmp["id_empresa"] : $tableUser["id_usuario"];

            return $this->sql
                ->update($table,"senha = ?",$where)
                ->prepareParam(array($usr->passwd,$value, $usr->id))
                ->execNotRowSql();
        }catch(DataException $ex) {
           throw $ex;
        }finally {
            $this->sql->close();
        }
    }


    public function recoverByCNPJAndUpdatePasswd(Person $usr, int $cnpj): bool
    {
        try {

            $tableEmp = $this->sql
                ->open()
                ->show("empresa","","cnpj = ?",3)
                ->prepareParam([$cnpj])
                ->executeSql();
                
            if(count($tableEmp) == 0) return false;

            $usr->id = $tableEmp["id_empresa"];

            return $this->sql
                ->update("empresa","senha = ?","cnpj = ? AND id_empresa = ?")
                ->prepareParam([$usr->passwd, $cnpj, $usr->id])
                ->execNotRowSql();

        }catch(DataException $ex) {

            throw $ex;

        }finally {
            $this->sql->close();
        }
    }

    public function createNewsLetter($email): bool
    {
        try{
            return $this->sql
                ->open()
                ->add("newsletter","email",1)
                ->prepareParam([$email])
                ->execNotRowSql();
        }catch(DataException $ex) {
            throw $ex;

        }finally {
            $this->sql->close();
        }
    }
}