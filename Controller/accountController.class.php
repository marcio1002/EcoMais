<?php

/* @param patrão da api são: conexão com o banco, nome da tabela e valores que serão adicionado no banco.
       @param de opções e manipulações de busca, atualização e deleção.
        @Param $where  é  uma variavel String com valor de manilupação como comparação, ordenação e limitação.
        @Param $option é definido como um número de opções. É usado nos metodos show e update.
*/

class AccountController
{
    private $result;

    public function addRegistry($connection, $table,array $columns,array $values)
    {
        if (!isset($table) || !isset($columns) || !isset($values) || !isset($connection)) throw new Exception("Error valores nulos", 1);

        $columnsTable = implode(",", $columns);
        $valuesTable = implode("','", $values);

        $query = "INSERT INTO $table ($columnsTable) VALUES('$valuesTable');";
        $this->result =  mysqli_query($connection, $query);

        if (!$this->result) throw new Exception("Erro: <strong> $query </strong> <br/>" . mysqli_error($connection));

        mysqli_close($connection);
    }
    /* @param $option  São três 5 opções para selecionar sua busca 
        1: Busca simpres com select,
        2: Busca select com  opção,
        3: Busca select com where,
        4: Busca select com valores definidos,
        5: Busca select com valores definidos e where.
    */
    public function showRegistry($connection, $table,array $values, $where, $option = 1)
    {
        if (!isset($connection) || !isset($table)) throw new Exception("Erro: valores nulos", 1);
        if (!$option) throw new Exception("Valor 0 (zero) não aceito");
        if (!is_numeric($option)) throw new Exception("Valor não numérico");

        switch ($option) {
            case 1:
                $query = "SELECT * FROM $table;";
                $this->result = mysqli_query($connection, $query);
                break;
            case 2:
                $query = "SELECT * FROM $table $where;";
                $this->result = mysqli_query($connection, $query);
                break;
            case 3:
                $query  = "SELECT * FROM $table WHERE $where;";
                $this->result = mysqli_query($connection, $query);
                break;
            case 4:
                $valuesTable = implode(",", $values);
                $query = "SELECT $valuesTable FROM $table;";
                $this->result = mysqli_query($connection, $query);
                break;
            case 5:
                $valuesTable = implode(",", $values);
                $query = "SELECT $valuesTable FROM $table WHERE $where;";
                $this->result = mysqli_query($connection, $query);
                break;
        }
        if (!$this->result) throw new Exception("Erro: <strong> $query </strong> <br/>" . mysqli_error($connection));
        return $this->result;

        mysqli_close($connection);
    }
    /* @Parâmetro $values é definido como array já definindo o nome_da_coluna = 'valor' <- valor com aspas simples
       */
    public function updateRegistry($connection, $table, $where,array $values, $option = 1)
    {
        if (!isset($connection) || !isset($table) || !isset($values)) throw new Exception("Error valores nulos", 1);
        if (!$option) throw new Exception("Valor 0 (zero) não aceito");
        if (!is_numeric($option)) throw new Exception("Valor não numérico");
        
        $valuesTable = implode(", ",$values);
        switch ($option) {
            case 1:
                $query = "UPDATE $table SET $valuesTable WHERE $where;";
                $this->result = mysqli_query($connection, $query);
                break;
            case 2:
                $query = "UPDATE $table SET $valuesTable WHERE $where;";
                $this->result = mysqli_query($connection, $query);
                break;
        }

        if (!$this->result) throw  new Exception("Erro: <strong>$query</strong> <br/>" . mysqli_error($connection));
        mysqli_close($connection);
    }

    public function deleteRegistry($connection, $table, $where)
    {
        if (!isset($connection) || !isset($table) || !isset($where)) throw new Exception("Erro valores nulos", 1);

        $query = "DELETE FROM $table WHERE $where";

        $this->result = mysqli_query($connection, $query);

        if (!$this->result) throw new Exception("Erro: <strong>$query</strong> $query <br/>" . mysqli_error($connection));
    }
}
