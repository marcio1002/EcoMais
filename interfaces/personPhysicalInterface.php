<?php
namespace Interfaces;

    interface PersonPhysicalInterface {
        public function getCpf():int;
        /**
         * @param int $cpf
         * O cpf do usuário
         */
        public function setCpf(string $cpf):void;
    }

?>    