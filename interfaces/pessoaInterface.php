<?php 
    namespace Interfaces;
        
        interface PersonInterface {
            public function getId();
            public function setId(int $id);
            public function getName();
            public function setName(string $name);
            public function getPassword();
            public function setPassword(string $password);
            public function getEmail();
            public function setEmail(string $email);
            public function getCep();
            public function setCep(int $cep);
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
