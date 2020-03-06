<?php
require_once "../interfaces/userInterface.php";
class User implements UserInterface {
    protected $name;
    protected $passwd;
    protected $email;
    protected $cpf;
    protected $cnpj;
    protected $stati;
    protected $city;
    protected $addre;
    protected $number;
    protected $date;
    protected $cep;

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        if(empty($name)) throw new Exception('Undefined value');
        $this->name = $name;
    }

    public function getPassword() {
        return $this->passwd;
    }

    public function setPassword(string $password) {
        if(empty($password)) throw new Exception('Undefined value');
        if (strlen($password) > 15) throw new Exception("Character numbers have been exceeded, maximum 10 characters");
        $this->passwd = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email) {
        if(empty($email)) throw new Exception('Undefined value');
        $this->email = $email;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        if(empty($cpf)) throw new Exception('Undefined value');
        if (!is_numeric($cpf)) throw new TypeError("Expected a number format", 1);
        $this->cpf = $cpf;
    }
    public function getCep() {
        return $this->cep;
    }
    public function setCep($cep) {
        if(empty($cep)) throw new Exception('Undefined value');
        $this->cep = $cep;
    }
    public function getCnpj() {
        return $this->cnpj;
    }
    public function setCnpj(string $cnpj) {
        if(empty($cnpj)) throw new Exception('Undefined value');
        if (!is_numeric($cnpj)) throw new TypeError("Expected a number format", 1);
        $this->cnpj = $cnpj;
    }

    public function getStati() {
        return $this->stati;
    }

    public function setStati(string $stati) {
        if(empty($stati)) throw new Exception('Undefined value');
        $this->stati = $stati;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity(string $city) {
        if(empty($city)) throw new Exception('Undefined value');
        $this->city = $city;
    }

    public function getAddre() {
        return $this->addre;
    }

    public function setAddre(string $addre) {
        if(empty($addre)) throw new Exception('Undefined value');
        $this->addre = $addre;
    }

    public function getNumber(){
        return $this->number;
    }

    public function setNumber(int $number) {
        if(empty($number)) throw new Exception('Undefined value');
        if (!is_numeric($number)) throw new TypeError("Expected a number format", 1);
        $this->number = $number;
    }
    public function createAt() {
        date_default_timezone_set("America/Sao_paulo");
        $this->date =   date( 'd/m/Y(N)-A-H:i:s');
        return $this->date;
    }
}
?>