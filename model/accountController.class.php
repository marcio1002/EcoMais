<?php
    require_once "./interfaces/databaseInterface.php";
/* @param patrão da api são: nome da tabela e valores que serão adicionado no banco.
       @param de opções e manipulações de busca, atualização e deleção.
        @Param $where  é  uma variavel String com valor de manilupação como comparação, ordenação e limitação.
        @Param $option é definido como um número de opções. É usado nos metodos show e update.
*/

class AccountController implements Database
{
    private $result;
    private $connection;
    private $host;
    private $user;
    private $password;
    private $database;

    function __construct($host, $user, $password, $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect()
    {
        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("<script>confirm('⛔ Erro ao conectar com o banco. <br/> Erro:" . mysqli_connect_errno() . "'); location.href = index.php </script>");
    }

    public function connectionClose()
    {
        
        mysqli_close($this->connection);
    }

    public function addRegistry( $table, array $columns, array $values)
    {
        if (!isset($table) || !isset($columns) || !isset($values) ) throw new Exception("Error valores nulos", 1);

        $columnsTable = implode(",", $columns);
        $valuesTable = implode("','", $values);

        $query = "INSERT INTO $table ($columnsTable) VALUES('$valuesTable');";
        $this->result =  mysqli_query($this->connection, $query);

        if (!$this->result) throw new Exception("Erro: <strong> $query </strong> <br/>" . mysqli_error($this->connection));
    }
    /* @param $option  São  5 opções para selecionar sua busca 
        1: Busca simpres com select,
        2: Busca select com  opção,
        3: Busca select com where,
        4: Busca select com valores definidos,
        5: Busca select com valores definidos e where.
    */
    public function showRegistry( $table, array $values, $where, $option = 1)
    {
        if ( !isset($table)) throw new Exception("Erro: valores nulos", 1);
        if (!$option) throw new Exception("Valor 0 (zero) não aceito");
        if (!is_numeric($option)) throw new Exception("Valor não numérico");

        switch ($option) {
            case 1:
                $query = "SELECT * FROM $table;";
                $this->result = mysqli_query($this->connection, $query);
                break;
            case 2:
                $query = "SELECT * FROM $table $where;";
                $this->result = mysqli_query($this->connection, $query);
                break;
            case 3:
                $query  = "SELECT * FROM $table WHERE $where;";
                $this->result = mysqli_query($this->connection, $query);
                break;
            case 4:
                $valuesTable = implode(",", $values);
                $query = "SELECT $valuesTable FROM $table;";
                $this->result = mysqli_query($this->connection, $query);
                break;
            case 5:
                $valuesTable = implode(",", $values);
                $query = "SELECT $valuesTable FROM $table WHERE $where;";
                $this->result = mysqli_query($this->connection, $query);
                break;
        }
        if (!$this->result) throw new Exception("Erro: <strong> $query </strong> <br/>" . mysqli_error($this->connection));
        return $this->result;
    }
    /* @Parâmetro $values é definido como array e é passado dentro do array node da coluna e o valor em aspas simples
            exem: nome_da_coluna = 'valor'
       */
    public function updateRegistry($table, $where, array $values, $option = 1)
    {
        if (!isset($table) || !isset($values)) throw new Exception("Error valores nulos", 1);
        if (!$option) throw new Exception("Valor 0 (zero) não aceito");
        if (!is_numeric($option)) throw new Exception("Valor não numérico");

        $valuesTable = implode(", ", $values);
        switch ($option) {
            case 1:
                $query = "UPDATE $table SET $valuesTable WHERE $where;";
                $this->result = mysqli_query($this->connection, $query);
                break;
            case 2:
                $query = "UPDATE $table SET $valuesTable WHERE $where;";
                $this->result = mysqli_query($this->connection, $query);
                break;
        }

        if (!$this->result) throw  new Exception("Erro: <strong>$query</strong> <br/>" . mysqli_error($this->connection));
    }

    public function deleteRegistry( $table, $where)
    {
        if (!isset($table) || !isset($where)) throw new Exception("Erro valores nulos", 1);

        $query = "DELETE FROM $table WHERE $where";

        $this->result = mysqli_query($this->connection, $query);

        if (!$this->result) throw new Exception("Erro: <strong>$query</strong> $query <br/>" . mysqli_error($this->connection));
    }
}
?>