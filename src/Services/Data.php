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
    const PARAM_PORT = "3305";
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

    /**
     * Abre a conexão
     * @return void
     */
    public function open(): void
    {
        unset($this->pdo);
        if (!isset($this->pdo) || $this->pdo === null) {
            $this->pdo = new PDO(
                DATA::TYPE_SBGD . ":host=" . Data::PARAM_HOST . ";port=" . Data::PARAM_PORT . ";dbname=" . Data::PARAM_DATA,
                Data::PARAM_USER,
                DATA::PARAM_PASSWD,
                DATA::OPTIONS
            )
                or
            die(header($_SERVER["SERVER_PROTOCOL"] . DataException::NOT_AUTHORIZED . " Not authorized"));
        }
    }

    /**
     * Fecha a conexão
     * @return void
     */
    public function close(): void
    {
        unset($this->pdo);
    }


    public function prepareParam($vals, ?array $data_type = array()):Data
    {
        $c = 0;
        foreach ($vals as &$v) {
            $c += 1;
            if(isset($data_type[$c - 1])) {
                $this->query->bindParam($c, $v,$data_type[$c - 1]);
            } else {
                $this->query->bindParam($c, $v);
            }
        }
        return $this;
    }
    
    /**
     * Executa e retorna de dados
     * @return null|array
     */
    public function executeSql(): ?array
    {
        $this->query->execute();
        $this->pdo->commit();
        return ($this->query->rowCount() == 1) ? $this->query->fetch(PDO::FETCH_ASSOC) : $this->query->fetchAll();
    }

    /**
     * Executa e retorna um Boolean
     * @return bool
     */
    public function execNotRowSql(): bool
    {
        $this->query->execute();
        $this->pdo->commit();
        return  ($this->query->rowCount() > 0 ) ? true : false;
    }

    /**
     * Insere dados 
     * @param  string $table
     * Nome da tabela
     * @param string $columns
     * Nome das colunas separada com vírgulas
     * @param int $quantity
     * As quantidades de valores a serem armazenada
     * @return Data
     */
    public function add(string $table, string $columns,int $quantity): Data
    {
        try {

            if (empty($table) || empty($columns) || empty($quantity)) throw new DataException("Error null values", DataException::NOT_ACCEPTABLE);

            $preVal = implode(",", array_fill(0, $quantity, "?"));

            $this->pdo->beginTransaction();

            $this->query = $this->pdo->prepare("INSERT INTO $table ($columns) VALUES($preVal)");

        } catch (Exception $ex) {

            throw new DataException($ex->getMessage(), DataException::SERVER_ERROR);
        }

        return $this;
    }

    /**
     * Pesquisa de dados
     *  
     * opções de pesquisa:  
     * 1 - Pesquisa simples trazendo todos os dados;
     * 2 - Pesquisa trazendo todos os dados com manipulandores exem: ORDER BY, LIMIT, etc;
     * 3 - Pesquisa trazendo todos os dados com validação também pode usar manipuladores;
     * 4 - Pesquisa simples com colunas específicas;
     * 5 - Pesquisa com colunas específicas e com manipuladores;
     * 6 - esquisa com colunas específicas e com validação também pode usar manipuladores;
     * 
     * @param string $table
     * Nome da tabela
     * @param string $columns
     * Nome das colunas separada com vírgulas
     * @param string $where
     * A validação
     * @param int $option
     * Opção de pesquisa
     * @return Data
     */
    public function show(string $table, string $columns = "", string $prewhere = "", int $option = 1): Data
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

        } catch (Exception $ex) {

            throw new DataException($ex->getMessage(), DataException::SERVER_ERROR);
        }

        return $this;
    }


    /**
     * Atualiza os dados
     * @param  string $table
     * Nome da tabela
     * @param string $colums
     * Os nomes das colunas que serão atualizados exem:
     * name = ?, addres = ?
     * @param string $where
     * A validação
     * @return Data
     */
    public function update(string $table, string $colums, string $where): Data
    {
        try {
            if (empty($table) || empty($colums) || empty($where) ) throw new DataException("Error null values", DataException::NOT_ACCEPTABLE);

            $this->pdo->beginTransaction();
            $this->query = $this->pdo->prepare("UPDATE $table SET $colums WHERE $where");

        } catch (Exception $ex) {
            throw new DataException($ex->getMessage(), DataException::SERVER_ERROR);
        }
        return $this;
    }

    /**
     * Insere dados 
     * @param  string $table
     * Nome da tabela
     * @param string $where
     * A validação
     * @return Data
     */
    public function delete(string $table, string $where): Data
    {
        try {
            if (empty($table) || empty($where) || empty($val)) throw new DataException("Error null values", DataException::NOT_ACCEPTABLE);

            $this->pdo->beginTransaction();
            $this->query = $this->pdo->prepare("DELETE FROM $table WHERE $where");

        } catch (Exception $ex) {
            throw new DataException($ex->getMessage(), DataException::SERVER_ERROR);
        }
        return $this;
    }
}
