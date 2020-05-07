<?php

namespace Models;

use interfaces\ImagesInterface;
use Models\DataException;

class ImagesModel implements ImagesInterface {

    protected $id;
    protected $name;
    protected $file;
    protected $clt;

    public function getId(): int
    {
       return $this->id; 
    }

    public function setId(int $id): void
    {
        if(empty($id)) throw new DataException('Error null values',DataException::NOT_IMPLEMENTED);

        $this->id = trim($id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if(empty($name)) throw new DataException('Error null values',DataException::NOT_IMPLEMENTED);

        $this->name = trim($name);
    }

    public function getImage():array 
    {
        return $this->file;
    }

    /**
     * separar os tipos de extensão por barra vertical
     * exem: ext| ext| ext;
    */
    public function setImage( string $exReg,array $file):void 
    {
        if($file['error'] === 4) throw new DataException('file undefined',DataException::NOT_FOUND);
        if($file['error'] === 1) throw new DataException('File size not supported by the system',DataException::NOT_IMPLEMENTED);
        if(!preg_match("/\.($exReg)$/",$file['name'])) throw new DataException('Format not support!',DataException::NOT_IMPLEMENTED);

        $this->file = $file;
    }

    public function getClassification(): string
    {
        return $this->crt;
    }

    public function setClassfication(string $clt): void
    {
        if(empty($clt)) throw new DataException('Error null values',DataException::NOT_IMPLEMENTED);

        $this->$clt = trim($clt);
    }
}