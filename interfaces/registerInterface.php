<?php 
    interface Register {

        public function getName();
        public function setName($name);
        public function getPassword();
        public function setPassword($password);
        public function getEmail();
        public function setEmail($email);
        public function getCpf();
        public function setCpf($cpf);
        public function getCnpj();
        public function setCnpj($cnpj);
        public function getStati();
        public function setStati($stati);
        public function getCity();
        public function setCity($city);
        public function getAddre();
        public function setAddre($addre);
        public function getNumber();
        public function setNumber($number);
    }
