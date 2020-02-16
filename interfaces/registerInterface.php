<?php 
    interface Register {

        public function getName();
        public function setName(string $name);
        public function getPassword();
        public function setPassword(string $password);
        public function getEmail();
        public function setEmail(string $email);
        public function getCpf();
        public function setCpf(string $cpf);
        public function getCep();
        public function setCep($cep);
        public function getCnpj();
        public function setCnpj(string $cnpj);
        public function getStati();
        public function setStati(string $stati);
        public function getCity();
        public function setCity(string $city);
        public function getAddre();
        public function setAddre(string $addre);
        public function getNumber();
        public function setNumber(int $number);
        public function createAt();
    }
