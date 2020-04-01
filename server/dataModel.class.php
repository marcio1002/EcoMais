<?php

/** 
 * @author Marcio Alemão <marcioalemao190@gmail.com>
 * @param $table, $val
 * São parâmetros patrões.
 * @param array $where  
 * É  um array com valores de manilupação como comparação, ordenação e limitação.
 * @param int $option 
 * É definido como um número de opções. É usado no metodo show.
 */

require_once __DIR__."/../interfaces/dataInterface.php";

final class Data implements DataInterface
{
    private  $res = 0;
    private  $pdo = null;
    private  $host = 'localhost';
    private  $user = 'root';
    private  $passwd = 'rootadmin';
    private  $database = 'apiTest';

    public function open()
    {
        if (!$this->pdo || $this->pdo != null) $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->user, $this->passwd, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]) or die("⛔ Error: 401 <br/>" . $this->pdo->errorInfo());
    }

    public function close()
    {
        unset($this->pdo);
    }

    public function add(string $table, array $columns, array $val)
    {
        if (empty($table) || empty($columns) || empty($val)) throw new Exception("Error null values", 411);

        $colTable = implode(",", $columns);
        $preVal = implode(",", array_fill(0, count($val), '?'));
        $this->pdo->beginTransaction();
        $query = $this->pdo->prepare("INSERT INTO $table ($colTable) VALUES($preVal)");

        for ($c = 0; $c < count($val); $c++) {
            $query->bindParam($c + 1, $val[$c]);
        }
        $query->execute();

        $this->res = $this->pdo->commit();

        if (!$this->res) throw new PDOException(print_r($query->errorInfo()), 400);

        return $this->res;
    }
    /**  
     * @param $option  São  5 opções para selecionar sua busca 
     * 1: Busca simpres com select,
     * 2: Busca select com   manipulações de opções,
     * 3: Busca select com where  manipulações de opções,
     * 4: Busca select com valores definidos,
     * 5: Busca select com valores e manipulações de opções,
     * 6: Busca select com valores definidos e where  manipulações de opções.
     */

    public function show(string $table, array $val = [], string $prewher = "", array $where = [], int $option = 1)
    {
        if (empty($table)) throw new Exception("Error null values", 411);
        if (!$option) throw new Exception("Value 0 (zero) is not accepted", 411);
        if (!is_numeric($option)) throw new Exception("Non-numeric value", 3);

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

        if (!$this->res) throw new PDOException(print_r($query->errorInfo()), 400);

        return ($query->rowCount() == 1) ? $query->fetch(PDO::FETCH_ASSOC) : $query->fetchAll();
    }
    /**  
     * @param array $val
     * @param array $preval
     *
     * Variáveis $preval e $prewhe é definido como array.$preVal é  passado dentro de cada array nome da coluna e o valor em aspas simples
     * exem: nome_da_coluna = ?
     */
    public function update(string $table, string $prewher, array $where, array $preval, array $val)
    {
        if (empty($table) || empty($prewher) || empty($preval) || empty($where) || empty($val)) throw new Exception("Error null values", 411);

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

        if (!$this->res) throw  new PDOException(print_r($query->errorInfo()), 400);

        return $this->res;
    }
    /**
     * @param string $where
     *  @param array $val
     * 
     * exem: id =  ?
     */
    public function delete(string $table, string $where, array $val)
    {
        if (empty($table) || empty($where) || empty($val)) throw new Exception("Error null values", 411);
        $this->pdo->beginTransaction();
        $query = $this->pdo->prepare("DELETE FROM $table WHERE $where");

        for ($c = 0; $c < count($val); $c++) {
            $query->bindParam($c + 1, $val[$c]);
        }
        $query->execute();
        $this->res = $this->pdo->commit();

        if (!$this->res) throw new PDOException(print_r($query->errorInfo()), 400);

        return $this->res;
    }
}