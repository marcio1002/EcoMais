<?php
namespace Ecomais\Interfaces;

interface ImagesInterface
{

    public function getId(): int;

    /**
     * @param string $id
     * Id da imagem
     */
    public function setId(int $id): void;
    //-------------------------------
    public function getName(): string;

    /**
     * @param string $name
     * O nome da imagem
     * @return void
     */
    public function setName(string $name): void;
    //-------------------------------
    public function getImage(): array;
    /**
     * @param string $exReg
     * Extensões para validação do tipo de imagem
     * @param array $file
     * Um array de informações da imagem  
     * @return void
     */
    public function setImage(string $exReg, array $file): void;
    //-------------------------------
    public function getClassification(): string;

    /**
     * @param string $clt
     * Classificação da imagem
     * @return void
     */
    public function setClassfication(string $clt): void;
}
