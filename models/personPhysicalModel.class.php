<?php    
    namespace Models;
        
        use Interfaces\PersonPhysicalInterface;
        use Models\{Person,DataException};
        use TypeError;
        
        class PersonPhysical extends Person implements PersonPhysicalInterface{

            protected $cpf;
    
            public function getCpf():int 
            {
                return $this->cpf;
            }
        
            public function setCpf(string $cpf):void 
            { 
                if(empty($cpf)) throw new DataException('Undefined value', DataException::REQ_INVALID);
                if (!is_numeric($cpf)) throw new TypeError("Expected a number format", DataException::REQ_INVALID);
                $this->cpf = str_replace("/(\d{3})\.(\d{3})\.(\d{3})\-(\d{2})/","",trim($cpf));
            }
        }
