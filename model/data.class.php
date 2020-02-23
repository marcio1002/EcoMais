<?php
/* @param patrão da api são: nome da tabela e valores que serão adicionado no banco.
@param de opções e manipulações de busca, atualização e deleção.
@Param $where  é  uma variavel String com valor de manilupação como comparação, ordenação e limitação.
@Param $option é definido como um número de opções. É usado nos metodos show e update.
*/
require_once "../interfaces/databaseInterface.php";

class Data implements DatabaseInterface {
    private $result;
    private $connection;

    function __construct(string $host,string $user,string $password,string $database)
    {
        $this->connection = mysqli_connect($host, $user, $password, $database) or die("<script>confirm('⛔ Erro ao conectar com o banco. <br/> Erro:" . mysqli_connect_errno() . "');</script>");
    }

    public function connectionClose() {
        mysqli_close($this->connection);
    }

    public function add(string $table, array $columns, array $values) {
        if (!isset($table) || !isset($columns) || !isset($values) ) throw new Exception("Error valores nulos", 1);

        $columnsTable = implode(",", $columns);
        $valuesTable = implode("','", $values);

        $query = "INSERT INTO $table ($columnsTable) VALUES('$valuesTable');";
        $this->result =  mysqli_query($this->connection, $query);

        if (!$this->result) throw new Exception("Erro: <strong> $table </strong><strong> $columns </strong> <br/>" . mysqli_error($this->connection));
    }
    /* @param $option  São  5 opções para selecionar sua busca 
        1: Busca simpres com select,
        2: Busca select com  opção,
        3: Busca select com where,
        4: Busca select com valores definidos,
        5: Busca select com valores definidos e where.
    */
    public function show(string $table, array $values,string $where,int $option = 1)
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
        if (!$this->result) throw new Exception("Erro: <strong>$table</strong> <strong> $values</strong> <strong> $where</strong> <br/>" . mysqli_error($this->connection));
        return $this->result;
    }
    /* @Parâmetro $values é definido como array e é passado dentro do array node da coluna e o valor em aspas simples
            exem: nome_da_coluna = 'valor'
       */
    public function update(string $table,string $where, array $values)
    {
        if (!isset($table) || !isset($values)) throw new Exception("Error valores nulos", 1);

        $valuesTable = implode(", ", $values);

                $query = "UPDATE $table SET $valuesTable WHERE $where;";
                $this->result = mysqli_query($this->connection, $query);

        if (!$this->result) throw  new Exception("Erro: <strong>$table</strong> <strong>$values</strong> <br/>" . mysqli_error($this->connection));
    }

    public function delete(string $table,string $where)
    {
        if (!isset($table) || !isset($where)) throw new Exception("Erro valores nulos", 1);

        $query = "DELETE FROM $table WHERE $where";

        $this->result = mysqli_query($this->connection, $query);

        if (!$this->result) throw new Exception("Erro: <strong>$table</strong> <strong>$where</strong> <br/>" . mysqli_error($this->connection));
    }
}
?>