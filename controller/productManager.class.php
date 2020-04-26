<?php    
namespace Controller;

    require_once __DIR__."/../vendor/autoload.php";
        
        use Model\{DataException,Product};

    class ManagerProduct {
        private $prod;


        /**
         * CONSTRUSTOR
         * @return void
         */
        public function __construct()
        {
            $this->prod = new Product(); 
        }
        

        /** 
         * Redirecionamento das views produtos 
         * @return void
         */
        public function showProduct():void 
        {
            require_once __DIR__."/../view/mostrar.php";
        }

        /** 
         * Metodos excluir os produtos
         */
        public function deleteImage():void
        {
            try{
            }catch(DataException $ex){
               echo json_encode( ["error"=> true,"errCode"=> $ex->getCode(),"msg" => $ex->getMessage()], );
                die();
            }
        }

        /**
         * Ativar e desativar os produtos
         */
       public function activeImage() 
        {
        }
    }
