<?php
 namespace Model;

    use Interfaces\PersonInterface;
    use Exception;
    use TypeError;

    abstract class  Person  implements PersonInterface {
        private $id;
        protected $name;
        protected $passwd;
        protected $email;
        protected $stati;
        protected $city;
        protected $addre;
        protected $number;
        protected $date;
        protected $cep;
        
        public function getId():int
        {
            return $this->id;
        }
    
        public function setId(int $id):void 
        {
            if(empty($id)) throw new Exception('Undefined value'); 
            $this->id = trim($id);
        }
    
        public function getName():string 
        {
            return $this->name;
        }
    
        public function setName(string $name):void 
        {
            if(empty($name)) throw new Exception('Undefined value'); 
            $this->name = trim($name);
        }
    
        public function getPassword():string 
        {
            return $this->passwd;
        }
    
        public function setPassword(string $password):void 
        {
            if(empty($password)) throw new Exception('Undefined value'); 
            if (strlen($password) > 15) throw new Exception("Character numbers have been exceeded, maximum 10 characters");
            $this->passwd = trim($password);
        }
    
        public function getEmail():string 
        {
            return $this->email;
        }
    
        public function setEmail(string $email):void 
        { 
            if(empty($email)) throw new Exception('Undefined value');
            $this->email = trim($email);
        }

        public function getCep():int 
        {
            return $this->cep;
        }

        public function setCep(int $cep):void 
        { 
            if(empty($cep)) throw new Exception('Undefined value');
            $this->cep = trim($cep);
        }
        
        public function getStati():int 
        {
            return $this->stati;
        }
    
        public function setStati(string $stati):void
        { 
            if(empty($stati)) throw new Exception('Undefined value');
            $this->stati = strtoupper(trim($stati));
        }
    
        public function getCity():string 
        {
            return $this->city;
        }
    
        public function setCity(string $city):void 
        { 
            if(empty($city)) throw new Exception('Undefined value');
            $this->city = trim($city);
        }
    
        public function getAddre():string 
        {
            return $this->addre;
        }
    
        public function setAddre(string $addre):void 
        { 
            if(empty($addre)) throw new Exception('Undefined value');
            $this->addre = trim($addre);
        }
    
        public function getNumber():int
        {
            return $this->number;
        }
    
        public function setNumber(int $number):void 
        {
            if(empty($number)) throw new Exception('Undefined value');
            if (!is_numeric($number)) throw new TypeError("Expected a number format", 1); 
            $this->number = trim($number);
        }

        public function createAt():string
        {
            date_default_timezone_set("America/Sao_paulo");
            $this->date =   date( 'd/m/Y(N)-A-H:i:s');
            return $this->date;
        }
    }
