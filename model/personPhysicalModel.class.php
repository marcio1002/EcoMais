<?php
    require_once "../model/PersonModel.class.php";
    require_once "../interfaces/personPhysicalInterface.php";
    
    class PersonPhysical extends Person implements PersonPhysicalInterface{

        private $id;
        protected $cpf;

        public function getId() {
            return $this->id;
        }
    
        public function setId(int $id) {
            if(empty($id)) throw new Exception('Undefined value'); 
            $this->id = trim($id);
        }

        public function getCpf() {
            return $this->cpf;
        }
    
        public function setCpf(int $cpf) { 
            if(empty($cpf)) throw new Exception('Undefined value');
            if (!is_numeric($cpf)) throw new TypeError("Expected a number format", 1);
            $this->cpf = trim($cpf);
        }
    }
?>