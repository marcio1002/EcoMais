<?php
namespace Ecomais\Models;

use Ecomais\Interfaces\PersonInterface;
use Ecomais\Models\DataException;
use TypeError;

class Person  implements PersonInterface
{
    const ENABLED = true; 
    const DISABLED = false;

    private int $id;
    protected string $name;
    protected string $email;
    protected string $passwd;
    protected string $uf;
    protected string $city;
    protected string $addres;
    protected int $number;
    protected string $date;
    protected ?int $cep;
    protected bool $statusAccount;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        if (empty($id)) throw new DataException('Null values', DataException::REQ_INVALID);

        $this->id = trim($id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if (empty($name)) throw new DataException('Null values', DataException::REQ_INVALID);
        $this->name = trim($name);
    }

    public function getPassword(): string
    {
        return $this->passwd;
    }

    public function setPassword(string $password): void
    {
        if (empty($password)) throw new DataException('Null values', DataException::REQ_INVALID);;
        if (strlen($password) > 25) throw new DataException("Character numbers have been exceeded, maximum 10 characters");

        $this->passwd = trim($password);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        if (empty($email)) throw new DataException('Null values', DataException::REQ_INVALID);

        $this->email = trim($email);
    }

    public function getCep(): int
    {
        return $this->cep;
    }

    public function setCep(?string $cep): void
    {
        $cep = preg_replace("/[.-]/","",$cep);
        $this->cep = $cep;
    }

    public function getUF(): string
    {
        return $this->uf;
    }

    public function setUF(string $uf): void
    {
        if (empty($uf)) throw new DataException('Null values', DataException::REQ_INVALID);;

        $this->uf = strtoupper(trim($uf));
    }

    public function getLocality(): string
    {
        return $this->city;
    }

    public function setLocality(string $city): void
    {
        if (empty($city)) throw new DataException('Null values', DataException::REQ_INVALID);

        $this->city = trim($city);
    }

    public function getAddres(): string
    {
        return $this->addres;
    }

    public function setAddres(?string $addres): void
    {
        $this->addres = $addres;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber($number): void
    {
        if (empty($number)) throw new DataException('Null values', DataException::REQ_INVALID);
        if (!is_numeric($number)) throw new TypeError("Expected a number format", DataException::REQ_INVALID);

        $this->number = trim($number);
    }

    public function getStatusAccount(): bool
    {
        return $this->statusAccount;
    }

    public function setStatusAccount(bool $typeUser): void
    {
        if (empty($typeUser)) throw new DataException('Null values', DataException::REQ_INVALID);

        $this->statusAccount = $typeUser;
    }

    public function createAt(): string
    {
        date_default_timezone_set("America/Sao_paulo");

        $this->date =   date('Y-m-d H:i:s');
        return $this->date;
    }
}
