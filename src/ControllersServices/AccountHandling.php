<?php 
namespace Ecomais\ControllersServices;

use Ecomais\Models\{Safety,DataException, Person};
use Ecomais\Services\Data;

class AccountHandling {

    private Data $sql;
    private Safety $safety;

    public function __construct() {
        $this->sql = new Data();
        $this->safety = new Safety();
    }

    public function createAccountPersonPhysical(Person $person): bool
    {
        try {
            $passwd =  $this->safety->criptPasswd($person->passwd);
            $columns = "nome,email,senha,cep,uf,cidade,endereco,statusconta,data_criacao";
            $data = array(
                $person->name,
                $person->email,
                $passwd,
                $person->cep,
                $person->uf,
                $person->locality,
                $person->addres,
                $person->statusAccount,
                $person->createAt()
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
                $parans = array($this->safety->criptPasswd($person->passwd), $person->id);
                $vals  = [];
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

            $this->sql->open();

            return $this->sql
                ->show($table,"","email = ?",3)
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
                ->show($table,"","${columnName} = ? AND email = ?",3)
                ->prepareParam($where)
                ->executeSql();

        }catch(DataException $ex) {
            throw $ex;
        } finally {
            $this->sql->close();
        }
    }

    public function recoverByKey(string $key): ?array 
    {
        try {
            $preWhere = [$key];

            $this->sql->open();

            return $this->sql
                ->show("usuario","senha","senha = ?",6)
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
            $this->sql->open();
            $where = ($option == 1) ? "email = ?" : "senha = ?";

            return $this->sql
                ->update("usuario","senha = ?",$where)
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