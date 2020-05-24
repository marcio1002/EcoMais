<?php
namespace Ecomais\Interfaces;

interface ProductInterface
{

    public function getId(): int;
    /**
     * @param int $id
     * Id do produto
     */
    public function setId(int $id): void;
    //-------------------------------
    public function getName(): string;
    /**
     * @param string $name 
     * Nome do Produto;
     * @return void
     */
    public function setName(string $name): void;
    //-------------------------------
    public function getPrice(): float;
    /**
     * @param float $price
     * Preço do produto
     * @return void
     */
    public function setPrice(float $price): void;
    //-------------------------------
    public function getBrand(): string;
    /**
     * @param string $brand
     * Marca do Produto
     * @return void
     */
    public function setBrand(string $brand): void;
    //-------------------------------
    public function getQuantity(): int;
    /**
     * @param int $quantity
     * Quantidades de produtos
     * @return void
     */
    public function setQuantity(int $quantity): void;
    //-------------------------------
    public function getClassification(): string;
    /**
     * @param string $clt
     * Classificação do produto
     * @return void
     */
    public function setClassification(string $clt): void;
    //-------------------------------
    public function getDescription();
    /**
     * @param string $desc
     * Descrição do produto
     * @return void
     */
    public function setDescription(String $desc): void;
    //-------------------------------
    public function getPeriod(): string;
    /**
     * @param string $pd
     * O prazo do produto
     * @return void
     */
    public function setPeriod(string $pd): void;
    //-------------------------------
    public function getStatus():bool;
    /**
     * @param int $status
     * O status do produto ATIVADO | DESATIVADO
     */
    public function setStatus(bool $status): void;
    //-------------------------------
    public function getFk_Company(): int;
    /**
     * @param int $fkCompany
     * O id da empresa
     * @return void
     */
    public function setFk_Company(int $fkCompany): void;
    //-------------------------------

    /**
     * A data da criação do produto
     * @return string
     */
    public function createAt(): string;
}
