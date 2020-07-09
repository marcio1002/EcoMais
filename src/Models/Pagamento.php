<?php
namespace Ecomais\Models;

use Ecomais\Models\DataException;

use TypeError;

/**
 * pode deixar o PersonLegal como herança porque ele já tem os atributos certos 
 * e tem a classe Person estendida
 * 
 * depois tira esse comentário
*/
class Pagamento extends PersonLegal 
{
    private int $id;
    private int $tipo; 
    private string $code_trans;
    private int $status;
    private string $link_boleto;
    private string $link_bd_online;
    private string $data_criacao;
    private string $data_update;

    public function __set($name, $value)
    {
        if (empty($name) || empty($value)) throw new DataException('Null values', DataException::REQ_INVALID);
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * Pega todos os valores nos atributos da classe
     * @return array
     */
    public function getAll(): array
    {
        $array = array();
        foreach($this as $key => $val) {
            $array += array($key => $val);
        }
        return $array;
    }
}