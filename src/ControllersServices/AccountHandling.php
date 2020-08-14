<?php 
namespace Ecomais\ControllersServices;

use Ecomais\Models\{Implementation,DataException, Person};
use Ecomais\Services\Data;

class AccountHandling {

    private Data $sql;
    private Implementation $implement;

    public function __construct() 
    {
        $this->sql = new Data();
        $this->implement = new Implementation();
    }

    public function createAccountPersonPhysical(Person $person): bool
    {
        try {
            $person->passwd =  $this->implement->criptPasswd($person->passwd);
            $columns = "nome,email,senha,uf,cidade,endereco,cep,statusconta,data_criacao";

            $this->sql->open();

            return $this->sql
                ->add("usuario",$columns,count($person->toArray()))
                ->prepareParam($person->toArray())
                ->execNotRowSql();

        } catch(DataException $ex)  {   
            throw new DataException( $ex->getMessage(),$ex->getCode() );
            
        } finally {
            $this->sql->close();
        }
            
    }

    /**
     * Verifica se o hash precisa ser atualizada, se sim ela é atualizada no banco
     * @param string $passwd
     * O password hash
     * @param Person $person
     * O password a ser atualizado se necessário
     * @return void
     */
    public function verifyUpdateHash(string $passwd, Person $person):void
    {
        try{
            if(password_needs_rehash($passwd, PASSWORD_DEFAULT)) {
                $parans = array($this->implement->criptPasswd($person->passwd), $person->id);
                $this->sql->open();
                $this->sql
                    ->update("usuario","senha = ?","id_usuario = ?")
                    ->prepareParam($parans)
                    ->execNotRowSql();
            }
        }catch(DataException $ex) {
           throw $ex;
        }finally {
            $this->sql->close();
        }
    }

    public function setLogin(Person $person,int $typeUser): ?array
    {
        try {
             $table = ($typeUser == 10) ? "empresa" : "usuario";
             $where = ($typeUser == 10) ? "cnpj = ?" : "email = ?";

            $this->sql->open();

            return $this->sql
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

            $this->sql->open();

            return $this->sql
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

            $this->sql->open();

            return $this->sql
                ->show($table,"senha","senha = ?",6)
                ->prepareParam($preWhere)
                ->executeSql();
            
        }catch(DataException $ex) {
           throw $ex;

        }finally {
            $this->sql->close();
        }

    }

    public function recoverPasswd(Person $usr,string $value, int $option): bool
    {
        try{
            $where = ($option == 1) ? "email = ?" : "senha = ?";

            $this->sql->open();
            $tableEmp = $this->sql->show("empresa","",$where,3)
                ->prepareParam([$value])
                ->executeSql();
            $tableUser = $this->sql->show("usuario","",$where,3)
                ->prepareParam([$value])
                ->executeSql();
                
            if(count($tableEmp) == 0 && count($tableUser) == 0 ) return false;
            
            $table = (count($tableEmp) > 0) ? "empresa" : "usuario";

            return $this->sql
                ->update($table,"senha = ?",$where)
                ->prepareParam(array($usr->passwd,$value))
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
            $this->sql->open();
            
            return $this->sql
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