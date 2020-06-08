<?php 
namespace Ecomais\ControllersServices;

use Ecomais\Models\{Safety,DataException, Person, PersonLegal};
    use Ecomais\Services\Data;

class AccountHandling {

    private Data $sql;
    private Safety $safety;

    public function __construct() {
        $this->sql = new Data();
        $this->safety = new Safety();
    }

    public function createAccountPersonPhysical(Person $person):int
    {
        try
        {

            $passwd =  $this->safety->criptPasswd($person->getPassword());
            $array_columns = "nome,email,senha,cep,uf,cidade,endereco,statusconta,data_criacao";
            $array_register = array(
                $person->getName(),
                $person->getEmail(),
                $passwd,
                $person->getCep(),
                $person->getUF(),
                $person->getLocality(),
                $person->getAddres(),
                $person->getStatusAccount(),
                $person->createAt()
            );

            $this->sql->open();

            return $this->sql->add("usuario",$array_columns,$array_register);

        } catch(DataException $ex) 
        {   
            throw new DataException( $ex->getMessage(),$ex->getCode() );

        }finally 
        {
            $this->sql->close();
        }
            
    }

    public function createAccountPersonLegal(PersonLegal $personLegal)
    {}
    
    public function deleteAccount(Person $person):int
    {
            try{
                $id = [ $person->getId() ];
                
                $this->sql->open();
                return $this->sql->delete("usuarios","id_usuario = ?",$id);
                
            } catch(DataException $ex)
            {
                throw new DataException( $ex->getMessage(), $ex->getCode() );

            }finally 
            {
                $this->sql->close();
            }
    }
    
    public function updateAccountPersonPhysical(Person $person):int
    {
            try{
                $pwd = $this->safety->criptPasswd($person->getPassword());
                $postPreVal = "nome = ?,email = ?,password = ?";
                $postVal = [$person->getName(), $person->getEmail(), $pwd];
                $preWhere = [$person->getId()];
                $this->sql->open();

                return $this->sql->update("usuarios","id_usuario = ?",$preWhere,$postPreVal,$postVal);

            } catch(DataException $ex)
            {
                throw new DataException($ex->getMessage(), $ex->getCode() );
            }finally 
            {
                $this->sql->close();
            }
    }

    public function updateAccountPersonLegal(PersonLegal $personLegal)
    {}
    
    public function setLogin(Person $person):array
    {
            try {
                $pwd = $this->safety->criptPasswd($person->getPassword());
                $where =  [$person->getEmail(),$pwd];

                $this->sql->open();

                return $this->sql->show('usuario',"","email = ? AND senha = ?",$where,3);
            }
            catch(DataException $ex) { 
               throw new DataException( $ex->getMessage(), $ex->getCode() );

            } finally 
            {
                $this->sql->close();
            }
    }

    public function isLogged():bool
    {
            if (isset($_COOKIE['_id']) || isset($_COOKIE['_token'])) {
                $this->sql->open();
                $res = $this->sql->show("usuarios","","id_usuario = ?",[$_COOKIE['_id']],3);
                if($res) {
    
                    $token =  md5("ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}");
                    $id = $res["id_usuario"];
                    if (strcasecmp($_COOKIE['_token'],$token) === 0 && strcasecmp($_COOKIE['_id'],$id) === 0 ) return true;  
                } 
                $this->sql->close(); 
            } 
            return false;
    }

    public function isAdmin()
    {               
    }

    public function recoverByKey(string $key):array 
    {
        try {
            $preWhere = [$key];

            $this->sql->open();

            return $this->sql->show("usuario","senha","senha = ?",$preWhere,6);
            
        }catch(DataException $ex) {
            throw new DataException( $ex->getMessage(), $ex->getCode() );
        }finally {
            
            $this->sql->close();
        }

    }
}