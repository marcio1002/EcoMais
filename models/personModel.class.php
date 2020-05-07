<?php
 namespace Models;

    use Interfaces\PersonInterface;
    use Models\DataException;
    use TypeError;

    abstract class  Person  implements PersonInterface {
        private $id;
        protected $name;
        protected $passwd;
        protected $email;
        protected $uf;
        protected $city;
        protected $addre;
        protected $number;
        protected $date;
        protected $cep;
        protected $typeUser;
        
        public function getId():int
        {
            return $this->id;
        }
    
        public function setId(int $id):void 
        {
            if(empty($id)) throw new DataException('Null values',DataException::REQ_INVALID);

            $this->id = trim($id);
        }
    
        public function getName():string 
        {
            return $this->name;
        }
    
        public function setName(string $name):void 
        {
            if(empty($name)) throw new DataException('Null values',DataException::REQ_INVALID);

            $this->name = trim($name);
        }
    
        public function getPassword():string 
        {
            return $this->passwd;
        }
    
        public function setPassword(string $password):void 
        {
            if(empty($password)) throw new DataException('Null values',DataException::REQ_INVALID);; 
            if (strlen($password) > 25) throw new DataException ("Character numbers have been exceeded, maximum 10 characters");
            
            $this->passwd = trim($password);
        }
    
        public function getEmail():string 
        {
            return $this->email;
        }
    
        public function setEmail(string $email):void 
        { 
            if(empty($email)) throw new DataException('Null values',DataException::REQ_INVALID);
            
            $this->email = trim($email);
        }

        public function getCep():int 
        {
            return $this->cep;
        }

        public function setCep(int $cep):void 
        { 
            if(empty($cep)) throw new DataException('Null values',DataException::REQ_INVALID);;
            
            $this->cep = trim($cep);
        }
        
        public function getUF():string 
        {
            return $this->uf;
        }
    
        public function setUF(string $uf):void
        { 
            if(empty($uf)) throw new DataException('Null values',DataException::REQ_INVALID);;
            
            $this->uf = strtoupper(trim($uf));
        }
    
        public function getCity():string 
        {
            return $this->city;
        }
    
        public function setCity(string $city):void 
        { 
            if(empty($city)) throw new DataException('Null values',DataException::REQ_INVALID);;
           
            $this->city = trim($city);
        }
    
        public function getAddre():string 
        {
            return $this->addre;
        }
    
        public function setAddre(string $addre):void 
        { 
            if(empty($addre)) throw new DataException('Null values',DataException::REQ_INVALID);
            
            $this->addre = trim($addre);
        }
    
        public function getNumber():int
        {
            return $this->number;
        }
    
        public function setNumber(int $number):void 
        {
            if(empty($number)) throw new DataException('Null values',DataException::REQ_INVALID);
            if (!is_numeric($number)) throw new TypeError("Expected a number format", DataException::REQ_INVALID); 
            
            $this->number = trim($number);
        }
     
        public function getTypeUser(): int
        {
            return $this->typeUser;
        }

        public function setTyperUser(int $typeUser):void
        {
            if(empty($typeUser)) throw new DataException('Null values',DataException::REQ_INVALID);
            
            $this->typeUser = trim($typeUser);  
        }

        public function createAt():string
        {
            date_default_timezone_set("America/Sao_paulo");
            
            $this->date =   date( 'd/m/Y(N)-A-H:i:s');
            return $this->date;
        }
    }
