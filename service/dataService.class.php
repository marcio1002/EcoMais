<?php

/** 
 *@author Marcio Alemão <marcioalemao190@gmail.com>
 * 
 *@param $table, $val
 * São parâmetros patrões.
 *@param array $where  
 * É  um array com valores de manilupação como comparação, ordenação e limitação.
 *@param int $option 
 * É definido como um número de opções. É usado no metodo show.
 */

namespace Service;

use Interfaces\DataInterface;
Use PDO;
use Model\DataException;

final class Data implements DataInterface
{
    private  $res = 0;
    private  $pdo = null;
    private  $host = 'localhost';
    private  $user = 'root';
    private  $passwd = 'rootadmin';
    private  $database = 'apiTest';
    private  $typeDatabase = 'mysql';
    private  $option = 
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC 
    ];

    /**
     * DESTRUCTOR destrói @var $pdo
     * @return void
     */
    public function __destruct()
    {
        if(!empty($this->pdo)) unset($this->pdo); 
    }


    /**
     * @return void
     */
    public function open():void
    {
        if (!$this->pdo || $this->pdo != null) $this->pdo = new PDO("$this->typeDatabase:host=$this->host;dbname=$this->database;charset=utf8",
         $this->user, 
         $this->passwd,
         $this->option ) or 
         die("⛔ Error: 401 <br/>");
    }

    /**
     * @return void
     */
    public function close():void
    {
        unset($this->pdo);
    }

    /**
     * @param  string $table
     * @param array $columns
     * @param array $val
     * @return int
     */

    public function add(string $table, array $columns, array $val):int
    {
        if (empty($table) || empty($columns) || empty($val)) throw new DataException("Error null values",DataException::NOT_ACCEPTABLE);

        $colTable = implode(",", $columns);
        $preVal = implode(",", array_fill(0, count($val), '?'));
        $this->pdo->beginTransaction();
        $query = $this->pdo->prepare("INSERT INTO $table ($colTable) VALUES($preVal)");

        for ($c = 0; $c < count($val); $c++) {
            $query->bindParam($c + 1, $val[$c]);
        }
        $query->execute();

        $this->res = $this->pdo->commit();

        if (!$this->res) throw new DataException(print_r($query->errorInfo()), DataException::REQ_INVALID);

        return $this->res;
    }
    /**  
     * --- São  5 opções para selecionar sua busca --- 
     * 
     * 1: Busca simpres com select,
     * 2: Busca select com   manipulações de opções,
     * 3: Busca select com where  manipulações de opções,
     * 4: Busca select com valores definidos,
     * 5: Busca select com valores e manipulações de opções,
     * 6: Busca select com valores definidos e where  manipulações de opções.
     * @param string $table
     * @param array $val
     * @param string $prewher
     * @param array $where
     * @param int $option  
     * @return array
     */
    public function show(string $table, array $val = [], string $prewher = "", array $where = [], int $option = 1): ?array
    {
        if (!$option) throw new DataException("Value 0 (zero) is not accepted", DataException::REQUIRED_LENGTH);
        if (!is_numeric($option)) throw new DataException("Non-numeric value", DataException::NOT_ACCEPTABLE);

        $valTable = implode(",", $val);

        $this->pdo->beginTransaction();

        switch ($option) {
            case 1:
                $query = $this->pdo->prepare("SELECT * FROM $table");
                break;
            case 2:
                $query = $this->pdo->prepare("SELECT * FROM $table $prewher");
                break;
            case 3:
                $query = $this->pdo->prepare("SELECT * FROM $table WHERE $prewher");
                break;
            case 4:
                $query = $this->pdo->prepare("SELECT $valTable FROM $table");
                break;
            case 5:
                $query = $this->pdo->prepare("SELECT $valTable FROM $table  $prewher");
                break;
            case 6:
                $query = $this->pdo->prepare("SELECT $valTable FROM $table WHERE $prewher");
                break;
        }
        for ($c = 0; $c < count($where); $c++) {
            $query->bindParam($c + 1, $where[$c]);
        }

        $query->execute();
        $this->res = $this->pdo->commit();

        if (!$this->res) throw new DataException(print_r($query->errorInfo()), DataException::REQ_INVALID);

        return ($query->rowCount() == 1) ? $query->fetch(PDO::FETCH_ASSOC) : $query->fetchAll();
    }

    /**  
     * @param string $table
     * @param string $prewher
     * @param string $where
     * @param array $preval
     * @param array $val
     * @param array $val
     * @param array $preval
     *@return int
     * Variáveis $preval e $prewhe é definido como array.$preVal é  passado dentro de cada array nome da coluna e o valor em aspas simples
     * exem: nome_da_coluna = ?
     */

    public function update(string $table, string $prewher, array $where, array $preval, array $val):int
    {
        if (empty($table) || empty($prewher) || empty($preval) || empty($where) || empty($val)) throw new DataException("Error null values", DataException::NOT_ACCEPTABLE);

        $preVal = trim(implode(", ", $preval));
        $this->pdo->beginTransaction();
        $query = $this->pdo->prepare("UPDATE $table SET $preVal WHERE $prewher");

        $quant = count($val) + count($where);
        $cont = count($val) - 1;
        $c2 = 0;
        for ($c = 0; $c < $quant; $c++) {
            if ($c > $cont) {
                $query->bindParam($c + 1, $where[$c2]);
                $c2++;
            } else {
                $query->bindParam($c + 1, $val[$c]);
            }
        }
        $query->execute();
        $this->res = $this->pdo->commit();

        if (!$this->res) throw  new DataException(print_r($query->errorInfo()), DataException::REQ_INVALID);

        return $this->res;
    }
    /**
     * @param string $table
     * @param string $where
     * @param array $val
     * @return int
     *  Passa para o $where como parâmetro a manipulação para deleção do valor e os valores são passado no parãmetro $val  
     *  exem: id =  ?
     */
    public function delete(string $table, string $where, array $val):int
    {
        if (empty($table) || empty($where) || empty($val)) throw new DataException("Error null values",DataException::NOT_ACCEPTABLE);
        $this->pdo->beginTransaction();
        $query = $this->pdo->prepare("DELETE FROM $table WHERE $where");

        for ($c = 0; $c < count($val); $c++) {
            $query->bindParam($c + 1, $val[$c]);
        }
        $query->execute();
        $this->res = $this->pdo->commit();

        if (!$this->res) throw new DataException(print_r($query->errorInfo()), DataException::REQ_INVALID);

        return $this->res;
    }
}