<?php
    namespace Interfaces;
        
        interface PersonLegalInterface {
            public function getCnpj();
            public function setCnpj(int $cnpj);
        }
