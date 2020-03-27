<?php
    require_once "../interfaces/accountHandlingInterface.php";
    require_once "../server/dataModel.class.php";
    require_once "safetyModel.class.php";

    class AccountHandling  implements accountHandlingInterface{

        public function createAccount(PersonPhysical $person)
        {
            $safety = new Safety();
            $sql = new Data();

            try
            {

                $passwd = $safety->criptPasswd($person->getPassword());
                $array_columns = array("nome","email","password","date");
                $array_register = array($person->getName(),$person->getEmail(),$passwd,$person->createAt());

                $sql->open();

               return $sql->add("usuarios",$array_columns,$array_register);
               $sql->close();
            } catch(PDOException $ex) 
            {   
                echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                die();
            } catch(Exception $ex) 
            {
                echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                die();
            }
        }

        public function deleteAccount(PersonPhysical $person)
        {
            try{
                $sql = new Data();

                $id = [ $person->getId() ];
                
                $sql->open();
                return $sql->delete("usuarios","id_usuario = ?",$id);
                $sql->close();
                
            } catch(PDOException $ex)
            {
                echo json_encode( ["error"=> true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                die();
             } catch(Exception $ex) 
             {
                echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                die();
             }
        }

        public function updateAccount(PersonPhysical $person)
        {
            try{
                
                $sql = new Data();

                
                $postPreVal =["nome = ?","email = ?", "password = ?"];
                $postVal = [$person->getName(), $person->getEmail(), $person->getPassword()];
                $preWhere = [$person->getId()];
                $sql->open();

                return $sql->update("usuarios","id_usuario = ?",$preWhere,$postPreVal,$postVal);

                $sql->close();

            } catch(PDOException $ex)
            {
                echo json_encode( ["error"=> true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                die();
             } catch(Exception $ex) 
             {
                echo json_encode( ["error" => true,"status"=> $ex->getCode(),"msg" => $ex->getMessage()]);
                die();
             }
        }

        public function login()
        {
            
        }

        public function isAdmin()
        {
            
        }
    }
?>