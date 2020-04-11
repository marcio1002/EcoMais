<?php    
namespace Model;

    use Model\{PersonPhysical,Safety};
    use Interfaces\AccountHandlingInterface;
    use Server\Data;
    use Exception;
    use PDOException;
    use PHPUnit\Framework\MockObject\Rule\AnyParameters;

class AccountHandling  implements accountHandlingInterface{

    private $sql;
    private $safety;

    public function __construct() {
        $this->sql = new Data();
        $this->safety = new Safety();
    }

    public function createAccount(PersonPhysical $person):AnyParameters
    {
        try
        {

            $passwd =  $this->safety->criptPasswd($person->getPassword());
            $array_columns = ["nome","email","password","date"];
            $array_register = [$person->getName(),$person->getEmail(),$passwd,$person->createAt()];

            $this->sql->open();

            return $this->sql->add("usuarios",$array_columns,$array_register);

        } catch(PDOException $ex) 
        {   
            $ex->getMessage();
            die();
        } catch(Exception $ex) 
        {
            $ex->getMessage();
            die();
        }finally 
        {
            $this->sql->close();
        }
            
    }
    
    public function deleteAccount(PersonPhysical $person):AnyParameters
    {
            try{
                $id = [ $person->getId() ];
                
                $this->sql->open();
                return $this->sql->delete("usuarios","id_usuario = ?",$id);
                
            } catch(PDOException $ex)
            {
                $ex->getMessage();
                die();
            } catch(Exception $ex) 
            {
                $ex->getMessage();
                die();
            }
                finally 
            {
                $this->sql->close();
            }
    }
    
    public function updateAccount(PersonPhysical $person):AnyParameters
    {
            try{
                $pwd = $this->safety->criptPasswd($person->getPassword());
                $postPreVal = ["nome = ?","email = ?", "password = ?"];
                $postVal = [$person->getName(), $person->getEmail(), $pwd];
                $preWhere = [$person->getId()];
                $this->sql->open();

                return $this->sql->update("usuarios","id_usuario = ?",$preWhere,$postPreVal,$postVal);

            } catch(PDOException $ex)
            {
                $ex->getMessage();
                die();
            } catch(Exception $ex) 
            {
                $ex->getMessage();
                die();
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

                return $this->sql->show('usuarios',[],"email = ? AND password = ?",$where,3);
            }
            catch(PDOException $ex)
            {
                $ex->getMessage();
                die();
            } catch(Exception $ex) 
            {
                $ex->getMessage();
                die();
            }finally 
            {
                $this->sql->close();
            }
    }

    public function isLogged():bool
    {
        if (isset($_COOKIE['_id']) || isset($_COOKIE['_token'])) {
            $token =  uniqid(md5("ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}"));
            $this->sql->open();
            $res = $this->sql->show("usuarios",[],"id_usuario IN(?)",[$_COOKIE['_id']]);
            if($res) {
                $this->sql->close();
                $id = $res["id_usuario"];
                echo $_COOKIE['_token'] ,$token ,$_COOKIE['_id'] , $id;
                exit;
                return ($_COOKIE['_token'] === $token && $_COOKIE['_id'] === $id)? true : false;  
            }  
        } 
        return false;
    }

    public function isAdmin()
    { 
                
    }
}