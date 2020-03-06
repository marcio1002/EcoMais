<?php
/** 
* @param $table, $value 
* São parâmetros patrões para manipulações.
* @param string $where  
* É  uma variavel String com valor de manilupação como comparação, ordenação e limitação.
* @param int $option 
* É definido como um número de opções. É usado no metodo show.
*/

require_once "../interfaces/databaseInterface.php";

final class Data implements DatabaseInterface {
    private $res = null;
    private $stmt = null;
    private $host;
    private $user;
    private $passwd;
    private $database;

    function __construct(string $host,string $user,string $passwd,string $database) {
        $this->host = $host;
        $this->user = $user;
        $this->passwd = $passwd;
        $this->database = $database;
        $this->stmt = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8",$this->user,$this->passwd) or die("⛔ Error connecting to the bank. <br/>" . $this->stmt->errorInfo());
    }

    public function connectionClose() {
        unset($this->stmt);
    }

    public function add(string $table, array $columns, array $val) {
        if (empty($table) || empty($columns) || empty($val) ) throw new Exception("Error null values", 1);

        $colTable = implode(",", $columns);
        $preVal = implode(",",array_fill(0,count($val),'?'));

        $query = $this->stmt->prepare("INSERT INTO $table ($colTable) VALUES($preVal)");

        for($c = 0; $c < count($val); $c++) {
            $query->bindParam($c+1,$val[$c]);
        }
        $this->res = $query->execute();
        if (!$this->res) throw new Exception(print_r($query->errorInfo()),2);
        
        return $this->res;
    }
    /**  
    * @param $option  São  5 opções para selecionar sua busca 
    * 1: Busca simpres com select,
    * 2: Busca select com  opção,
    * 3: Busca select com where,
    * 4: Busca select com valores definidos,
    * 5: Busca select com valores definidos e where.
    */

    public function show(string $table, array $val = [],string $where = "",int $option = 1) {
        if (empty($table)) throw new Exception("Error null values", 1);
        if (!$option) throw new Exception("Value 0 (zero) is not accepted",4);
        if (!is_numeric($option)) throw new Exception("Non-numeric value",4);

        $valTable = implode(",", $val);

        switch ($option) {
            case 1:
                $query = $this->stmt->prepare("SELECT * FROM $table") ;
                $this->res = $query->execute();
                break;
            case 2:
                $query = $this->stmt->prepare("SELECT * FROM $table $where");
                $this->res = $query->execute();
                break;
            case 3:
                $query = $this->stmt->prepare("SELECT * FROM $table WHERE $where");
                $this->res = $query->execute();
                break;
            case 4:
                $query = $this->stmt->prepare("SELECT $valTable FROM $table");
                $this->res = $query->execute();
                break;
            case 5:
                $query = $this->stmt->prepare("SELECT $valTable FROM $table WHERE $where");
                $this->res = $query->execute();
                break;
        }
        if (!$this->res) throw new Exception(print_r($query->errorInfo()),2);

        $this->res = $query->fetchAll();
        return $this->res;
    }
    /**  
    * @param array $val
    * @param array $prval
    *
    * Variáveis de array $preval e $prewhe é definido como array e é passado dentro do array nome da coluna e o valor em aspas simples
    * exem: nome_da_coluna = '?'
    */
    public function update(string $table,string $prewher,array $where = null,array $preval,array $val = null) {
        if (empty($table) || empty($prewher) || empty($preval) ) throw new Exception("Error null values", 1);

        $preVal = implode(", ", $preval);
            $query = $this->stmt->prepare("UPDATE $table SET $preVal WHERE $prewher;");

            $col = count($val) + count($where);
            
            for($c = 0; $c < $col; $c++) {
                $query->bindParam($c+1, $val[$c]);
                if($c >= count($val)) {
                    $c2 = 1;
                    $query->bindParam($c+1, $where[$c2]);
                    $c2++;
                }

            }
            $this->res = $query->execute();

        if (!$this->res) throw  new Exception(print_r($query->errorInfo()),2);
    
        return $this->res;
    }
    /**
     * @param string $where
     *  @param array $val
     * Where é definido a opção de deleção e valor deve ser definido em array
     * exem: id =  ?
     */
    public function delete(string $table,string $where,array $val) {
        if (empty($table) || empty($where) || empty($vall)) throw new Exception("Error null values", 1);

        $query = $this->stmt->prepare("DELETE FROM $table WHERE $where");

        for($c = 0; $c < count($val); $c++) {
            $query->bindParam($c+1, $val[$c]);
        }
        $this->res = $query->execute();

        if (!$this->res) throw new Exception(print_r($query->errorInfo()),2);
    
        return $this->res;
    }
}
?>