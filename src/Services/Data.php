<?php
/** 
 * @author Marcio Alemão <marcioalemao190@gmail.com>
 * 
*/

namespace Ecomais\Services;


use Exception;
use PDO;
use Ecomais\Models\DataException;

final class Data
{
    const  PARAM_HOST = 'localhost';
    const  PARAM_USER = 'marcio';
    const  PARAM_PASSWD = 'marcioadmin';
    const  PARAM_DATA = 'bdecomais';
    const  TYPE_SBGD = 'mysql';
    const PARAM_PORT = "3306";
    const OPTIONS =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    private  $row = null;
    private  $pdo = null;
    private $query = null;


    public function __destruct()
    {
        if (isset($this->pdo)) unset($this->pdo);
    }

    public function open(): void
    {
        if (!$this->pdo || $this->pdo != null)
            $this->pdo = new PDO(
                DATA::TYPE_SBGD . ":host=" . Data::PARAM_HOST . ";port=" . Data::PARAM_PORT . ";dbname=" . Data::PARAM_DATA,
                Data::PARAM_USER,
                DATA::PARAM_PASSWD,
                DATA::OPTIONS
            )
            or
            die(header($_SERVER["SERVER_PROTOCOL"].DataException::NOT_AUTHORIZED." Not authorized"));
    }

    public function close(): void
    {
        unset($this->pdo);
    }

    public function add(string $table, string $columns, array $val): int
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

            throw new DataException($ex->getMessage(),DataException::SERVER_ERROR);
        }

        return $this->row;
    }

    public function show(string $table, string $columns = "", string $prewhere = "", array $where = [], int $option = 1): ?array
    {
        try {
            if (empty($table)) throw new DataException("Error null values", DataException::NOT_IMPLEMENTED);
            if ($option <= 0 || $option > 6) throw new DataException("Value $option is not accepted", DataException::SERVER_ERROR);
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

            if ($this->row)
                return ($this->query->rowCount() == 1) ? $this->query->fetch(PDO::FETCH_ASSOC) : $this->query->fetchAll();
        } catch (Exception $ex) {

            throw new DataException($ex->getMessage(), DataException::SERVER_ERROR);
        }

        return null;
    }

    public function update(string $table, string $prewhere, array $where, string $preVal, array $val): int
    {
        try {
            if (empty($table) || empty($prewhere) || empty($preVal) || empty($where) || empty($val)) throw new DataException("Error null values", DataException::NOT_ACCEPTABLE);

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

        } catch (Exception $ex) {
            throw new DataException($ex->getMessage(),DataException::SERVER_ERROR);
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
                $this->query->bindParam($c, $val[$c - 1]);
            }
            $this->query->execute();
            $this->row = $this->pdo->commit();
        } catch (Exception $ex) {
            throw new DataException($ex->getMessage(),DataException::SERVER_ERROR);
        }
        return $this->row;
    }
}
