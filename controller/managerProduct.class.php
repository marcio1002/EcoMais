<?php    
namespace Controller;

    require_once __DIR__."/../vendor/autoload.php";
        
        use Model\DataException;

    class ManagerProduct {
        
        /** Redirecionamento das views produtos */

        public function showProduct() {
            require_once __DIR__."/../view/mostrar.php";
        }

        /** Metodos para os produtos */
        public function deleteImage() 
        {

            try{
                
            }catch(DataException $ex){
               echo json_encode( ["error"=> true,"errCode"=> $ex->getCode(),"msg" => $ex->getMessage()], );
                die();
            }
        }

       public function activeImage() 
        {
        }
    }
