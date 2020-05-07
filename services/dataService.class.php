<?php

/** 
 * @author Marcio Alemão <marcioalemao190@gmail.com>
 * 
 */

namespace Services;

use Exception;
use Interfaces\DataInterface;
use PDO;
use Models\DataException;

final class Data implements DataInterface
{
    private  $row = null;
    private  $pdo = null;
    private  $host = 'localhost';
    private  $user = 'root';
    private  $passwd = 'rootadmin';
    private  $database = 'apiTest';
    private  $typeDatabase = 'mysql';
    private $query = null;
    private  $option =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];


    public function __destruct()
    {
        if (!empty($this->pdo)) unset($this->pdo);
    }


    /**
     * @return void
     */
    public function open(): void
    {
        if (!$this->pdo || $this->pdo != null) $this->pdo = new PDO(
            "$this->typeDatabase:host=$this->host;dbname=$this->database",
            $this->user,
            $this->passwd,
            $this->option
        ) 
        or
        die("⛔ Error: 401 <br/>");
    }

    public function close(): void
    {
        unset($this->pdo);
    }

    public function add(string $table, string $columns, array $val):int
    {
        try {

            if (empty($table) || empty($columns) || empty($val)) throw new DataException("Error null values", DataException::NOT_ACCEPTABLE);

            $preVal = implode(",", array_fill(0, count($val), "?"));

            $this->pdo->beginTransaction();

            $this->query = $this->pdo->prepare("INSERT INTO $table ($columns) VALUES($preVal)");

            foreach ($val as $c => $v) {
                $c += 1;
                $this->query->bindParam($c, $val[$c - 1]);
            }

            $this->query->execute();

            $this->row = $this->pdo->commit();
        } catch (Exception $ex) {

            return new DataException($ex->getMessage());
        }

            return $this->row;
    }

    public function show(string $table, string $columns = "", string $prewhere = "", array $where = [], int $option = 1): ?array
    {
        try {
            if (empty($table)) throw new DataException("Error null values", DataException::NOT_IMPLEMENTED);
            if ($option <= 0 || $option > 6) throw new DataException("Value $option is not accepted", DataException::REQ_INVALID);
            if (!is_numeric($option)) throw new DataException("Non-numeric value", DataException::NOT_ACCEPTABLE);

            $this->pdo->beginTransaction();

                switch ($option) {
                case 1:
                    $this->query = $this->pdo->prepare("SELECT * FROM $table");
                    break;
                case 2:
                    $this->query = $this->pdo->prepare("SELECT * FROM $table $prewhere");
                    break;
                case 3:
                    $this->query = $this->pdo->prepare("SELECT * FROM $table WHERE $prewhere");
                    break;
                case 4:
                    $this->query = $this->pdo->prepare("SELECT $columns FROM $table");
                    break;
                case 5:
                    $this->query = $this->pdo->prepare("SELECT $columns FROM $table  $prewhere");
                    break;
                case 6:
                    $this->query = $this->pdo->prepare("SELECT $columns FROM $table WHERE $prewhere");
                    break;
            }

            foreach ($where as $c => $w) {
                $c += 1;
                $this->query->bindParam($c, $where[$c - 1]);
            }

            $this->query->execute();
            $this->row = $this->pdo->commit();

            if($this->row)  
                return($this->query->rowCount() == 1)? $this->query->fetch(PDO::FETCH_ASSOC) : $this->query->fetchAll();
            
        
        } catch (Exception $ex) {

            return new DataException($ex->getMessage());
        }

        return null;
    }

    public function update(string $table, string $prewhere, array $where, string $preVal, array $val): int
    {
        try {
            if (empty($table) || empty($prewhere) || empty($preval) || empty($where) || empty($val)) throw new DataException("Error null values", DataException::NOT_ACCEPTABLE);

            $this->pdo->beginTransaction();
            $this->query = $this->pdo->prepare("UPDATE $table SET $preVal WHERE $prewhere");

            $quant = count($val) + count($where);
            $cont = count($val) - 1;
            $c2 = 0;

            for ($c = 0; $c < $quant; $c++) {
                if ($c > $cont) {
                    $this->query->bindParam($c + 1, $where[$c2]);
                    $c2++;
                } else {
                    $this->query->bindParam($c + 1, $val[$c]);
                }
            }

            $this->query->execute();
            $this->row = $this->pdo->commit();

            if (!$this->row) throw  new DataException(print_r($this->query->errorInfo()), DataException::REQ_INVALID);

        } catch (Exception $ex) {

            throw new DataException($ex->getMessage());
        }
        return $this->row;
    }

    public function delete(string $table, string $where, array $val): int
    {
        try {
            if (empty($table) || empty($where) || empty($val)) throw new DataException("Error null values", DataException::NOT_ACCEPTABLE);

            $this->pdo->beginTransaction();
            $this->query = $this->pdo->prepare("DELETE FROM $table WHERE $where");

            foreach ($val as $c => $v) {
                $c += 1;
                $this->query->bindParam($c + 1, $val[$c]);
            }
            $this->query->execute();
            $this->row = $this->pdo->commit();

            if (!$this->row) throw new DataException(print_r($this->query->errorInfo()), DataException::REQ_INVALID);
        } catch (Exception $ex) {

            throw new DataException($ex->getMessage());
        }
        return $this->row;
    }
}
