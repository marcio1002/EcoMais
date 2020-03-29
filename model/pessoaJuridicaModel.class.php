<?php
    require_once __DIR__."/pessoaModel.class.php";
    require_once __DIR__."/../interfaces/pessoaJuridicaInterface.php";
    
    class PersonLegal extends person implements PersonLegalInterface{

    protected $cnpj;

        public function getCnpj() {
            return $this->cnpj;
        }

        public function setCnpj(int $cnpj) { 
            if(empty($cnpj)) throw new Exception('Undefined value');
            if (!is_numeric($cnpj)) throw new TypeError("Expected a number format", 1);
            $this->cnpj = trim($cnpj);
        }
    }
?>