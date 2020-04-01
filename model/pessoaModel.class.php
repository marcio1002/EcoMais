<?php
require_once __DIR__."/../interfaces/pessoaInterface.php";
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
    
    public function getId() {
        return $this->id;
    }

    public function setId(int $id) {
        if(empty($id)) throw new Exception('Undefined value'); 
        $this->id = trim($id);
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        if(empty($name)) throw new Exception('Undefined value'); 
        $this->name = trim($name);
    }

    public function getPassword() {
        return $this->passwd;
    }

    public function setPassword(string $password) {
        if(empty($password)) throw new Exception('Undefined value'); 
        if (strlen($password) > 15) throw new Exception("Character numbers have been exceeded, maximum 10 characters");
        $this->passwd = trim($password);
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email) { 
        if(empty($email)) throw new Exception('Undefined value');
        $this->email = trim($email);
    }
    public function getCep() {
        return $this->cep;
    }
    public function setCep(int $cep) { 
        if(empty($cep)) throw new Exception('Undefined value');
        $this->cep = trim($cep);
    }
    
    public function getStati() {
        return $this->stati;
    }

    public function setStati(string $stati) { 
        if(empty($stati)) throw new Exception('Undefined value');
        $this->stati = strtoupper(trim($stati));
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity(string $city) { 
        if(empty($city)) throw new Exception('Undefined value');
        $this->city = trim($city);
    }

    public function getAddre() {
        return $this->addre;
    }

    public function setAddre(string $addre) { 
        if(empty($addre)) throw new Exception('Undefined value');
        $this->addre = trim($addre);
    }

    public function getNumber(){
        return $this->number;
    }

    public function setNumber(int $number) {
        if(empty($number)) throw new Exception('Undefined value');
        if (!is_numeric($number)) throw new TypeError("Expected a number format", 1); 
        $this->number = trim($number);
    }
    public function createAt() {
        date_default_timezone_set("America/Sao_paulo");
        $this->date =   date( 'd/m/Y(N)-A-H:i:s');
        return $this->date;
    }
}
?>