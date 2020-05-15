<?php    
namespace ControllersServices;

    use Models\{PersonPhysical,Safety,DataException};
    use Services\Data;

class AccountHandling {

    private $sql;
    private $safety;

    public function __construct() {
        $this->sql = new Data();
        $this->safety = new Safety();
    }

    public function createAccount(PersonPhysical $person):int
    {
        try
        {

            $passwd =  $this->safety->criptPasswd($person->getPassword());
            $array_columns = "nome,email,password,date";
            $array_register = [$person->getName(),$person->getEmail(),$passwd,$person->createAt()];

            $this->sql->open();

            return $this->sql->add("usuarios",$array_columns,$array_register);

        } catch(DataException $ex) 
        {   
            return die( $ex->getMessage() );
        }finally 
        {
            $this->sql->close();
        }
            
    }
    
    public function deleteAccount(PersonPhysical $person):int
    {
            try{
                $id = [ $person->getId() ];
                
                $this->sql->open();
                return $this->sql->delete("usuarios","id_usuario = ?",$id);
                
            } catch(DataException $ex)
            {
                return die( $ex->getMessage() );

            }finally 
            {
                $this->sql->close();
            }
    }
    
    public function updateAccount(PersonPhysical $person):int
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
                throw new DataException($ex->getMessage());
            }finally 
            {
                $this->sql->close();
            }
    }
    
    public function setLogin(PersonPhysical $person):array
    {
            try {
                $pwd = $this->safety->criptPasswd($person->getPassword());
                $where =  [$person->getEmail(),$pwd];

                $this->sql->open();

                return $this->sql->show('usuarios',"","email = ? AND password = ?",$where,3);
            }
            catch(DataException $ex)
            { 
               throw new DataException($ex->getMessage());

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

    public function recoverPasswd(PersonPhysical $person) 
    {
        try {

            $pwd = [$this->safety->criptPasswd($person->getPassword())];

            $this->sql->open();

            return $this->sql->update("usuarios","password = ?",$pwd,"password = '?'",[$pwd]);
            
        }catch(DataException $ex) {
            throw new DataException($ex->getMessage());
        }finally {
            
            $this->sql->close();
        }

    }
}