<?php
    require_once __DIR__."/../interfaces/manipulacaoContasInterface.php";
    require_once __DIR__."/../server/dataModel.class.php";
    require_once __DIR__."/segurancaModel.class.php";

    class AccountHandling  implements accountHandlingInterface{
        private $_id;
        private $_token;

        public function createAccount(PersonPhysical $person)
        {
            $safety = new Safety();
            $sql = new Data();

            try
            {

                $passwd = $safety->criptPasswd($person->getPassword());
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

        public function deleteAccount(PersonPhysical $person)
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

        public function updateAccount(PersonPhysical $person)
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

        public function login(PersonPhysical $person,string $pwd)
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

        public function isLogged()
        {
            return (empty($_COOKIE['_id']) || empty($_COOKIE['_token']))? false : true; 
        }

        public function isAdmin()
        {
            
        }
    }
?>