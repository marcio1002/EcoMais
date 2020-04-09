<?php    
namespace Model;

    use Model\{PersonPhysical,Safety};
    use Interfaces\AccountHandlingInterface;
    use Server\Data;
    use FFI\Exception;
    use PDOException;
use PDORow;
use PHPUnit\Framework\MockObject\Rule\AnyParameters;

class AccountHandling  implements accountHandlingInterface{

        public function createAccount(PersonPhysical $person):AnyParameters
        {
            $safety = new Safety();
            $sql = new Data();
    
            try
            {
    
                $passwd =  $safety->criptPasswd($person->getPassword());
                $array_columns = ["nome","email","password","date"];
                $array_register = [$person->getName(),$person->getEmail(),$passwd,$person->createAt()];
    
                $sql->open();
    
                return $sql->add("usuarios",$array_columns,$array_register);
    
            } catch(PDOException $ex) 
                {   
                    echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                    die();
                } catch(Exception $ex) 
                {
                    echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                    die();
                }
                finally 
                 {
                    $sql->close();
                 }
                
            }
    
            public function deleteAccount(PersonPhysical $person):AnyParameters
            {
                try{
                    $sql = new Data();
    
                    $id = [ $person->getId() ];
                    
                    $sql->open();
                    return $sql->delete("usuarios","id_usuario = ?",$id);
                    
                } catch(PDOException $ex)
                {
                    echo json_encode( ["error"=> true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                    die();
                 } catch(Exception $ex) 
                 {
                    echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                    die();
                 }
                 finally 
                 {
                    $sql->close();
                 }
            }
    
            public function updateAccount(PersonPhysical $person):AnyParameters
            {
                try{
                    
                    $sql = new Data();
    
                    
                    $postPreVal =["nome = ?","email = ?", "password = ?"];
                    $postVal = [$person->getName(), $person->getEmail(), $person->getPassword()];
                    $preWhere = [$person->getId()];
                    $sql->open();
    
                    return $sql->update("usuarios","id_usuario = ?",$preWhere,$postPreVal,$postVal);
    
                } catch(PDOException $ex)
                {
                    echo json_encode( ["error"=> true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                    die();
                 } catch(Exception $ex) 
                 {
                    echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                    die();
                 }
                 finally 
                 {
                    $sql->close();
                 }
            }
    
            public function setLogin(PersonPhysical $person,string $pwd):PDORow
            {
                try {
                    $data = new Data();
                    $where =  [$person->getEmail(),$pwd];
    
                    $data->open();
    
                    return $data->show('usuarios',[],"email = ? AND password = ?",$where,3);
                }
                catch(PDOException $ex)
                {
                    echo json_encode( ["error"=> true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                    die();
                 } catch(Exception $ex) 
                 {
                    echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                    die();
                 }
                 finally 
                 {
                    $data->close();
                 }
            }
    
            public function isLogged():bool
            {
                return (empty($_COOKIE['_id']) || empty($_COOKIE['_token']))? false : true; 
            }
    
            public function isAdmin()
            {
                
            }
        }
?>