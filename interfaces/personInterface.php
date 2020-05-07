<?php 
    namespace Interfaces;
        
        interface PersonInterface {

            public function getId():int;
            /**
             * @param int $id
             * Id do usuário
             * @return void
             */
            public function setId(int $id):void;
            //----------------------------
            public function getName():string;
            /**
             * @param string $name
             * Nome do usuário
             * @return void
             */
            public function setName(string $name):void;
            //----------------------------
            public function getPassword():string;
            /**
             * @param string $password
             * Senha do usuário
             * @return void
             */
            public function setPassword(string $password):void;
            //----------------------------
            public function getEmail():string;
            /**
             * @param string $email
             * Email do usuário
             * @return void
             */
            public function setEmail(string $email):void;
            //----------------------------
            public function getCep():int;
            /**
             * @param int $cep
             * Cep do usuário
             * @return void
             */
            public function setCep(int $cep):void;
            //----------------------------
            public function getUF():string;
            /**
             * @param string $uf
             * Unidade federativa do usuário
             * @return void
             */
            public function setUF(string $uf):void;
            //----------------------------
            public function getCity():string;
            /**
             * @param string $locality
             * Localidade do usuário
             * @return void
             */
            public function setCity(string $locality):void;
            //----------------------------
            public function getAddre():string;
            /**
             * @param string $addre
             * Endereço do usuário
             * @return void
             */
            public function setAddre(string $addre):void;
            //----------------------------
            public function getNumber():int;

            /**
             * @param int $number
             * Número do endereço
             * @return void
             */
            public function setNumber(int $number):void;
            //----------------------------
            public function getTypeUser():int;

            /**
             * @param  int $typeUser
             * O tipo de usuário
             */
            public function setTyperUser(int $typeUser):void;
            //----------------------------
            /**
             * Data de criação do usuário
             * @return string
             */
            public function createAt():string;
        }
