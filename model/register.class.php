<?php
require_once "../interfaces/registerInterface.php";
class Register implements RegisterInterface {
    private $name;
    private $password;
    private $email;
    private $cpf;
    private $cnpj;
    private $stati;
    private $city;
    private $addre;
    private $number;
    private $date;
    private $cep;

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword(string $password) {
        if (strlen($password) > 8) throw new Exception("Os números de caracteres foi ultrapassado, o máximo é de 8 caracteres");
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    public function getCep() {
        return $this->cep;
    }
    public function setCep($cep) {
        $this->cep = $cep;
    }
    public function getCnpj() {
        return $this->cnpj;
    }
    public function setCnpj(string $cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getStati() {
        return $this->stati;
    }

    public function setStati(string $stati) {
        $this->stati = $stati;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity(string $city) {
        $this->city = $city;
    }

    public function getAddre() {
        return $this->addre;
    }

    public function setAddre(string $addre) {
        $this->addre = $addre;
    }

    public function getNumber(){
        return $this->number;
    }

    public function setNumber(int $number) {
        if (!is_numeric($number)) throw new Exception("Formato não númerico", 1);
        $this->number = $number;
    }
    public function createAt() {
        date_default_timezone_set("America/Sao_paulo");
        $this->date =   date( 'd/m/Y(N)-A-H:i:s');
        return $this->date;
    }
}
?>