<?php
    require_once "personModel.class.php";
    require_once "../interfaces/personPhysicalInterface.php";
    
    class PersonPhysical extends Person implements PersonPhysicalInterface{

        protected $cpf;

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