<?php

/** 
 * @author Marcio Alemão <marcioalemao190@gmail.com>
 * 
 */

namespace Ecomais\Services;


use Exception;
use PDO;
use Ecomais\Models\DataException;
use PDOException;

final class Data
{
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
        if (!isset($this->pdo) || $this->pdo === null) {
            $this->pdo = new PDO(
                BD_CONFIG["TYPE"] . ":host=" . BD_CONFIG["HOST"] . ";port=" . BD_CONFIG["PORT"] . ";dbname=" . BD_CONFIG["NAME"],
                BD_CONFIG["USER"],
                BD_CONFIG["PASSWD"],
                BD_CONFIG["OPTIONS"]
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
        try{
            $this->query->execute();
            $this->pdo->commit();
            return ($this->query->rowCount() == 1) ? $this->query->fetch(PDO::FETCH_ASSOC) : $this->query->fetchAll();
        }catch(PDOException $e) {
            throw new DataException($e->getMessage(), $e->getCode());
        }
        return null;
    }

    /**
     * Executa e retorna um Boolean
     * @return bool
     */
    public function execNotRowSql(): bool
    {
        try{
            $this->query->execute();
            $this->pdo->commit();
            return  ($this->query->rowCount() > 0 ) ? true : false;
        }catch(PDOException $e){
            throw new DataException($e->getMessage(),$e->getCode());
        } 
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

            if (empty($table) || empty($columns) || empty($quantity)) throw new DataException("null values", DataException::NOT_ACCEPTABLE);

            $preVal = join(",", array_fill(0, $quantity, "?"));

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
     * 6 - Pesquisa com colunas específicas e com validação também pode usar manipuladores;
     * 
     * @param string $table
     * Nome da tabela
     * @param string $columns
     * Nome das colunas separada com vírgulas
     * @param string $preWhere
     * A validação
     * @param int $option
     * Opção de pesquisa
     * @return Data
     */
    public function show(string $table, string $columns = "", string $preWhere = "", int $option = 1): Data
    {
        try {
            if (empty($table)) throw new DataException("null values", DataException::NOT_IMPLEMENTED);
            if ($option <= 0 || $option > 6) throw new DataException("Value <mark>$option</mark> is not accepted", DataException::SERVER_ERROR);
            if (!is_numeric($option)) throw new DataException("Non-numeric value", DataException::NOT_ACCEPTABLE);

            $this->pdo->beginTransaction();

            switch ($option) {
                case 1:
                    $this->query = $this->pdo->prepare("SELECT * FROM $table");
                    break;
                case 2:
                    $this->query = $this->pdo->prepare("SELECT * FROM $table $preWhere");
                    break;
                case 3:
                    $this->query = $this->pdo->prepare("SELECT * FROM $table WHERE $preWhere");
                    break;
                case 4:
                    $this->query = $this->pdo->prepare("SELECT $columns FROM $table");
                    break;
                case 5:
                    $this->query = $this->pdo->prepare("SELECT $columns FROM $table  $preWhere");
                    break;
                case 6:
                    $this->query = $this->pdo->prepare("SELECT $columns FROM $table WHERE $preWhere");
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
     * @param string $columns
     * Os nomes das colunas que serão atualizados exem:
     * name = ?, address = ?
     * @param string $where
     * A validação
     * @return Data
     */
    public function update(string $table, string $columns, string $where): Data
    {
        try {
            if (empty($table) || empty($columns) || empty($where) ) throw new DataException("null values", DataException::NOT_ACCEPTABLE);

            $this->pdo->beginTransaction();
            $this->query = $this->pdo->prepare("UPDATE $table SET $columns WHERE $where");

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
            if (empty($table) || empty($where) || empty($val)) throw new DataException("null values", DataException::NOT_ACCEPTABLE);

            $this->pdo->beginTransaction();
            $this->query = $this->pdo->prepare("DELETE FROM $table WHERE $where");

        } catch (Exception $ex) {
            throw new DataException($ex->getMessage(), DataException::SERVER_ERROR);
        }
        return $this;
    }
}
