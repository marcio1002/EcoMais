<?php
require_once "./interfaces/registerInterface.php";
class RegisterController  implements Register
{
    private $name;
    private $password;
    private $email;
    private $cpf;
    private $cnpj;
    private $stati;
    private $city;
    private $addre;
    private $number;


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (strlen($password) > 8) throw new Exception("Os números de caracteres foi ultrapassado, o máximo é de 8 caracteres");
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getStati()
    {
        return $this->stati;
    }

    public function setStati($stati)
    {
        $this->stati = $stati;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getAddre()
    {
        return $this->addre;
    }

    public function setAddre($addre)
    {
        $this->addre = $addre;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        if (!is_numeric($number)) throw new Exception("Formato não númerico", 1);
        $this->number = $number;
    }
}
?>