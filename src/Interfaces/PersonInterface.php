<?php
namespace Ecomais\Interfaces;

interface PersonInterface
{

    public function getId(): int;
    /**
     * @param int $id
     * Id do usuário
     * @return void
     */
    public function setId(int $id): void;
    //----------------------------
    public function getName(): string;
    /**
     * @param string $name
     * Nome do usuário
     * @return void
     */
    public function setName(string $name): void;
    //----------------------------
    public function getPassword(): string;
    /**
     * @param string $password
     * Senha do usuário
     * @return void
     */
    public function setPassword(string $password): void;
    //----------------------------
    public function getEmail(): string;
    /**
     * @param string $email
     * Email do usuário
     * @return void
     */
    public function setEmail(string $email): void;
    //----------------------------
    public function getCep(): ?int;
    /**
     * @param int $cep
     * Cep do usuário
     * @return void
     */
    public function setCep(?string $cep): void;
    //----------------------------
    public function getUF(): string;
    /**
     * @param string $uf
     * Unidade federativa do usuário
     * @return void
     */
    public function setUF(string $uf): void;
    //----------------------------
    public function getLocality(): string;
    /**
     * @param string $locality
     * Localidade do usuário
     * @return void
     */
    public function setLocality(string $locality): void;
    //----------------------------
    public function getAddres(): ?string;
    /**
     * @param string $addre
     * Endereço do usuário
     * @return void
     */
    public function setAddres(?string $addres): void;
    //----------------------------
    public function getNumber(): int;

    /**
     * @param int $number
     * Número do endereço
     * @return void
     */
    public function setNumber(int $number): void;
    //----------------------------
    public function getStatusAccount(): bool;

    /**
     * @param  int $typeUser
     * O tipo de usuário
     */
    public function setStatusAccount(bool $typeUser): void;
    //----------------------------
    /**
     * Data de criação do usuário
     * @return string
     */
    public function createAt(): string;
}
