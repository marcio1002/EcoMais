<?php
namespace Ecomais\Models;

use Ecomais\Interfaces\PersonInterface;
use Ecomais\Models\DataException;
use TypeError;

abstract class  Person  implements PersonInterface
{
    const ENABLED = true; 
    const DISABLED = false;

    private $id;
    protected $name;
    protected $email;
    protected $passwd;
    protected $uf;
    protected $city;
    protected $addres;
    protected $number;
    protected $date;
    protected $cep;
    protected $statusAccount = self::ENABLED | self::DISABLED;

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

    public function setCep(int $cep = null): void
    {
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
        if (empty($city)) throw new DataException('Null values', DataException::REQ_INVALID);;

        $this->city = trim($city);
    }

    public function getAddres(): string
    {
        return $this->addres;
    }

    public function setAddres(string $addres = null): void
    {
        $this->addres = $addres;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): void
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

        $this->statusAccount = trim($typeUser);
    }

    public function createAt(): string
    {
        date_default_timezone_set("America/Sao_paulo");

        $this->date =   date('Y-m-d H:i:s');
        return $this->date;
    }
}
